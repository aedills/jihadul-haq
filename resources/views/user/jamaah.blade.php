@extends('../user/layout')
@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    @include('../user/alert')
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Daftar Data Jamaah</h5>
                    </div>
                    <div>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-md-3"><strong>Jumlah Total Jamaah</strong></div>
                                    <div class="col-sm-8 col-md-9">: {{$total}} orang</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-md-3"><strong>Jamaah Laki-laki</strong></div>
                                    <div class="col-sm-8 col-md-9">: {{$l}} orang <span style="font-style: italic; opacity: 0.8; font-size: small;">{{$total > 0 ? ($l / $total) * 100 : 0}} %</span></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-md-3"><strong>Jamaah Perempuan</strong></div>
                                    <div class="col-sm-8 col-md-9">: {{$p}} orang <span style="font-style: italic; opacity: 0.8; font-size: small;">{{$total > 0 ? ($p / $total) * 100 : 0}} %</span></div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>
                                    <b>N</b>ama
                                </th>
                                <th>Alamat Rumah</th>
                                <th>No. HP/WA</th>
                                <th>Jenis Kelamin</th>
                                <th>Usia</th>
                                <th>Tempat Tanggal Lahir</th>
                                <th>Pekerjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jamaah as $list)
                            <tr>
                                <td>{{ $list->nama }}</td>
                                <td>{{ substr($list->alamat, 0, 20) }}</td>
                                <td>{{ $list->no_hp }}</td>
                                <td>
                                    @if($list->gender == 'l')
                                    <span class="badge bg-warning"><i class="bi bi-gender-male me-1"></i> Laki-laki</span>
                                    @elseif($list->gender == 'p')
                                    <span class="badge bg-info"><i class="bi bi-gender-female me-1"></i> Perempuan</span>
                                    @endif
                                </td>
                                <td>{{ $list->umur }} Tahun</td>
                                <td>{{$list->tempat_lahir.', '.(new DateTime($list->tanggal_lahir))->format('d M Y')}}</td>
                                <td>{{ $list->pekerjaan }}</td>
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