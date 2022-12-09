<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ dynUrl('/') }}"><img src="{{ asset('assets/img/moe-logo.png') }}" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ dynUrl('/') }}"><img src="{{ asset('assets/img/moe-icon.png') }}" alt="logo" /></a>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-stretch">

        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item nav-profile dropdown">

                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">David Greymaax</p>
                    </div>
                </a>

                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="#">
                    <i class="mdi mdi-account me-2 text-success"></i> Perfil </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                    <i class="mdi mdi-logout me-2 text-primary"></i> Logout </a>
                </div>

            </li>

        </ul>

    </div>

</nav>
