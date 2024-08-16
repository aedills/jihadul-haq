@extends('../components/layout')
@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    @include('../components/alert')
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Daftar Data Jamaah</h5>
                        @if($role == 'admin')
                        <div class="card-tool pt-3">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-plus"></i> Tambah</button>
                        </div>
                        @endif
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
                                <th>Status Hidup</th>
                                <th>Umur</th>
                                <th>Tempat Tanggal Lahir</th>
                                <th>Pekerjaan</th>
                                @if($role == 'admin')
                                <th>Aksi</th>
                                @endif
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
                                <td>{{ $list->hidup == 'ya' ? 'Hidup' : 'Meninggal Dunia' }}</td>
                                <td>{{ $list->umur }} Tahun</td>
                                <td>{{$list->tempat_lahir.', '.(new DateTime($list->tanggal_lahir))->format('d M Y')}}</td>
                                <td>{{ $list->pekerjaan }}</td>
                                @if($role == 'admin')
                                <td>
                                    <div class="d-flex justify-content-center justify-items-center gap-2">
                                        <a href="{{ route('admin.jamaah.edit', ['id' => $list->id]) }}">
                                            <button type="button" class="btn btn-sm btn-info"><i class="fa-solid fa-pencil"></i> Edit</button>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="{{$list->id}}" data-bs-nama="{{$list->nama}}"><i class="fa-solid fa-trash"></i> Hapus</button>
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
                    <h5 class="modal-title">Tambah Data Jamaah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" action="{{route('admin.jamaah.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3 mt-1">
                            <label for="nama_jamaah" class="col-sm-3 col-form-label">Nama Jamaah*</label>
                            <div class="col-sm-9">
                                <input id="nama_jamaah" name="nama_jamaah" type="text" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat*</label>
                            <div class="col-sm-9">
                                <input id="alamat" name="alamat" type="text" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="no_hp" class="col-sm-3 col-form-label">Nomor Hp/Wa*</label>
                            <div class="col-sm-9">
                                <input id="no_hp" name="no_hp" type="text" class="form-control" onkeypress="return isNumberKey(event)" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="gender">Jenis Kelamin*</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="gender" name="gender" required>
                                    <option selected value="" hidden>Pilih jenis kelamin</option>
                                    <option value="l">Laki-laki</option>
                                    <option value="p">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="hidup">Status Hidup</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="hidup" name="hidup" required>
                                    <option selected value="" hidden>Pilih status hidup</option>
                                    <option value="ya">Hidup</option>
                                    <option value="tidak">Meninggal Dunia</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input id="tempat_lahir" name="tempat_lahir" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input id="tanggal_lahir" name="tanggal_lahir" type="date" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                <input id="pekerjaan" name="pekerjaan" type="text" class="form-control">
                            </div>
                        </div>

                        <span style="font-style: italic; opacity: 0.8; font-size: smaller;">* : Data harus diisi.</span>

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
                    <h5 class="modal-title">Apakah Anda yakin untuk menghapus jamaah <strong></strong> ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form action="{{route('admin.jamaah.delete')}}" method="post" enctype="multipart/form-data" id="deleteForm">
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
                var nama = button.data('bs-nama');

                var modal = $(this);
                modal.find('.modal-title strong').text(nama);
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