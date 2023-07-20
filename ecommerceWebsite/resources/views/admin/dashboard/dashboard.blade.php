@extends('layouts.main')

@section('dataSection')
    <div class="col-12">
        <div class="row">
            <div class="col-3">
                <div class="box one w-100 rounded shadow-sm d-flex align-items-center p-2">
                    <div>
                        <h6 class="text-light">Total Earn</h6>
                        <h3 class="text-light"><i class="fa-solid fa-money-bill fa-2x"></i> {{ $sumTotalPrice }} Ks</h3>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="box two w-100 rounded shadow-sm d-flex align-items-center p-2">
                    <div>
                        <h6 class="text-light">Total Product</h6>
                        <h3 class="text-light"><i class="fa-solid fa-boxes-stacked fa-2x me-2"></i>{{ $sum }} items</h3>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="box three w-100 rounded shadow-sm d-flex align-items-center p-2">
                    <div>
                        <h6 class="text-light">Sold Product</h6>
                        <h3 class="text-light"><i class="fa-solid fa-box fa-2x me-2"></i>{{ $soldItems }} items</h3>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="box four w-100 rounded shadow-sm d-flex align-items-center p-2">
                    <div>
                        <h6 class="text-light">Employee number</h6>
                        <h3 class="text-light"><i class="fa-solid fa-users fa-2x me-2"></i>{{ count($userNumber) }} users
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-7 mt-5">
                <canvas id="myChartTwo"></canvas>
            </div>
            <div class="col-3 offset-1 mt-5">
                <small class="mb-2">Rencent year sold items</small>
                <canvas id="donutChart"></canvas>
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

            $.ajax({
                type: "get",
                url: "http://localhost:8000/api/chartPrice",
                dataType: "json",
                success: function(response) {
                    console.log(response.jan);

                    const ctx = document.getElementById('myChartTwo');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'Auguest', 'September', 'October', 'December'
                            ],
                            datasets: [{
                                label: 'Recent year sales(Kyats)',
                                data: [
                                    response.jan,
                                    response.feb,
                                    response.mar,
                                    response.apl,
                                    response.may,
                                    response.june,
                                    response.july,
                                    response.aug,
                                    response.sept,
                                    response.oct,
                                    response.nov,
                                    response.dec
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });

            $.ajax({
                type: "get",
                url: "http://127.0.0.1:8000/api/itemchart",
                dataType: "json",
                success: function(response) {
                    // Retrieve the canvas element
                    const ctx = document.getElementById('donutChart').getContext('2d');

                    // Define the data for the chart
                    const data = {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'Auguest', 'September', 'October', 'December'
                            ],
                        datasets: [{
                            data: [
                                    response.jan,
                                    response.feb,
                                    response.mar,
                                    response.apl,
                                    response.may,
                                    response.june,
                                    response.july,
                                    response.aug,
                                    response.sept,
                                    response.oct,
                                    response.nov,
                                    response.dec
                                ],
                            backgroundColor: ['rgba(255, 99, 132, 0.5)',
                                'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)',
                                'rgba(75, 192, 192, 0.5)',

                                'rgba(233, 139, 188, 0.8)',
                                'rgba(102, 139, 215, 0.8)', 'rgba(113, 102, 215, 0.8)',
                                'rgba(11, 242, 148, 0.8)',
                                'rgba(13, 10, 255, 0.8)',

                                'rgba(243, 23, 96, 0.8)', 'rgba(224, 163, 32, 0.8)',
                                'rgba(224, 163, 32, 0.8)'
                            ],
                            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'
                            ],
                            borderWidth: 1
                        }]
                    };

                    // Create the donut chart
                    const donutChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: data
                    });
                }
            });
        });
    </script>
@endsection
