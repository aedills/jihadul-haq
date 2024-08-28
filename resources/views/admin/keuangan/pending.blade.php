@extends('../components/layout')
@section('content')
<section class="section dashboard">
    @include('../components/alert')

    <div class="row">
        <!-- Pengeluaran -->
        <div class="data-section col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between justify-items-center">
                        <h5 class="card-title">Daftar Data Pengeluaran (Belum Disetujui)</h5>
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
                                    <a href="{{route('admin.keuangan.pending.approve', ['id' => $out->id])}}"><button type="button" class="btn btn-sm btn-info">Approve</button></a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteOutcomeModal" data-bs-id="{{$out->id}}">Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            $('#deleteOutcomeModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('bs-id');

                var modal = $(this);
                modal.find('input[name="id"]').val(id);
            });
        });
    </script>
</section>
@endsection