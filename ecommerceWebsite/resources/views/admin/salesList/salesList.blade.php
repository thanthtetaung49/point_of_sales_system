@extends('layouts.main')

@section('dataSection')
    <div class="col-12">
        <div class="row">
            <div class="col-6 offset-6">
                <form action="{{ route('filterDate') }}" method="post">
                @csrf
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <select class="form-select" name="filterDate">
                                    <option value="">Choose date...</option>
                                    @foreach ($day as $item)
                                        <option value="{{ $item->day }}">{{ $item->day }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <select class="form-select" name="filterMonth">
                                    <option value="">Choose month...</option>
                                    @foreach ($month as $item)
                                        <option value="{{ $item->month }}">{{ $item->month }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <select class="form-select" name="filterYear">
                                    <option value="">Choose year...</option>
                                    @foreach ($year as $item)
                                        <option value="{{ $item->year }}">{{ $item->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn bg-dark text-light">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 mt-3">
            @if (count($salesListData) > 0)
                <table id="table">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Product name</th>
                            <th class="text-center">Order code</th>
                            <th class="text-center">Order quantity</th>
                            <th class="text-center">Date/Month/Year</th>
                            <th class="text-center">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salesListData as $item)
                            <tr>
                                <td class="text-center">{{ $item->id }}</td>
                                <td class="col-2 text-center">{{ $item->product_name }}</td>
                                <td class="text-center">{{ $item->order_code }}</td>
                                <td class="text-center">{{ $item->order_qty }} pieces</td>
                                <td class="text-center">{{ $item->orderDate }} </td>
                                <td class="text-center">{{ $item->total_price }} Kyats</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h1 class="text-center mt-5">There is no data.</h1>
            @endif

            <div class="mt-3">
                {{ $salesListData->appends(request()->query())->links() }}
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

            let orderCode = document.querySelectorAll('.orderCode');
            orderCode.forEach(element => {
                let orderCodeData = {
                    orderCode: element.value
                }
                console.log(orderCodeData);
            });
        });
    </script>
@endsection
