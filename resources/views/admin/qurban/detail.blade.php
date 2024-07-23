@extends('../components/layout')
@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    @include('../components/alert')
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Daftar/Detail Pembayaran Qurban</h5>
                        <div class="card-tool pt-3">
                            <a href="{{ route('admin.qurban.index') }}"><button type="button" class="btn btn-sm btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</button></a>
                            @if($qurban->status == 'Lunas')
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Status pembayaran sudah lunas."><i class="fa-solid fa-plus"></i> Tambah</button>
                            @else
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-plus"></i> Tambah</button>
                            @endif
                        </div>
                    </div>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>
                                    <b>N</b>ama Pembayar
                                </th>
                                <th data-type="date" data-format="DD-MM-YYYY">Tanggal Bayar</th>
                                <th>Nominal</th>
                                <th style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail as $list)
                            <tr>
                                <td>{{ $list->nama_pembayar }}</td>
                                <td>{{ (new DateTime($list->tgl_bayar))->format('d-m-Y') }}</td>
                                <td>Rp. {{ number_format($list->nominal, 0, ',', '.') }},-</td>
                                <td>
                                    <div class="d-flex justify-content-center justify-items-center gap-2">
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-id="{{$list->id}}" data-bs-nama="{{$list->nama_pembayar}}" data-bs-tgl="{{$list->tgl_bayar}}" data-bs-nominal="{{$list->nominal}}"><i class="fa-solid fa-pencil"></i> Edit</button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="{{$list->id}}" data-bs-idq="{{$list->id_qurban}}" data-bs-nama="{{$list->nama_pembayar}}"><i class="fa-solid fa-trash"></i> Hapus</button>
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
                    <h5 class="modal-title">Tambah Data Detail Qurban</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" action="{{route('admin.qurban.detail.create')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" hidden name="id_q" value="{{$id_q}}">
                        <div class="row mb-3 mt-1">
                            <label for="nama_pembayar" class="col-sm-3 col-form-label">Nama Pembayar</label>
                            <div class="col-sm-9">
                                <input id="nama_pembayar" name="nama_pembayar" type="text" class="form-control" maxlength="100" required placeholder="Masukkan Nama Pembayar">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tgl_bayar" class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-sm-9">
                                <input id="tgl_bayar" name="tgl_bayar" type="date" class="form-control" required placeholder="Pilih Tanggal Pembayaran">
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="nominal" class="col-sm-3 col-form-label">Nominal (Rp.)</label>
                            <div class="col-sm-9">
                                <input id="nominal" name="nominal" type="text" class="form-control" placeholder="Contoh: 500000" onkeypress="return isNumberKey(event)" required>
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

    <!-- Modal Edit Data -->
    <div class="modal fade" id="editModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Detail Qurban</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="{{route('admin.qurban.detail.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" hidden name="id" value="">
                        <input type="text" hidden name="id_q" value="{{$id_q}}">
                        <div class="row mb-3 mt-1">
                            <label for="nama_pembayar" class="col-sm-3 col-form-label">Nama Pembayar</label>
                            <div class="col-sm-9">
                                <input id="nama_pembayar" name="nama_pembayar" type="text" class="form-control" maxlength="100" required placeholder="Masukkan Nama Pembayar" value="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tgl_bayar" class="col-sm-3 col-form-label">Tanggal Bayar</label>
                            <div class="col-sm-9">
                                <input id="tgl_bayar" name="tgl_bayar" type="date" class="form-control" required placeholder="Pilih tanggal pembayaran" value="">
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="nominal" class="col-sm-3 col-form-label">Nominal</label>
                            <div class="col-sm-9">
                                <input id="nominal" name="nominal" type="text" class="form-control" value="" placeholder="Rp. 0" onkeypress="return isNumberKey(event)" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="editForm" class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Apakah Anda yakin untuk menghapus data pembayaran <strong></strong> ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form action="{{route('admin.qurban.detail.delete')}}" method="post" enctype="multipart/form-data" id="deleteForm">
                        @csrf
                        <input type="text" hidden id="id" name="id" value="">
                        <input type="text" hidden id="idq" name="idq" value="">
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
            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('bs-id');
                var nama = button.data('bs-nama');
                var tgl = button.data('bs-tgl');
                var nominal = button.data('bs-nominal');

                var modal = $(this);
                modal.find('input[name="id"]').val(id);
                modal.find('input[name="nama_pembayar"]').val(nama);
                modal.find('input[name="tgl_bayar"]').val(tgl);
                modal.find('input[name="nominal"]').val(nominal);
            });

            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('bs-id');
                var idq = button.data('bs-idq');
                var ket = button.data('bs-nama');

                var modal = $(this);
                modal.find('.modal-title strong').text(ket);
                modal.find('#id').val(id);
                modal.find('#idq').val(idq);
            });
        });


        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
</section>

@endsection