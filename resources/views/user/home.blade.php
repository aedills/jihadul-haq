@extends('../user/layout')
@section('content')

<section class="section dashboard">

    <div class="row">
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
    </div>
</section>

@endsection