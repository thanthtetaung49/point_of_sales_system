@extends('layouts.main')

@section('dataSection')
    <div class="col-12">
        <form action="{{ route('product#create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h5 class="card-subtitle py-2">Create Product</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group text-center">
                                <img class="rounded w-50 mx-auto d-block"
                                     src="{{ asset('defaultImage/product_default.png') }}" alt="product-default" />
                                <label class="mt-2" for="productImage">
                                    <span class="btn bg-primary text-white">Upload Image</span>
                                </label>
                                <input class="form-control d-none" id="productImage" name="productImage" type="file">
                                @error('productImage')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group my-3">
                                <label for="productName">Product Name</label>
                                <input class="form-control" id="productName" name="productName" type="text"
                                       placeholder="Enter product name..." />
                                @error('productName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="productCategory">Product Category</label>
                                <select class="form-control" id="productCategory" name="productCategory">
                                    <option value="">Choose category...</option>
                                    @foreach ($categoryData as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('productCategory')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group my-3">
                                <label for="productPrice">Product Price</label>
                                <input class="form-control" id="productPrice" name="productPrice" type="number"
                                       placeholder="Enter product price...">
                                @error('productPrice')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="productCode">Product Code</label>
                                <input class="form-control" id="productCode" name="productCode" type="number"
                                       placeholder="Enter product code..." />
                                @error('productCode')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="productQty">Product Quantity</label>
                                <input class="form-control" id="productQty" name="productQty" type="number"
                                       placeholder="Enter product quantity..." />
                                @error('productCode')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn bg-primary text-light text-uppercase" type="submit">create</button>
                </div>
            </div>
        </form>
    </div>
@endsection
