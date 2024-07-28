<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{url('dashboard')}}" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block">Jihadul Haq</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                @if(session('data'))

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{url('/photos/default.png')}}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ session('data')->nama ? session('data')->nama : ''}}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ session('data')->nama ? session('data')->nama : ''}}</h6>
                        <span>{{ session('data')->username ? session('data')->username : session('data')->no_hp }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Log Out</span>
                        </a>
                    </li>

                </ul>
                @else
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="{{route('login')}}">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span class="d-none d-md-block ps-2">Login</span>
                </a>
                @endif
            </li>

        </ul>
    </nav>

</header>