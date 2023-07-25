@extends('layouts.main')

@section('dataSection')
    <div class="col-12">
        <form action="{{ route('product#update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- product id hidden --}}
            <input name="productId" type="hidden" value="{{ $productData->id }}">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-subtitle py-2">Edit Product</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group text-center">
                                @if ($productData->item_image == 'null')
                                    <img class="rounded w-50 mx-auto d-block"
                                         src="{{ asset('defaultImage/product_default.png') }}" alt="product-default" />
                                @else
                                    <img class="rounded w-50 mx-auto d-block"
                                         src="{{ asset('storage/productImage/' . $productData->item_image) }}"
                                         alt="product-default" />
                                @endif

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
                                       value="{{ old('productName', $productData->name) }}"
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
                                        <option value="{{ $item->id }}"
                                                @if ($item->name == $productData->category_name) selected @endif>
                                            {{ $item->name }}</option>
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
                                       value="{{ old('productPrice', $productData->item_price) }}"
                                       placeholder="Enter product price...">
                                @error('productPrice')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="productCode">Product Code</label>
                                <input class="form-control" id="productCode" name="productCode" type="number"
                                       value="{{ old('productCode', $productData->product_code) }}"
                                       placeholder="Enter product code..." />
                                @error('productCode')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="productQty">Product Quantity</label>
                                <div class="d-flex">
                                    <input class="form-control me-1" id="productQty" name="productQty" type="number"
                                           value="{{ old('productQty', $productData->qty) }}"
                                           placeholder="Enter product quantity..." disabled/>
                                    <button id="addBtn" class="btn bg-dark text-light" type="button">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                                <input type="number" id="addItem" class="form-control mt-2" name="addQty" placeholder="Add Item">

                                @error('addQty')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn bg-primary text-light text-uppercase" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
    $("#addItem").hide();

        $("#addBtn").click(function () {
            $("#addItem").toggle();
        });
    </script>
@endsection
