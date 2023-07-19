@extends('layouts.main')

@section('dataSection')
    <div class="col-12">
        <div class="d-flex justify-content-end">
            <a class="btn btn-sm bg-success text-light" href="{{ route('product#createPage') }}">
                <i class="fa-solid fa-plus"></i>
                create product</a>
        </div>

        @if (session('createMessage'))
            <div class="col-4 offset-8 mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('createMessage') }}</strong>
                    <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('updateMessage'))
            <div class="col-4 offset-8 mt-3">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>{{ session('updateMessage') }}</strong>
                    <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('deleteMessage'))
            <div class="col-4 offset-8 mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('deleteMessage') }}</strong>
                    <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="col-4 offset-8 mt-3">
            <form action="{{ route('productPage') }}" method="GET">
                @csrf
                <div class="d-flex">
                    <input class="form-control" name="search" type="text" value="{{ request('search') }}"
                           placeholder="Find anything...">
                    <button class="btn bg-dark ms-2 text-light" type="submit">Search</button>
                </div>
            </form>
        </div>

        <div class="col-12 mt-3">
            @if (count($productData) > 0)
                <table id="table">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Item image</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Item price</th>
                            <th class="text-center">Item code</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productData as $item)
                            <tr>
                                <td class="text-center">{{ $item->id }}</td>
                                <td class="col-2 text-center">{{ $item->name }}</td>
                                <td class="col-2 text-center">
                                    @if ($item->item_image == 'null')
                                        <img class="w-50" src="{{ asset('defaultImage/product_default.png') }}"
                                             alt="product_default">
                                    @else
                                        <img class="w-50" src="{{ asset('storage/productImage/' . $item->item_image) }}"
                                             alt="{{ $item->item_image }}">
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->category_name }}</td>
                                <td class="text-center">{{ $item->item_price }} Kyats</td>
                                <td class="text-center">CODE-{{ $item->product_code }}</td>
                                <td class="text-center">{{ $item->qty }} pieces</td>
                                <td class="text-center">
                                    <a class="btn btn-sm bg-dark mx-1" href="{{ route('product#edit', $item->id) }}"
                                       title="Edit"><i class="fa-solid fa-pen text-light"></i></a>
                                    <a class="btn btn-sm bg-danger mx-1" href="{{ route('product#delete', $item->id) }}"
                                       title="Delete">
                                        <i class="fa-solid fa-trash text-light"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h1 class="text-center mt-5">There is no data.</h1>
            @endif

            <div class="mt-3">
                {{ $productData->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#table").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            $("#table_paginate").hide();
            $("#table_info").hide();
            $("#table_filter").hide();
        });
    </script>
@endsection
