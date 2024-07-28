@extends('../user/layout')
@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    @include('../user/alert')
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Daftar/Detail Pembayaran Qurban</h5>
                        <div class="card-tool pt-3">
                            <a href="{{ route('user.qurban') }}"><button type="button" class="btn btn-sm btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</button></a>
                        </div>
                    </div>
                    <div>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-md-3"><strong>Penanggung Jawab</strong></div>
                                    <div class="col-sm-8 col-md-9">{{ $qurban->nama_penanggungjawab }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-md-3"><strong>Status</strong></div>
                                    <div class="col-sm-8 col-md-9"><span class="badge {{ $qurban->status == 'Lunas' ? 'bg-success' : 'bg-warning' }}">{{ $qurban->status }}</span></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-md-3"><strong>Tanggal Mulai</strong></div>
                                    <div class="col-sm-8 col-md-9">{{ (new DateTime($qurban->tgl_mulai))->format('d-m-Y') }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-md-3"><strong>Terbayar</strong></div>
                                    <div class="col-sm-8 col-md-9">Rp. {{ number_format($terbayar, 0, ',', '.') }},-</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-md-3"><strong>Belum Terbayar</strong></div>
                                    <div class="col-sm-8 col-md-9" style="color: red;">Rp. {{ number_format($qurban->total_target - $terbayar, 0, ',', '.') }},-</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-md-3"><strong>Total Target</strong></div>
                                    <div class="col-sm-8 col-md-9">Rp. {{ number_format($qurban->total_target, 0, ',', '.') }},-</div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>
                                    <b>N</b>ama Pembayar
                                </th>
                                <th data-type="date" data-format="DD-MM-YYYY">Tanggal Bayar</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail as $list)
                            <tr>
                                <td>{{ $list->nama_pembayar }}</td>
                                <td>{{ (new DateTime($list->tgl_bayar))->format('d-m-Y') }}</td>
                                <td>Rp. {{ number_format($list->nominal, 0, ',', '.') }},-</td>
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