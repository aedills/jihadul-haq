@extends('../components/layout')
@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    @include('../components/alert')
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Daftar Data Kegiatan</h5>
                        <div class="card-tool p-3">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-plus"></i> Tambah</button>
                        </div>
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
                                <th>Aksi</th>
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
                                <td>
                                    <div class="d-flex justify-content-center justify-items-center gap-2">
                                        <a href="{{route('admin.kegiatan.edit', ['id' => $list->id])}}">
                                            <button type="button" class="btn btn-sm btn-info"><i class="fa-solid fa-pencil"></i> Edit</button>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="{{$list->id}}" data-bs-ket="{{$list->nama_kegiatan}}"><i class="fa-solid fa-trash"></i> Hapus</button>
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

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="addModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" action="{{route('admin.kegiatan.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3 mt-1">
                            <label for="nama_kegiatan" class="col-sm-3 col-form-label">Nama Kegiatan</label>
                            <div class="col-sm-9">
                                <input id="nama_kegiatan" name="nama_kegiatan" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea id="keterangan" name="keterangan" class="form-control" style="height: 70px"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                            <div class="col-sm-9">
                                <input id="tgl_mulai" name="tgl_mulai" type="date" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tgl_selesai" class="col-sm-3 col-form-label">Tanggal Selesai</label>
                            <div class="col-sm-9">
                                <input id="tgl_selesai" name="tgl_selesai" type="date" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="lokasi" class="col-sm-3 col-form-label">Lokasi Kegiatan</label>
                            <div class="col-sm-9">
                                <input id="lokasi" name="lokasi" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="pj" class="col-sm-3 col-form-label">Penanggung Jawab</label>
                            <div class="col-sm-9">
                                <input id="pj" name="pj" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="status">Status</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="status" name="status">
                                    <option selected hidden>Pilih status</option>
                                    <option value="direncanakan">Direncanakan</option>
                                    <option value="berlangsung">Berlangsung</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="dibatalkan">Dibatalkan</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="addForm" class="btn btn-sm btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Apakah Anda yakin untuk menghapus kegiatan <strong></strong> ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form action="{{route('admin.kegiatan.delete')}}" method="post" enctype="multipart/form-data" id="deleteForm">
                        @csrf
                        <input type="text" hidden id="id" name="id" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="deleteForm" class="btn btn-sm btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('bs-id');
                var ket = button.data('bs-ket');

                var modal = $(this);
                modal.find('.modal-title strong').text(ket);
                modal.find('#id').val(id);
            });
        });
    </script>
</section>

@endsection