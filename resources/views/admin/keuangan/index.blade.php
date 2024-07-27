@extends('../components/layout')
@section('content')
<section class="section dashboard">
    @include('../components/alert')
    <div class="row">
        <!-- Pemasukan -->
        <div class="col-sm-6">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Pemasukan <span>| Bulan ini</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>Rp. {{ $totalMonthIn ? number_format($totalMonthIn, 0, ',', '.') : '0' }},-</h6>
                                    <span class="text-success small pt-1 fw-bold">82%</span> <span class="text-muted small pt-2 ps-1">lebih banyak dari bulan lalu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Pemasukan <span>| Pekan ini</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>Rp. {{ $totalWeekIn ? number_format($totalWeekIn, 0, ',', '.') : '0' }},-</h6>
                                    <span class="text-success small pt-1 fw-bold">23%</span> <span class="text-muted small pt-2 ps-1">lebih banyak dari pekan lalu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Pengeluaran -->
        <div class="col-sm-6">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-6">
                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Pengeluaran <span>| Bulan ini</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>Rp. {{ $totalMonthOut ? number_format($totalMonthOut, 0, ',', '.') : '0' }},-</h6>
                                    <span class="text-danger small pt-1 fw-bold">{{ $totalMonthOut ? number_format(($totalMonthOut/$totalMonthIn) * 100, 1) : '0' }} %</span> <span class="text-muted small pt-2 ps-1">dari total kas bulan ini</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-6">
                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Pengeluaran <span>| Pekan ini</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>Rp. {{ $totalWeekOut ? number_format($totalWeekOut, 0, ',', '.') : '0' }},-</h6>
                                    <span class="text-danger small pt-1 fw-bold">{{ $totalWeekOut ? number_format(($totalWeekOut/$totalWeekIn) * 100, 1) : '0' }} %</span> <span class="text-muted small pt-2 ps-1">dari total kas pekan ini</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Pemasukan -->
        <div class="data-section col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Daftar Data Pemasukan</h5>
                        <div class="card-tool pt-3">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addIncomeModal"><i class="fa-solid fa-plus"></i> Tambah</button>
                        </div>
                    </div>

                    <!-- Tabel -->
                    <table class="table datatable table-responsive">
                        <thead>
                            <tr>
                                <th>
                                    <b>J</b>enis Pemasukan
                                </th>
                                <th data-type="date" data-format="DD-MM-YYYY">Tanggal</th>
                                <th>Nominal</th>
                                <th>Sumber Pemasukan</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($income as $in)
                            <tr>
                                <td>{{ $in->jenis_pemasukan }}</td>
                                <td>{{ (new DateTime($in->tanggal))->format('d-m-Y') }}</td>
                                <td>Rp. {{ number_format($in->nominal, 0, ',', '.') }},-</td>
                                <td>{{ $in->sumber_pemasukan }}</td>
                                <td>{{ substr($in->keterangan, 0, 80) }}</td>
                                <td class="d-flex justify-content-center justify-items-center gap-1">
                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#editIncomeModal" data-bs-id="{{$in->id}}" data-bs-jenis="{{$in->jenis_pemasukan}}" data-bs-tgl="{{$in->tanggal}}" data-bs-nominal="{{$in->nominal}}" data-bs-sumber="{{$in->sumber_pemasukan}}" data-bs-ket="{{$in->keterangan}}">Edit</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteIncomeModal" data-bs-id="{{$in->id}}">Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pengeluaran -->
        <div class="data-section col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Daftar Data Pengeluaran</h5>
                        <div class="card-tool pt-3">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addOutcomeModal"><i class="fa-solid fa-plus"></i> Tambah</button>
                        </div>
                    </div>

                    <!-- Tabel -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>
                                    <b>J</b>enis Pengeluaran
                                </th>
                                <th data-type="date" data-format="DD-MM-YYYY">Tanggal</th>
                                <th>Nominal</th>
                                <th>Tujuan Pengeluaran</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($outcome as $out)
                            <tr>
                                <td>{{ $out->jenis_pengeluaran }}</td>
                                <td>{{ (new DateTime($out->tanggal))->format('d-m-Y') }}</td>
                                <td>Rp. {{ number_format($out->nominal, 0, ',', '.') }},-</td>
                                <td>{{ $out->tujuan_pengeluaran }}</td>
                                <td>{{ substr($out->keterangan, 0, 80) }}</td>
                                <td class="d-flex justify-content-center justify-items-center gap-1">
                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#editOutcomeModal" data-bs-id="{{$out->id}}" data-bs-jenis="{{$out->jenis_pengeluaran}}" data-bs-tgl="{{$out->tanggal}}" data-bs-nominal="{{$out->nominal}}" data-bs-tujuan="{{$out->tujuan_pengeluaran}}" data-bs-ket="{{$out->keterangan}}">Edit</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteOutcomeModal" data-bs-id="{{$out->id}}">Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Income Modal -->
    <div class="income-modal">
        <!-- Add Income Modal -->
        <div class="modal fade" id="addIncomeModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Pemasukan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addIncomeForm" action="{{route('admin.keuangan.storeIn')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="jenis_pemasukan">Jenis Pemasukan</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="jenis_pemasukan" name="jenis_pemasukan" required>
                                        <option selected hidden value="">Pilih Jenis Pemasukan</option>
                                        <option value="Donasi">Donasi</option>
                                        <option value="Infaq">Infaq</option>
                                        <option value="Zakat">Zakat</option>
                                        <option value="Sumbangan">Sumbangan</option>
                                        <option value="Penjualan">Penjualan</option>
                                        <option value="Kegiatan Galang Dana">Kegiatan Galang Dana</option>
                                        <option value="Wakaf">Wakaf</option>
                                        <option value="Sponsor Kegiatan">Sponsor Kegiatan</option>
                                        <option value="Pengembalian Pinjaman">Pengembalian Pinjaman</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tanggal_in" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input id="tanggal_in" name="tanggal_in" type="date" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3 mt-1">
                                <label for="nominal_in" class="col-sm-3 col-form-label">Nominal (Rp.)</label>
                                <div class="col-sm-9">
                                    <input id="nominal_in" name="nominal_in" type="text" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Contoh: 1500000" required>
                                </div>
                            </div>

                            <div class="row mb-3 mt-1">
                                <label for="sumber_pemasukan" class="col-sm-3 col-form-label">Sumber Pemasukan</label>
                                <div class="col-sm-9">
                                    <input id="sumber_pemasukan" name="sumber_pemasukan" type="text" class="form-control" placeholder="Masukkan Sumber Dana" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="keterangan_in" class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <textarea id="keterangan_in" name="keterangan_in" class="form-control" style="height: 70px"></textarea>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" form="addIncomeForm" class="btn btn-sm btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Income Modal -->
        <div class="modal fade" id="editIncomeModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Pemasukan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editIncomeForm" action="{{route('admin.keuangan.updateIn')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="id" hidden value="">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="jenis_pemasukan">Jenis Pemasukan</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="jenis_pemasukan" name="jenis_pemasukan" required value="">
                                        <option selected hidden value="">Pilih Jenis Pemasukan</option>
                                        <option value="Donasi">Donasi</option>
                                        <option value="Infaq">Infaq</option>
                                        <option value="Zakat">Zakat</option>
                                        <option value="Sumbangan">Sumbangan</option>
                                        <option value="Penjualan">Penjualan</option>
                                        <option value="Kegiatan Galang Dana">Kegiatan Galang Dana</option>
                                        <option value="Wakaf">Wakaf</option>
                                        <option value="Sponsor Kegiatan">Sponsor Kegiatan</option>
                                        <option value="Pengembalian Pinjaman">Pengembalian Pinjaman</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tanggal_in" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input id="tanggal_in" name="tanggal_in" type="date" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3 mt-1">
                                <label for="nominal_in" class="col-sm-3 col-form-label">Nominal (Rp.)</label>
                                <div class="col-sm-9">
                                    <input id="nominal_in" name="nominal_in" type="text" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Contoh: 1500000" required>
                                </div>
                            </div>

                            <div class="row mb-3 mt-1">
                                <label for="sumber_pemasukan" class="col-sm-3 col-form-label">Sumber Pemasukan</label>
                                <div class="col-sm-9">
                                    <input id="sumber_pemasukan" name="sumber_pemasukan" type="text" class="form-control" placeholder="Masukkan Sumber Dana" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="keterangan_in" class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <textarea id="keterangan_in" name="keterangan_in" class="form-control" style="height: 70px"></textarea>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" form="editIncomeForm" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Income Modal -->
        <div class="modal fade" id="deleteIncomeModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Apakah Anda yakin untuk menghapus data pemasukan tersebut?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <form action="{{route('admin.keuangan.deleteIn')}}" method="post" enctype="multipart/form-data" id="deleteIncomeForm">
                            @csrf
                            <input type="text" hidden id="id" name="id" value="">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" form="deleteIncomeForm" class="btn btn-sm btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#editIncomeModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('bs-id');
                    var jenis = button.data('bs-jenis');
                    var tgl = button.data('bs-tgl');
                    var nominal = button.data('bs-nominal');
                    var sumber = button.data('bs-sumber');
                    var ket = button.data('bs-ket');

                    var modal = $(this);
                    modal.find('input[name="id"]').val(id);
                    modal.find('select[name="jenis_pemasukan"]').val(jenis);
                    modal.find('input[name="tanggal_in"]').val(tgl);
                    modal.find('input[name="nominal_in"]').val(nominal);
                    modal.find('input[name="sumber_pemasukan"]').val(sumber);
                    modal.find('textarea[name="keterangan_in"]').val(ket);
                });

                $('#deleteIncomeModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('bs-id');

                    var modal = $(this);
                    modal.find('input[name="id"]').val(id);
                });
            });
        </script>
    </div>


    <!-- Outcome Modal -->
    <div class="outcome-modal">
        <!-- Add Outcome Modal -->
        <div class="modal fade" id="addOutcomeModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Pengeluaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addOutcomeForm" action="{{route('admin.keuangan.storeOut')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="jenis_pengeluaran">Jenis Pengeluaran</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="jenis_pengeluaran" name="jenis_pengeluaran" required>
                                        <option selected hidden value="">Pilih Jenis Pengeluaran</option>
                                        <option value="Biaya Operasional">Biaya Operasional</option>
                                        <option value="Pembayaran Listrik">Pembayaran Listrik</option>
                                        <option value="Pembayaran Air">Pembayaran Air</option>
                                        <option value="Perawatan Bangunan">Perawatan Bangunan</option>
                                        <option value="Pembelian Alat Ibadah">Pembelian Alat Ibadah</option>
                                        <option value="Pembayaran Gaji Staf">Pembayaran Gaji Staf</option>
                                        <option value="Biaya Kegiatan">Biaya Kegiatan</option>
                                        <option value="Sumbangan Sosial">Sumbangan Sosial</option>
                                        <option value="Pembayaran Pajak">Pembayaran Pajak</option>
                                        <option value="Pembelian Bahan Makanan">Pembelian Bahan Makanan</option>
                                        <option value="Biaya Administrasi">Biaya Administrasi</option>
                                        <option value="Pembayaran Hutang">Pembayaran Hutang</option>
                                        <option value="Biaya Promosi dan Publikasi">Biaya Promosi dan Publikasi</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tanggal_out" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input id="tanggal_out" name="tanggal_out" type="date" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3 mt-1">
                                <label for="nominal_out" class="col-sm-3 col-form-label">Nominal (Rp.)</label>
                                <div class="col-sm-9">
                                    <input id="nominal_out" name="nominal_out" type="text" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Contoh: 1500000" required>
                                </div>
                            </div>

                            <div class="row mb-3 mt-1">
                                <label for="tujuan_pengeluaran" class="col-sm-3 col-form-label">Tujuan Pengeluaran</label>
                                <div class="col-sm-9">
                                    <input id="tujuan_pengeluaran" name="tujuan_pengeluaran" type="text" class="form-control" placeholder="Masukkan tujaun pengeluaran dana" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="keterangan_out" class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <textarea id="keterangan_out" name="keterangan_out" class="form-control" style="height: 70px"></textarea>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" form="addOutcomeForm" class="btn btn-sm btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Income Modal -->
        <div class="modal fade" id="editOutcomeModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Pengeluaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editOutcomeForm" action="{{route('admin.keuangan.updateOut')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="id" hidden value="">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="jenis_pengeluaran">Jenis Pengeluaran</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="jenis_pengeluaran" name="jenis_pengeluaran" required value="">
                                        <option selected hidden value="">Pilih Jenis Pengeluaran</option>
                                        <option value="Biaya Operasional">Biaya Operasional</option>
                                        <option value="Pembayaran Listrik">Pembayaran Listrik</option>
                                        <option value="Pembayaran Air">Pembayaran Air</option>
                                        <option value="Perawatan Bangunan">Perawatan Bangunan</option>
                                        <option value="Pembelian Alat Ibadah">Pembelian Alat Ibadah</option>
                                        <option value="Pembayaran Gaji Staf">Pembayaran Gaji Staf</option>
                                        <option value="Biaya Kegiatan">Biaya Kegiatan</option>
                                        <option value="Sumbangan Sosial">Sumbangan Sosial</option>
                                        <option value="Pembayaran Pajak">Pembayaran Pajak</option>
                                        <option value="Pembelian Bahan Makanan">Pembelian Bahan Makanan</option>
                                        <option value="Biaya Administrasi">Biaya Administrasi</option>
                                        <option value="Pembayaran Hutang">Pembayaran Hutang</option>
                                        <option value="Biaya Promosi dan Publikasi">Biaya Promosi dan Publikasi</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tanggal_out" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input id="tanggal_out" name="tanggal_out" type="date" class="form-control" required value="">
                                </div>
                            </div>

                            <div class="row mb-3 mt-1">
                                <label for="nominal_out" class="col-sm-3 col-form-label">Nominal (Rp.)</label>
                                <div class="col-sm-9">
                                    <input id="nominal_out" name="nominal_out" type="text" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Contoh: 1500000" required value="">
                                </div>
                            </div>

                            <div class="row mb-3 mt-1">
                                <label for="tujuan_pengeluaran" class="col-sm-3 col-form-label">Tujuan Pengeluaran</label>
                                <div class="col-sm-9">
                                    <input id="tujuan_pengeluaran" name="tujuan_pengeluaran" type="text" class="form-control" placeholder="Tujuan pengeluaran dana" required value="">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="keterangan_out" class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <textarea id="keterangan_out" name="keterangan_out" class="form-control" style="height: 70px"></textarea>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" form="editOutcomeForm" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Income Modal -->
        <div class="modal fade" id="deleteOutcomeModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Apakah Anda yakin untuk menghapus data pengeluaran tersebut?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <form action="{{route('admin.keuangan.deleteOut')}}" method="post" enctype="multipart/form-data" id="deleteOutcomeForm">
                            @csrf
                            <input type="text" hidden id="id" name="id" value="">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" form="deleteOutcomeForm" class="btn btn-sm btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#editOutcomeModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('bs-id');
                    var jenis = button.data('bs-jenis');
                    var tgl = button.data('bs-tgl');
                    var nominal = button.data('bs-nominal');
                    var tujuan = button.data('bs-tujuan');
                    var ket = button.data('bs-ket');

                    var modal = $(this);
                    modal.find('input[name="id"]').val(id);
                    modal.find('select[name="jenis_pengeluaran"]').val(jenis);
                    modal.find('input[name="tanggal_out"]').val(tgl);
                    modal.find('input[name="nominal_out"]').val(nominal);
                    modal.find('input[name="tujuan_pengeluaran"]').val(tujuan);
                    modal.find('textarea[name="keterangan_out"]').val(ket);
                });

                $('#deleteOutcomeModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('bs-id');

                    var modal = $(this);
                    modal.find('input[name="id"]').val(id);
                });
            });
        </script>
    </div>

    <script>
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