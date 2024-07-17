<!DOCTYPE html>
<html lang="en">

@include('../components/parts/head')

<body>
    @include('../components/parts/topbar')
    @include('../components/parts/sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{$page}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                    <li class="breadcrumb-item active">{{$path}}</li>
                </ol>
            </nav>
        </div>

        @yield('content')

    </main>

    @include('../components/parts/foot')
</body>

</html>