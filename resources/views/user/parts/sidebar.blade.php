<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.home') ? '' : 'collapsed' }}" href="{{route('user.home')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">Data Master</li>

        @if(session('data'))
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.qurban') ? '' : 'collapsed' }}" href="{{route('user.qurban')}}">
                <i class="bi bi-circle"></i>
                <span>Qurban</span>
            </a>
        </li>
        @endif

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.kegiatan') ? '' : 'collapsed' }}" href="{{route('user.kegiatan')}}">
                <i class="bi bi-circle"></i>
                <span>Kegiatan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.keuangan') ? '' : 'collapsed' }}" href="{{route('user.keuangan')}}">
                <i class="bi bi-circle"></i>
                <span>Keuangan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.jamaah') ? '' : 'collapsed' }}" href="{{route('user.jamaah')}}">
                <i class="bi bi-circle"></i>
                <span>Jamaah</span>
            </a>
        </li>

    </ul>

</aside>