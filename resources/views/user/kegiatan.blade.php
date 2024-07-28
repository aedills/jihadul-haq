@extends('../user/layout')
@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    @include('../user/alert')
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Daftar Data Kegiatan</h5>
                    </div>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>
                                    <b>N</b>ama Kegiatan
                                </th>
                                <th>Keterangan</th>
                                <th data-type="date" data-format="DD-MM-YYYY">Tanggal Mulai</th>
                                <th data-type="date" data-format="DD-MM-YYYY">Tanggal Selesai</th>
                                <th>Lokasi</th>
                                <th>Penanggung Jawab</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kegiatan as $list)
                            <tr>
                                <td>{{$list->nama_kegiatan}}</td>
                                <td>{{substr($list->keterangan, 0, 20)}}</td>
                                <td>{{$list->tanggal_mulai}}</td>
                                <td>{{$list->tanggal_selesai}}</td>
                                <td>{{$list->lokasi}}</td>
                                <td>{{$list->penanggung_jawab}}</td>
                                <td>{{ucfirst($list->status)}}</td>
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