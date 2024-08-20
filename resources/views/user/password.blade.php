@extends('../user/layout')
@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    @include('../user/alert')
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Ubah Password Anda</h5>
                    </div>

                    <form action="{{route('user.cpass')}}" method="post" enctype="multipart/form-data" id="cpass">
                        @csrf
                        <div class="row mb-3">
                            <label for="pass_baru" class="col-sm-3 col-form-label">Password Baru</label>
                            <div class="col-sm-9">
                                <input id="pass_baru" name="pass_baru" type="password" class="form-control" required minlength="8">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="k_pass_baru" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
                            <div class="col-sm-9">
                                <input id="k_pass_baru" name="k_pass_baru" type="password" class="form-control" required minlength="8">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{route('dashboard')}}"><button type="button" class="btn btn-sm btn-secondary">Batal</button></a>
                    <button type="submit" form="cpass" class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection