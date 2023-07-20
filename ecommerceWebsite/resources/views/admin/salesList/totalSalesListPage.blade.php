@extends('layouts.main')

@section('dataSection')
    <div class="col-12">
        <div class="col-12 mt-3">
            @if (count($salesTotal) > 0)
                <table id="table">
                    <thead>
                        <tr>
                            <th class="text-center">Order Code</th>
                            <th class="text-center">D/M/Y</th>
                            <th class="text-center">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salesTotal as $item)
                            <tr>
                                <td class="col-3 text-center">{{ $item->order_code }}</td>
                                <td class="col-3 text-center">{{ $item->created_at->format('d/m/Y') }}</td>
                                <td class="col-3 text-center">
                                    {{ $item->total_price }} Kyats
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center" colspan="2">Total</th>
                            <th class="text-center">{{ $sumTotalPrice }} Kyats</th>
                        </tr>
                    </tfoot>
                </table>
            @else
                <h1 class="text-center mt-5">There is no data.</h1>
            @endif

            <div class="mt-3">
                {{ $salesTotal->appends(request()->query())->links() }}
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
