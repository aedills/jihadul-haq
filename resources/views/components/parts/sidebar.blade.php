<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashbord') ? '' : 'collapsed' }}" href="{{route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">Data Master</li>

        @if($role == 'admin' || $role == 'ketua' || $role == 'bendahara')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.kegiatan.*') ? '' : 'collapsed' }}" href="{{route('admin.kegiatan.index')}}">
                <i class="fa-solid fa-list-check"></i>
                <span>Kegiatan</span>
            </a>
        </li>
        @endif

        @if($role == 'admin' || $role == 'ketua' || $role == 'bendahara')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.keuangan.*') ? '' : 'collapsed' }}" href="{{route('admin.keuangan.index')}}">
                <i class="fa-solid fa-money-bill-trend-up"></i>
                <span>Keuangan</span>
            </a>
        </li>
        @endif

        @if($role == 'admin' || $role == 'ketua')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.jamaah.*') ? '' : 'collapsed' }}" href="{{route('admin.jamaah.index')}}">
                <i class="fa-solid fa-people-line"></i>
                <span>Jamaah</span>
            </a>
        </li>
        @endif

        @if($role == 'admin' || $role == 'ketua' || $role == 'bendahara')
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.qurban.*') ? '' : 'collapsed' }}" href="{{route('admin.qurban.index')}}">
                <i class="fa-solid fa-cow"></i>
                <span>Qurban</span>
            </a>
        </li>
        @endif

        @if($role == 'admin')
        <li class="nav-heading">Data User</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.user.*') ? '' : 'collapsed' }}" href="{{route('admin.user.index')}}">
                <i class="fa-solid fa-user"></i>
                <span>Data User</span>
            </a>
        </li>
        @endif




        <!-- <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-contact.html">
                <i class="bi bi-envelope"></i>
                <span>Contact</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-register.html">
                <i class="bi bi-card-list"></i>
                <span>Register</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-login.html">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Login</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-error-404.html">
                <i class="bi bi-dash-circle"></i>
                <span>Error 404</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-blank.html">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li> -->

    </ul>

</aside>