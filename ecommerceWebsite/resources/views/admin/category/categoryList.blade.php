@extends('layouts.main')

@section('dataSection')
    <div class="col-12">
        <div class="d-flex justify-content-end">
            <a class="btn btn-sm bg-success text-light" href="{{ route('categoryPage') }}">
                <i class="fa-solid fa-plus"></i>
                create category</a>
        </div>

        <div class="col-4 offset-8 mt-3">
            <form action="{{ route('categoryListPage') }}" method="GET">
                @csrf
                <div class="d-flex">
                    <input class="form-control" name="search" type="text" value="{{ request('search') }}"
                           placeholder="Find anything...">
                    <button class="btn bg-dark ms-2 text-light" type="submit">Search</button>
                </div>
            </form>
        </div>

        <div class="col-10 offset-1 mt-3">
            @if (count($categoryData) > 0)
                <table id="table">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Created at</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoryData as $item)
                            <tr>
                                <td class="text-center">{{ $item->id }}</td>
                                <td class="text-center">{{ $item->name }}</td>
                                <td class="text-center">{{ $item->created_at->format('d/M/Y') }}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm bg-dark mx-1" href="{{ route('categoryUpdatePage', $item->id) }}"
                                       title="Edit"><i class="fa-solid fa-pen text-light"></i></a>
                                    <a class="btn btn-sm bg-danger mx-1" href="{{ route('category#delete', $item->id) }}"
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
                {{ $categoryData->appends(request()->query())->links() }}
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
