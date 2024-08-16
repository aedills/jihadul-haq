@extends('../components/layout')
@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    @include('../components/alert')
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Edit Data Jamaah</h5>
                    </div>

                    <form id="editForm" action="{{route('admin.jamaah.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" id="id" name="id" value="{{$jamaah->id}}" hidden>
                        <div class="row mb-3 mt-1">
                            <label for="nama_jamaah" class="col-sm-3 col-form-label">Nama Jamaah*</label>
                            <div class="col-sm-9">
                                <input id="nama_jamaah" name="nama_jamaah" type="text" class="form-control" required value="{{$jamaah->nama}}">
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat*</label>
                            <div class="col-sm-9">
                                <input id="alamat" name="alamat" type="text" class="form-control" required value="{{$jamaah->alamat}}">
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="no_hp" class="col-sm-3 col-form-label">Nomor Hp/Wa*</label>
                            <div class="col-sm-9">
                                <input id="no_hp" name="no_hp" type="text" class="form-control" onkeypress="return isNumberKey(event)" required value="{{$jamaah->no_hp}}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="gender">Jenis Kelamin*</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="l" {{$jamaah->gender == 'l' ? 'selected' : ''}}>Laki-laki</option>
                                    <option value="p" {{$jamaah->gender == 'p' ? 'selected' : ''}}>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="hidup">Status Hidup</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="hidup" name="hidup" required>
                                    <option value="ya" {{$jamaah->hidup == 'ya' ? 'selected' : ''}}>Hidup</option>
                                    <option value="tidak" {{$jamaah->hidup == 'tidak' ? 'selected' : ''}}>Meninggal Dunia</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input id="tempat_lahir" name="tempat_lahir" type="text" class="form-control" value="{{$jamaah->tempat_lahir}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input id="tanggal_lahir" name="tanggal_lahir" type="date" class="form-control" value="{{$jamaah->tanggal_lahir}}">
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                <input id="pekerjaan" name="pekerjaan" type="text" class="form-control" value="{{$jamaah->pekerjaan}}">
                            </div>
                        </div>

                        @if($jamaah->foto == 'default.png')
                        <div class="row mb-3 mt-1">
                            <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9">
                                <input id="foto" name="foto" type="file" class="form-control">
                            </div>
                        </div>
                        @else
                        <div class="row mb-3 mt-3">
                            <div class="col-sm-3">
                                <label class="col-form-label">Foto</label><br>
                                <span style="font-style: italic; opacity: 0.8; font-size: smaller;">Anda tidak dapat mengubah foto.</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="d-flex justify-content-start justify-items-center mt-1">
                                    <a href="{{url('photos/'.$jamaah->foto)}}" target="_blank">
                                        <img src="{{url('photos/'.$jamaah->foto)}}" alt="{{$jamaah->foto}}" style="max-width: 150px; border-radius: 6px;">
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <span style="font-style: italic; opacity: 0.8; font-size: smaller;">* : Data tidak boleh dikosongkan.</span>

                    </form>
                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{route('admin.jamaah.index')}}"><button type="button" class="btn btn-sm btn-secondary">Kembali</button></a>
                    <button type="submit" form="editForm" class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection