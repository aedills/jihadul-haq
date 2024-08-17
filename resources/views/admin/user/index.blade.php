@extends('../components/layout')
@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    @include('../components/alert')
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Daftar Data User</h5>
                        @if($role == 'admin')
                        <div class="card-tool pt-3">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-plus"></i> Tambah</button>
                        </div>
                        @endif
                    </div>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>
                                    <b>N</b>ama
                                </th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
                                @if($role == 'admin')
                                <th style="width: 20%;">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $list)
                            <tr>
                                <td>{{$list->nama}}</td>
                                <td>{{$list->username}}</td>
                                <td>Pass</td>
                                <td>{{ucfirst($list->role)}}</td>
                                @if($role == 'admin')
                                <td>
                                    <div class="d-flex justify-content-center justify-items-center gap-2">
                                        <a href="{{route('admin.user.edit', ['id' => $list->id])}}">
                                            <button type="button" class="btn btn-sm btn-info"><i class="fa-solid fa-pencil"></i> Edit</button>
                                        </a>
                                        @if($list->username == 'admin')
                                        <button type="button" class="btn btn-sm btn-danger" disabled><i class="fa-solid fa-trash"></i> Hapus</button>
                                        @else
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="{{$list->id}}" data-bs-ket="{{$list->nama}}"><i class="fa-solid fa-trash"></i> Hapus</button>
                                        @endif
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
                    <h5 class="modal-title">Tambah Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3 mt-1">
                            <label for="nama" class="col-sm-3 col-form-label">Nama*</label>
                            <div class="col-sm-9">
                                <input id="nama" name="nama" type="text" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="username" class="col-sm-3 col-form-label">Username*</label>
                            <div class="col-sm-9">
                                <input id="username" name="username" type="text" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="pass" class="col-sm-3 col-form-label">Password*</label>
                            <div class="col-sm-9">
                                <input id="pass" name="pass" type="password" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="role">Role*</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="role" name="role" required>
                                    <option selected value="" hidden>-</option>
                                    <option value="admin">admin</option>
                                    <option value="ketua">Ketua Takmir</option>
                                    <option value="bendahara">Bendahara Takmir</option>
                                </select>
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
                    <h5 class="modal-title">Apakah Anda yakin untuk menghapus user <strong></strong> ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form action="{{route('admin.user.delete')}}" method="post" enctype="multipart/form-data" id="deleteForm">
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