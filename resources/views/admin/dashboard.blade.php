@extends('../components/layout')
@section('content')

<section class="section dashboard">

    <div class="row">
        <!-- Pemasukan -->
        <div class="col-sm-12 col-md-3">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Pemasukan <span>| {{ucfirst($ket)}}</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>Rp. {{ $totalIn ? number_format($totalIn, 0, ',', '.') : '0' }},-</h6>
                            <span class="text-success small pt-1 fw-bold">82%</span> <span class="text-muted small pt-2 ps-1">lebih banyak dari bulan lalu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengeluaran -->
        <div class="col-sm-12 col-md-3">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Pengeluaran <span>| {{ucfirst($ket)}}</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>Rp. {{ $totalOut ? number_format($totalOut, 0, ',', '.') : '0' }},-</h6>
                            <span class="text-danger small pt-1 fw-bold">{{ $totalOut ? number_format(($totalOut/$totalIn) * 100, 1) : '0' }} %</span> <span class="text-muted small pt-2 ps-1">dari total kas {{$ket}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kegiatan -->
        <div class="col-sm-12 col-md-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Kegiatan <span>| {{ucfirst($ket)}}</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-puzzle"></i>
                        </div>
                        <div class="ps-3">
                            <h6>145</h6>
                            <span class="text-primary small pt-1 fw-bold">Total </span><span class="text-muted small pt-2 ps-1">kegiatan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="col-sm-12 col-md-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Apa disini?? <span>| {{ucfirst($ket)}}</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-question-lg"></i>
                        </div>
                        <div class="ps-3">
                            <h6>Apaaa??</h6>
                            <span class="text-primary small pt-1 fw-bold">Tampilin </span><span class="text-muted small pt-2 ps-1">apa oii??</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Keuangan -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Keuangan <span>| {{ucfirst($ket)}}</span></h5>

                    <div id="chartKeuangan"></div>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            new ApexCharts(document.querySelector("#chartKeuangan"), {
                                series: [{
                                        name: 'Pemasukan',
                                        data: @json($incomeFinal),
                                    },
                                    {
                                        name: 'Pengeluaran',
                                        data: @json($outcomeFinal)
                                    }
                                ],
                                chart: {
                                    height: 380,
                                    type: 'area',
                                    toolbar: {
                                        show: false
                                    },
                                },
                                markers: {
                                    size: 4
                                },
                                colors: ['#2eca6a', '#ff771d'],
                                fill: {
                                    type: "gradient",
                                    gradient: {
                                        shadeIntensity: 1,
                                        opacityFrom: 0.3,
                                        opacityTo: 0.4,
                                        stops: [0, 90, 100]
                                    }
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                stroke: {
                                    curve: 'smooth',
                                    width: 2
                                },
                                xaxis: {
                                    type: 'datetime',
                                    categories: @json($allDates)
                                },
                                tooltip: {
                                    x: {
                                        format: 'dd/MM/yy HH:mm'
                                    },
                                }
                            }).render();
                        });
                    </script>
                </div>
            </div>
        </div>

        <!-- Qurban -->
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title">Recent Sales <span>| {{ucfirst($ket)}}</span></h5>

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><a href="#">#2457</a></th>
                                <td>Brandon Jacob</td>
                                <td><a href="#" class="text-primary">At praesentium minu</a></td>
                                <td>$64</td>
                                <td><span class="badge bg-success">Approved</span></td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#">#2147</a></th>
                                <td>Bridie Kessler</td>
                                <td><a href="#" class="text-primary">Blanditiis dolor omnis
                                        similique</a></td>
                                <td>$47</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#">#2049</a></th>
                                <td>Ashleigh Langosh</td>
                                <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                                <td>$147</td>
                                <td><span class="badge bg-success">Approved</span></td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#">#2644</a></th>
                                <td>Angus Grady</td>
                                <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                                <td>$67</td>
                                <td><span class="badge bg-danger">Rejected</span></td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#">#2644</a></th>
                                <td>Raheem Lehner</td>
                                <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                                <td>$165</td>
                                <td><span class="badge bg-success">Approved</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection