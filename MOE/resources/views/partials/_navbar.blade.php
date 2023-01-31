<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ url('/') }}"><img src="{{ asset('assets/img/moe-logo.png') }}" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}"><img src="{{ asset('assets/img/moe-icon.png') }}" alt="logo" /></a>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-stretch">

        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        @php
            $painel = 'Painel';

            switch ($userType) {
                case 'student':
                    $painel .= ' do Universitário';
                    break;
                case 'company':
                    $painel .= ' da Empresa';
                    break;
                case 'course-coorddinator':
                    $painel .= ' do Coordenador de Curso';
                    break;
                case 'admin':
                    $painel .= ' do Administrador';
                    break;
            }
        @endphp

        <span class="align-self-center ms-2 user-select-none panel-type">{{ $painel }}</span>

        <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item nav-profile dropdown">

                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">{{ $user ? ($user->name ?? $user->fantasy_name) : 'Usuário' }}</p>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="#{{-- {{ dynUrl('perfil') }} --}}">
                        <i class="mdi mdi-account me-2 text-success"></i>
                        Perfil
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ dynUrl('logout') }}" method="POST">
                        @csrf
                        @method('POST')
                        <button class="dropdown-item" type="submit">
                            <i class="mdi mdi-logout me-2 text-primary"></i>
                            Logout
                        </button>
                    </form>
                </div>

            </li>

        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>

    </div>

</nav>
