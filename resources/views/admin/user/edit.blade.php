@extends('../components/layout')
@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    @include('../components/alert')
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Edit Data User</h5>
                    </div>
                    <div class="mb-3">
                        <form id="editForm" action="{{route('admin.user.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="id" value="{{$user->id}}" hidden>
                            <div class="row mb-3 mt-1">
                                <label for="nama" class="col-sm-3 col-form-label">Nama<span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <input id="nama" name="nama" type="text" class="form-control" required value="{{$user->nama}}">
                                </div>
                            </div>

                            <div class="row mb-3 mt-1">
                                <label for="username" class="col-sm-3 col-form-label">Username<span style="color: red;">**</span></label>
                                <div class="col-sm-9">
                                    <input id="username" type="text" class="form-control" disabled value="{{$user->username}}">
                                </div>
                            </div>

                            <div class="row mb-3 mt-1">
                                <div class="col-sm-3">
                                    <label for="pass" class="col-form-label">Password</label><br>
                                    <span style="font-style: italic; opacity: 0.8; font-size: smaller;">Kosongkan jika tidak ingin mengubah.</span><br>
                                </div>
                                <div class="col-sm-9">
                                    <input id="pass" name="pass" type="password" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="role">Role<span style="color: red;">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="role" name="role" required>
                                        <option {{$user->role == 'admin' ? 'selected' : ''}} value="admin">admin</option>
                                        <option {{$user->role == 'ketua' ? 'selected' : ''}} value="ketua">Ketua Takmir</option>
                                        <option {{$user->role == 'bendahara' ? 'selected' : ''}} value="bendahara">Bendahara Takmir</option>
                                        <option {{$user->role == 'sekretaris' ? 'selected' : ''}} value="sekretaris">Sekretaris Takmir</option>
                                    </select>
                                </div>
                            </div>

                            <span style="font-style: italic; opacity: 0.8; font-size: smaller;"><span style="color: red;">*</span> : Data harus di isi.</span><br>
                            <span style="font-style: italic; opacity: 0.8; font-size: smaller;"><span style="color: red;">**</span> : Data tidak dapat di ubah.</span>

                        </form>
                    </div>
                    <div class="card-footer d-flex justify-content-end gap-2">
                        <a href="{{route('admin.user.index')}}"><button type="button" class="btn btn-sm btn-secondary">Kembali</button></a>
                        <button type="submit" form="editForm" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection