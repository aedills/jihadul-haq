@extends('../user/layout')
@section('content')
<section class="section dashboard">
    @include('../user/alert')
    <div class="row">
        <!-- Pemasukan -->
        <div class="col-sm-6">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Pemasukan <span>| Bulan ini</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>Rp. {{ $totalMonthIn ? number_format($totalMonthIn, 0, ',', '.') : '0' }},-</h6>
                                    <span class="text-success small pt-1 fw-bold">Total </span> <span class="text-muted small pt-2 ps-1">keseluruhan bulan ini</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Pemasukan <span>| Pekan ini</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>Rp. {{ $totalWeekIn ? number_format($totalWeekIn, 0, ',', '.') : '0' }},-</h6>
                                    <span class="text-success small pt-1 fw-bold">Total </span> <span class="text-muted small pt-2 ps-1">keseluruhan bulan ini</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Pengeluaran -->
        <div class="col-sm-6">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-6">
                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Pengeluaran <span>| Bulan ini</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>Rp. {{ $totalMonthOut ? number_format($totalMonthOut, 0, ',', '.') : '0' }},-</h6>
                                    <span class="text-danger small pt-1 fw-bold">{{ $totalMonthOut ? number_format(($totalMonthOut/$totalMonthIn) * 100, 1) : '0' }} %</span> <span class="text-muted small pt-2 ps-1">dari total kas bulan ini</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-6">
                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Pengeluaran <span>| Pekan ini</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>Rp. {{ $totalWeekOut ? number_format($totalWeekOut, 0, ',', '.') : '0' }},-</h6>
                                    <span class="text-danger small pt-1 fw-bold">{{ $totalWeekOut ? number_format(($totalWeekOut/$totalWeekIn) * 100, 1) : '0' }} %</span> <span class="text-muted small pt-2 ps-1">dari total kas pekan ini</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Pemasukan -->
        <div class="data-section col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Daftar Data Pemasukan</h5>
                    </div>

                    <!-- Tabel -->
                    <table class="table datatable table-responsive">
                        <thead>
                            <tr>
                                <th>
                                    <b>J</b>enis Pemasukan
                                </th>
                                <th data-type="date" data-format="DD-MM-YYYY">Tanggal</th>
                                <th>Nominal</th>
                                <th>Sumber Pemasukan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($income as $in)
                            <tr>
                                <td>{{ $in->jenis_pemasukan }}</td>
                                <td>{{ (new DateTime($in->tanggal))->format('d-m-Y') }}</td>
                                <td>Rp. {{ number_format($in->nominal, 0, ',', '.') }},-</td>
                                <td>{{ $in->sumber_pemasukan }}</td>
                                <td>{{ substr($in->keterangan, 0, 80) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pengeluaran -->
        <div class="data-section col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Daftar Data Pengeluaran</h5>
                    </div>

                    <!-- Tabel -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>
                                    <b>J</b>enis Pengeluaran
                                </th>
                                <th data-type="date" data-format="DD-MM-YYYY">Tanggal</th>
                                <th>Nominal</th>
                                <th>Tujuan Pengeluaran</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($outcome as $out)
                            <tr>
                                <td>{{ $out->jenis_pengeluaran }}</td>
                                <td>{{ (new DateTime($out->tanggal))->format('d-m-Y') }}</td>
                                <td>Rp. {{ number_format($out->nominal, 0, ',', '.') }},-</td>
                                <td>{{ $out->tujuan_pengeluaran }}</td>
                                <td>{{ substr($out->keterangan, 0, 80) }}</td>
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