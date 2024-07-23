@extends('../components/layout')
@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    @include('../components/alert')
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Daftar Data Qurban</h5>
                        <div class="card-tool pt-3">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-plus"></i> Tambah</button>
                        </div>
                    </div>

                    <table class="table datatable">
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
                                <td><span class="badge {{ $q->status == 'Lunas' ? 'bg-success' : 'bg-warning' }}">{{ $q->status }}</span></td>
                                <td>{{ (new DateTime($q->tgl_mulai))->format('d-m-Y') }}</td>
                                <td>Rp. {{ number_format($q->detail_sum_nominal, 0, ',', '.') }},-</td>
                                <td>Rp. {{ number_format($q->total_target, 0, ',', '.') }},-</td>
                                <td>
                                    <div class="d-flex justify-content-center justify-items-center gap-2">
                                        <a href="{{ route('admin.qurban.detail', ['id' => $q->id]) }}">
                                            <button type="button" class="btn btn-sm btn-warning"><i class="fa-solid fa-bars-staggered"></i> Detail</button>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-info" data-bs-id="{{$q->id}}" data-bs-pj="{{$q->nama_penanggungjawab}}" data-bs-tgl="{{$q->tgl_mulai}}" data-bs-total="{{$q->total_target}}" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa-solid fa-pencil"></i> Edit</button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-id="{{$q->id}}" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-trash"></i> Hapus</button>
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
                    <h5 class="modal-title">Tambah Data Qurban</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" action="{{route('admin.qurban.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3 mt-1">
                            <label for="penanggung_jawab" class="col-sm-3 col-form-label">Nama Penanggung Jawab</label>
                            <div class="col-sm-9">
                                <input id="penanggung_jawab" name="penanggung_jawab" type="text" class="form-control" maxlength="100" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                            <div class="col-sm-9">
                                <input id="tgl_mulai" name="tgl_mulai" type="date" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="total_target" class="col-sm-3 col-form-label">Total Target Pembayaran (Rp.)</label>
                            <div class="col-sm-9">
                                <input id="total_target" name="total_target" type="text" class="form-control" placeholder="Rp. 0" onkeypress="return isNumberKey(event)" required>
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

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="editModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Qurban</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="{{route('admin.qurban.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="editId" value="">
                        <div class="row mb-3 mt-1">
                            <label for="penanggung_jawab" class="col-sm-3 col-form-label">Nama Penanggung Jawab</label>
                            <div class="col-sm-9">
                                <input id="penanggung_jawab" name="penanggung_jawab" type="text" class="form-control" maxlength="100" required value="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                            <div class="col-sm-9">
                                <input id="tgl_mulai" name="tgl_mulai" type="date" class="form-control" required value="">
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="total_target" class="col-sm-3 col-form-label">Total Target Pembayaran (Rp.)</label>
                            <div class="col-sm-9">
                                <input id="total_target" name="total_target" type="text" class="form-control" placeholder="Rp. 0" onkeypress="return isNumberKey(event)" required value="">
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
                    <h5 class="modal-title">Apakah Anda yakin untuk menghapus data tersebut?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form action="{{route('admin.qurban.delete')}}" method="post" enctype="multipart/form-data" id="deleteForm">
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
            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('bs-id');
                var pj = button.data('bs-pj');
                var tgl = button.data('bs-tgl');
                var total = button.data('bs-total');

                var modal = $(this);
                modal.find('input[name="id"]').val(id);
                modal.find('input[name="penanggung_jawab"]').val(pj);
                modal.find('input[name="tgl_mulai"]').val(tgl);
                modal.find('input[name="total_target"]').val(total);
            });

            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('bs-id');

                var modal = $(this);
                modal.find('#id').val(id);
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