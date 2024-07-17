@extends('../components/layout')
@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    @include('../components/alert')
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Edit Data Kegiatan</h5>
                    </div>

                    <form id="editForm" action="{{route('admin.kegiatan.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" id="id" name="id" value="{{$kegiatan->id}}" hidden>
                        <div class="row mb-3 mt-1">
                            <label for="nama_kegiatan" class="col-sm-3 col-form-label">Nama Kegiatan</label>
                            <div class="col-sm-9">
                                <input id="nama_kegiatan" name="nama_kegiatan" type="text" class="form-control" value="{{ old('nama_kegiatan') ? old('nama_kegiatan') : $kegiatan->nama_kegiatan }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea id="keterangan" name="keterangan" class="form-control" style="height: 70px">{{ old('keterangan') ? old('keterangan') : $kegiatan->keterangan }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                            <div class="col-sm-9">
                                <input id="tgl_mulai" name="tgl_mulai" type="date" class="form-control" value="{{ old('tgl_mulai') ? old('tgl_mulai') : $kegiatan->tanggal_mulai }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tgl_selesai" class="col-sm-3 col-form-label">Tanggal Selesai</label>
                            <div class="col-sm-9">
                                <input id="tgl_selesai" name="tgl_selesai" type="date" class="form-control" value="{{ old('tgl_selesai') ? old('tgl_selesai') : $kegiatan->tanggal_selesai }}">
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="lokasi" class="col-sm-3 col-form-label">Lokasi Kegiatan</label>
                            <div class="col-sm-9">
                                <input id="lokasi" name="lokasi" type="text" class="form-control" value="{{ old('lokasi') ? old('lokasi') : $kegiatan->lokasi }}">
                            </div>
                        </div>

                        <div class="row mb-3 mt-1">
                            <label for="pj" class="col-sm-3 col-form-label">Penanggung Jawab</label>
                            <div class="col-sm-9">
                                <input id="pj" name="pj" type="text" class="form-control" value="{{ old('pj') ? old('pj') : $kegiatan->penanggung_jawab }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="status">Status</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="status" name="status">
                                    <option selected hidden>Pilih status</option>
                                    <option {{$kegiatan->status == 'direncanakan' ? 'selected' : ''}} value="direncanakan">Direncanakan</option>
                                    <option {{$kegiatan->status == 'berlangsung' ? 'selected' : ''}} value="berlangsung">Berlangsung</option>
                                    <option {{$kegiatan->status == 'selesai' ? 'selected' : ''}} value="selesai">Selesai</option>
                                    <option {{$kegiatan->status == 'dibatalkan' ? 'selected' : ''}} value="dibatalkan">Dibatalkan</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{route('admin.kegiatan.index')}}"><button type="button" class="btn btn-sm btn-secondary">Kembali</button></a>
                    <button type="submit" form="editForm" class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection