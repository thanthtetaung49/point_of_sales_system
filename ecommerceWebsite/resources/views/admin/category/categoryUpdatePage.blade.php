@extends('layouts.main')

@section('dataSection')
    <div class="col-12">
        <div class="row mt-5">
            <div class="col-6 offset-3">
                <form action="{{ route('category#update') }}" method="POST">
                @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-subtitle py-2">Update Category</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-control" name="categoryName" type="text"
                                       placeholder="Enter category name..." value="{{ old('categoryName', $categoryData->name) }}" />
                                       @error('categoryName')
                                            <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                <input type="hidden" name="id" value="{{ $categoryData->id }}">
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn bg-primary text-light text-uppercase">update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
