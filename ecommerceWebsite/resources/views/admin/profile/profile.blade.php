@extends('layouts.main')

@section('dataSection')
    {{-- Start main --}}
    <main class="bg-light">
        <section>
            <div class="bg-white border-bottom">
                <div class="container py-3">
                    <h3>Profile</h3>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 my-3">
                        @if (session('updateUserSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('updateUserSuccess') }}</strong>
                                <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('passwordUpdateSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('passwordUpdateSuccess') }}</strong>
                                <button class="btn-close" data-bs-dismiss="alert" type="button"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('profileUpdateSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('profileUpdateSuccess') }}</strong>
                                <button class="btn-close" data-bs-dismiss="alert" type="button"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('deletePhotoSuccess'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('deletePhotoSuccess') }}</strong>
                                <button class="btn-close" data-bs-dismiss="alert" type="button"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 bg-white mb-3 p-3 shadow-sm rounded">
                        <div class="row">
                            <div class="col-5">
                                <form action="{{ route('uploadImage') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group text-center">
                                        <label for="userImage">
                                            @if (Auth::user()->image_name == null)
                                                <img class="w-50 rounded" src="{{ asset('defaultImage/defaultMale.jfif') }}"
                                                     alt="defaultMale">
                                            @else
                                                <img class="w-50 rounded"
                                                     src="{{ asset('storage/profileImage/' . Auth::user()->image_name) }}"
                                                     alt="{{ Auth::user()->image_name }}">
                                            @endif
                                        </label>
                                        <input class="d-none" id="userImage" name="userImage" type="file">
                                        @error('userImage')
                                            <div class="mt-3">
                                                <small class="text-danger">{{ $message }}</small>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mt-3 text-center">
                                        <button class="btn btn-sm bg-secondary text-light" type="submit">Change Your
                                            Avator</button>
                                        <a class="btn btn-sm bg-danger text-light" type="submit"
                                           href="{{ route('removePhoto', Auth::user()->id) }}">Remove Your Avator</a>
                                    </div>
                                </form>
                                <div>

                                </div>
                            </div>
                            <div class="col-7">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Name - {{ Auth::user()->name }}</li>
                                    <li class="list-group-item">Email - {{ Auth::user()->email }}</li>
                                    @if (Auth::user()->phone != null)
                                        <li class="list-group-item">Phone - {{ Auth::user()->phone }}</li>
                                    @else
                                        <li class="list-group-item">Phone - <i class="text-secondary">Need to update your
                                                phone number.</i></li>
                                    @endif
                                    @if (Auth::user()->address != null)
                                        <li class="list-group-item">Address - {{ Auth::user()->address }}</li>
                                    @else
                                        <li class="list-group-item">Phone - <i class="text-secondary">Need to update your
                                                address.</i></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 my-3">
                        <div>
                            <h5>Profile Information</h5>
                            <small>Update your account's profile information and email address.</small>
                        </div>
                    </div>
                    <div class="col-7 my-3">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('updateUserInformation') }}" method="post">
                                    @csrf
                                    <div class="form-group mt-3">
                                        <label for="userName">Name</label>
                                        <input class="form-control" id="userName" name="name" type="text"
                                               value="{{ old('name', Auth::user()->name) }}" placeholder="Enter Name" />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-grop mt-3">
                                        <label for="userEmail">Email</label>
                                        <input class="form-control" id="userEmail" name="email" type="email"
                                               value="{{ old('email', Auth::user()->email) }}" placeholder="Enter email" />
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- need to cheeck --}}
                                    <div class="form-group mt-3">
                                        <label for="userPhone">Phone</label>
                                        <input class="form-control" id="userPhone" name="phone" type="text"
                                               value="{{ old('phone', Auth::user()->phone) }}" placeholder="Enter phone" />
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="userAddress">Address</label>
                                        <input class="form-control" id="userAddress" name="address" type="text"
                                               value="{{ old('address', Auth::user()->address) }}"
                                               placeholder="Enter address" />
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button class="btn bg-dark text-light" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 my-3">
                        <div>
                            <h5>Update Password</h5>
                            <small>Ensure your account is using for long, random passowrd to stay secure.</small>
                        </div>
                    </div>
                    <div class="col-7 my-3">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('updatePassword') }}" method="post">
                                    @csrf
                                    <div class="form-group mt-3">
                                        <label for="currentPassword">Current Password</label>
                                        <input class="form-control" id="currentPassword" name="currentPassword"
                                               type="password" placeholder="Enter current password" />
                                        @error('currentPassword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        @if (session('passwordUpdateFail'))
                                            <span class="text-danger">{{ session('passwordUpdateFail') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="newPassword">New Password</label>
                                        <input class="form-control" id="newPassword" name="newPassword" type="password"
                                               placeholder="Enter new password" />
                                        @error('newPassword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="confirmPassword">Confirm Password</label>
                                        <input class="form-control" id="confirmPassword" name="confirmPassword"
                                               type="password" placeholder="Enter Confirm password" />
                                        @error('confirmPassword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button class="btn bg-dark text-light" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 my-3">
                        <div>
                            <h5>Delete Account</h5>
                            <small>Permently delete your account.</small>
                        </div>
                    </div>
                    <div class="col-7 my-3">
                        <div class="card">
                            <div class="card-body">
                                <small>Once your account is deleted, all of its resource and data will be permently deleted.
                                    Before deleting your account, please download any data or information that you wish to
                                    retain.</small>
                                <div>
                                    <a href="{{ route('deleteAccount') }}">
                                        <button class="btn bg-danger text-light text-uppercase" type="submit">delete
                                            account</button>
                                    </a>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    {{-- End main --}}
@endsection
