@extends('../user/layout')
@section('content')
<style>
    .carousel-inner img {
        object-fit: cover;
        height: 400px;
    }
    .carousel-item img {
        border-radius: 15px;
    }
    .information h6 {
        font-size: 14px !important;
    }

</style>
<section class="section dashboard">
    <div class="row">
        <div class="col-12">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{url('/photos/bg1.jpg')}}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{url('/photos/bg2.jpg')}}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{url('/photos/bg3.jpg')}}" class="d-block w-100" alt="...">
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div><!-- End Slides with controls -->
        </div>
    </div>
    <div class="row mt-4 information">
        <!-- Total Kas -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Total Kas <span>| Keseluruhan</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>Rp. {{number_format($totalKas, 0, ',', '.')}},-</h6>
                            <span class="text-success small pt-1 fw-bold">Total kas </span> <span class="text-muted small pt-2 ps-1">keseluruhan.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pemasukan -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Pemasukan <span>| {{ucfirst($ket)}}</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>Rp. {{ $totalIn ? number_format($totalIn, 0, ',', '.') : '0' }},-</h6>
                            <span class="text-success small pt-1 fw-bold">Total </span> <span class="text-muted small pt-2 ps-1">pemasukan {{$ket}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengeluaran -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Pengeluaran <span>| {{ucfirst($ket)}}</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>Rp. {{ $totalOut ? number_format($totalOut, 0, ',', '.') : '0' }},-</h6>
                            <span class="text-danger small pt-1 fw-bold">{{ $totalOut ? number_format(($totalOut/$totalIn) * 100, 1) : '0' }} %</span> <span class="text-muted small pt-2 ps-1">dari total kas {{$ket}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jamaah -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Jamaah <span>| Keseluruhan</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$totalJamaah}}</h6>
                            <span class="text-primary small pt-1 fw-bold">Total </span><span class="text-muted small pt-2 ps-1">jamaah keseluruhan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">SEJARAH  MASJID JIHADUL HAQ BOTA</h5>
                    <div class="row">
                        <div class="col-md-8">
                            <p style="text-align: justify">Pada Tahun 1962 sebagian masyarakat suku adat tulta di daerah pegunungan  melakukan perjalanan hijrah kepesisir pantai yang berlokasi di bota untuk metetap dan melaksanakan usaha pertanian dan nelayan,setelah menetap setahun kemudian melakukan musyawara untuk membangun sebuah surau/langgar pada tahun 1964 dan pelaksanaan kegiatan salat/sembahyang berjalan.seiring berjalannya waktu dan perkembangan penduduk dan jamaah yang semakin hari semakin bertambah dan pusat pemerintahan desa yg dahulunya di Tulta dipindahkan ke bota  maka para pemuka agama dan masyarakat melakukan musyawarah untuk mendirikan sebuah masjid kecil  di bota pada tahun 1982  s/d tahun 1985 mesjid rampung dan dapat digunakan aktvitas keagamaan di dalamnya dan saat itulah nama mesjid ini dinamakan masjid jihadul haq bota.dalam perjalanan waktu dan semakin bertambahnya penduduk dan jumlah jamaah maka diadakan musyawarah untuk renovasi ulang yang di mulai dari tahun 1999/2000 dengan swadaya murni masyarakat dan dikerjakan bertahap dari tahun ke tahun dan sampai dengan  2024 pencapain fisik bangunan baru mencapai  70% dan sampai dengan saat ini masih berjalan kegiatan renovasi dan target yang sirencanakan sampai  tahun 2030  menjadi 100%. Itulah sejarah dan perencanaan Masjid jihadul haq bota</p>
                        </div>
                        <div class="col-md-4">
                            <img src="{{url('/photos/bg1.jpg')}}" class="img-fluid" style="border-radius: 10px">
                            <p class="text-muted mt-2">Masjid Jihadul Haq Bota</p>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</section>

@endsection