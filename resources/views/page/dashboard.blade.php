@extends('components.master')
@section('title', 'DASHBOARD')

@section('container')
    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">

                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Grafik Penjualan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="chart-order"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Penjualan</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Order</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $row)
                                                <tr>
                                                    <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <p class="font-bold ms-3 mb-0">{{ $row->product[0]->nama }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class="mb-0">
                                                            {{ $row->product[0]->harga }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <div class="col-auto">
                                                            <p class="mb-0">{{ $row->jumlah_barang }}</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @push('scripts')
                <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
                {{-- <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script> --}}
                <script>
                    var areaOptions = {
                        series: [{
                                name: "Order",
                                data: {!! json_encode($penjualan_grafik) !!},
                            },
                            // {
                            //     name: "series2",
                            //     data: [11, 32, 45, 32, 34, 52, 41],
                            // },
                        ],
                        chart: {
                            height: 350,
                            type: "area",
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        stroke: {
                            curve: "smooth",
                        },
                        xaxis: {
                            type: "datetime",
                            categories: {!! json_encode($bulan_grafik) !!},
                        },
                        tooltip: {
                            x: {
                                format: "dd/MM/yy HH:mm",
                            },
                        },
                    };

                    var area = new ApexCharts(document.querySelector("#chart-order"), areaOptions);

                    area.render();
                </script>
            @endpush
        </section>
    </div>
@endsection
