<!DOCTYPE html>
<html lang="en">

@include('../components/parts/head')

<body>
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="{{route('log1n')}}" class="logo d-flex align-items-center w-auto">
                                    <span class="d-none d-lg-block">Manajemen Mesjid Jihadul Haq</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Masuk Sebagai Admin</h5>
                                        <p class="text-center small">Masukkan username & password untuk login</p>
                                    </div>

                                    @include('../components/alert')

                                    <form class="row g-3 needs-validation" novalidate method="post" action="{{route('doLogin')}}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" name="type" value="admin" hidden>
                                        <div class="col-12">
                                            <label for="username" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="username" class="form-control" id="username" required>
                                                <div class="invalid-feedback">Masukkan username Anda.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password" required>
                                            <div class="invalid-feedback">Masukkan password Anda!</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Login sebagai masyarakat/jamaah? <a href="{{url('login')}}">klik disini</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>

    <script src="{{url('/admin/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{url('/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('/admin/assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{url('/admin/assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{url('/admin/assets/vendor/quill/quill.min.js')}}"></script>
    <script src="{{url('/admin/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{url('/admin/assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{url('/admin/assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{url('/admin/assets/js/main.js')}}"></script>

</body>

</html>