@extends('../components/layout')
@section('content')

<section class="section dashboard">

    <div class="row">
        <div class="col-sm-12">
            @include('../components/alert')
        </div>

        <!-- Total Kas -->
        <div class="col-sm-12 col-md-3">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Total Kas <span>| Keseluruhan</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>Rp. {{number_format($totalKas, 0, ',', '.')}},-</h6>
                            <span class="text-success small pt-1 fw-bold">Total kas </span> <span class="text-muted small pt-2 ps-1">keseluruhan.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                            <span class="text-success small pt-1 fw-bold">Total </span> <span class="text-muted small pt-2 ps-1">pemasukan {{$ket}}</span>
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

        <!-- Jamaah -->
        <div class="col-sm-12 col-md-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Jamaah <span>| Keseluruhan</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$totalJamaah}}</h6>
                            <span class="text-primary small pt-1 fw-bold">Total </span><span class="text-muted small pt-2 ps-1">jamaah keseluruhan</span>
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
                    <h5 class="card-title">Update Cicilan Qurban Terbaru <span>| Keseluruhan</span></h5>

                    <table class="table datatable table-borderless">
                        <thead>
                            <tr>
                                <th>
                                    <b>N</b>ama Penanggung Jawab
                                </th>
                                <th style="width: 10%;">Status</th>
                                <th data-type="date" data-format="DD-MM-YYYY">Tanggal Mulai</th>
                                <th>Total Terbayar</th>
                                <th>Target Total</th>
                                <th style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($qurban as $q)
                            <tr>
                                <td>{{ $q->nama_penanggungjawab }}</td>
                                <td><a href="{{ route('admin.qurban.detail', ['id' => $q->id]) }}"><span class="badge {{ $q->status == 'Lunas' ? 'bg-success' : 'bg-warning' }}">{{ $q->status }}</span></a></td>
                                <td>{{ (new DateTime($q->tgl_mulai))->format('d-m-Y') }}</td>
                                <td>Rp. {{ number_format($q->detail_sum_nominal, 0, ',', '.') }},-</td>
                                <td>Rp. {{ number_format($q->total_target, 0, ',', '.') }},-</td>
                                <td>
                                    <div class="d-flex justify-content-center justify-items-center gap-2">
                                        <a href="{{ route('admin.qurban.detail', ['id' => $q->id]) }}">
                                            <button type="button" class="btn btn-sm btn-warning"><i class="fa-solid fa-bars-staggered"></i> Detail</button>
                                        </a>
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
</section>

@endsection