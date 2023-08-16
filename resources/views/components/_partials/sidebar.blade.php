<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 ps bg-white"
    id="sidenav-main">
    <div class="sidenav-headers d-flex align-items-center">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 new-navbar-brand" href="##" target="_blank">
            <img src="{{ asset('siminah-header.png') }}" class="navbar-brand-img h-100" alt="main_logo"><br>
            {{-- <div class="ms-1 font-weight-bold text-dark">SIMINAH</div> --}}
            <span class="ms-1 font-weight-bold text-dark app-name">Siminah</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8 text-poppins">Menu
                </h6>
            </li>
            <li class="nav-item">
                <a class="{{ isRouteActive('dashboard') ? 'active bg-gradient-primary text-white' : ' text-dark' }} nav-link"
                    href="{{ route('dashboard') }}">
                    <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">home</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ isRouteActive('sumbangan') ? 'active bg-gradient-primary text-white' : ' text-dark' }} nav-link"
                    href="{{ route('sumbangan') }}">
                    <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">vertical_align_bottom</i>
                    </div>
                    <span class="nav-link-text ms-1">Sumbangan</span>
                </a>
            </li>
            @if (isAdminCsr())
                <li class="nav-item">
                    <a class="{{ isRouteActive('admin') ? 'active bg-gradient-primary text-white' : (isRouteActive('admin.create') ? 'active bg-gradient-primary text-white' : (isRouteActive('admin.edit') ? 'active bg-gradient-primary text-white' : 'text-dark')) }} nav-link"
                        href="{{ route('admin') }}">
                        <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">Admin</span>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="{{ isRouteActive('kontainer') ? 'active bg-gradient-primary text-white' : ' text-dark' }} nav-link"
                    href="{{ route('kontainer') }}">
                    <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">local_drink</i>
                    </div>
                    <span class="nav-link-text ms-1">Kontainer</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ isRouteActive('donatur') ? 'active bg-gradient-primary text-white' : (isRouteActive('donatur.getById') ? 'active bg-gradient-primary text-white' : 'text-dark') }} nav-link"
                    href="{{ route('donatur') }}">
                    <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">people</i>
                    </div>
                    <span class="nav-link-text ms-1">Donatur</span>
                </a>
            </li>

            @if (isAdminKelurahan())
                <li class="nav-item">
                    <a class="{{ isRouteActive('reward') ? 'active bg-gradient-primary text-white' : (isRouteActive('reward/reward-list') ? 'active bg-gradient-primary text-white' : 'text-dark') }} nav-link"
                        href="{{ route('reward') }}">
                        <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">redeem</i>
                        </div>
                        <span class="nav-link-text ms-1">Reward</span>
                    </a>
                </li>
            @endif

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark " href="">
                    <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">account_circle</i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="##"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">logout</i>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    <span class="nav-link-text ms-1">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
