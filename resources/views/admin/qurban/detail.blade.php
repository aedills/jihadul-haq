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
                            @if($role != 'ketua' && $role != 'admin')
                            @if($qurban->status == 'Lunas')
                            <button id="simpanCSV" class="btn btn-sm btn-primary">Cetak CSV</button>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Status pembayaran sudah lunas."><i class="fa-solid fa-plus"></i> Tambah</button>
                            @else
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-plus"></i> Tambah</button>
                            @endif
                            @endif
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
                                <th>Bukti Bayar</th>
                                @if($role != 'ketua' && $role != 'admin')
                                <th style="width: 20%;">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail as $list)
                            <tr>
                                <td>{{ $list->nama_pembayar }}</td>
                                <td>{{ (new DateTime($list->tgl_bayar))->format('d-m-Y') }}</td>
                                <td>Rp. {{ number_format($list->nominal, 0, ',', '.') }},-</td>
                                <td>
                                    <div class="d-flex justify-content-center justify-items-center">
                                        <a href="{{url('photos/buktibayar/'.$list->bukti)}}" target="_blank">
                                            <img src="{{url('photos/buktibayar/'.$list->bukti)}}" alt="{{$list->bukti}}" style="max-width: 60px;">
                                        </a>
                                    </div>
                                </td>
                                @if($role != 'ketua' && $role != 'admin')
                                <td>
                                    <div class="d-flex justify-content-center justify-items-center gap-2">
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-id="{{$list->id}}" data-bs-nama="{{$list->nama_pembayar}}" data-bs-tgl="{{$list->tgl_bayar}}" data-bs-nominal="{{$list->nominal}}"><i class="fa-solid fa-pencil"></i> Edit</button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="{{$list->id}}" data-bs-idq="{{$list->id_qurban}}" data-bs-nama="{{$list->nama_pembayar}}"><i class="fa-solid fa-trash"></i> Hapus</button>
                                    </div>
                                </td>
                                @endif
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

                        <div class="row mb-3 mt-1">
                            <label for="bukti" class="col-sm-3 col-form-label">Bukti Bayar</label>
                            <div class="col-sm-9">
                                <input id="bukti" name="bukti" type="file" class="form-control" required>
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

                        <div class="row mb-3 mt-1">
                            <label class="col-sm-3 col-form-label">Bukti Bayar</label>
                            <div class="col-sm-9">
                                <span style="font-style: italic; opacity: 0.8; font-size: smaller;">&nbsp;Anda tidak dapat mengubah bukti bayar.</span>
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

        document.getElementById('simpanCSV').addEventListener('click', function() {
            let table = document.querySelector('.datatable');
            let rows = table.querySelectorAll('tr');
            let csvContent = '';

            rows.forEach(function(row) {
                let cols = row.querySelectorAll('th, td');
                let csvRow = [];
                cols.forEach(function(col) {
                    csvRow.push('"' + col.innerText.trim() + '"');
                });
                csvContent += csvRow.join(',') + "\n";
            });

            let blob = new Blob([csvContent], {
                type: 'text/csv;charset=utf-8;'
            });
            let link = document.createElement('a');
            let url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', 'data.csv');
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
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