@extends('layouts.main')

@section('dataSection')
    <div class="col-12">
        <div class="row mt-5">
            <div class="col-6 offset-3">
                <form action="{{ route('category#create') }}" method="POST">
                @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-subtitle py-2">Create Category</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-control" name="categoryName" type="text"
                                       placeholder="Enter category name..." />
                                       @error('categoryName')
                                            <span class="text-danger">{{ $message }}</span>
                                       @enderror
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn bg-primary text-light text-uppercase">create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
