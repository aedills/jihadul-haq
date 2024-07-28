<!DOCTYPE html>
<html lang="en">

@include('../user/parts/head')

<body>
    @include('../user/parts/topbar')
    @include('../user/parts/sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <div class="d-flex align-items-center justify-content-between">
                <h1>{{$page}}</h1>

                @if($page == 'Dashboard')
                <select id="rangeFilter" class="form-select" aria-label="Pilih rentan waktu" style="width: 150px;" onchange="updatePage()">
                    <option {{ $range == '1week' ? 'selected' : '' }} value="1week">1 Pekan</option>
                    <option {{ $range == '2week' ? 'selected' : '' }} value="2week">2 Pekan</option>
                    <option {{ $range == '1month' ? 'selected' : '' }} value="1month">1 Bulan</option>
                    <option {{ $range == '3month' ? 'selected' : '' }} value="3month">3 Bulan</option>
                    <option {{ $range == '6month' ? 'selected' : '' }} value="6month">6 Bulan</option>
                    <option {{ $range == '1year' ? 'selected' : '' }} value="1year">1 Tahun</option>
                </select>

                <script>
                    $(document).ready(function() {
                        $('#rangeFilter').change(function() {
                            var range = $(this).val();
                            var url = '{{ route("user.home") }}?range=' + range;
                            window.location.href = url;
                        });
                    });
                </script>
                @endif
            </div>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                    <li class="breadcrumb-item active">{{$path}}</li>
                </ol>
            </nav>
        </div>

        @yield('content')

    </main>

    @include('../user/parts/foot')
</body>

</html>