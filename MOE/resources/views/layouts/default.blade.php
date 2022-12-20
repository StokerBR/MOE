<!DOCTYPE html>
<html lang="pt-br">

    @php

        $currentGuard = getCurrentGuard();

        $user = Auth::guard($currentGuard)->user();

        $menu = [
            [ 'name' => 'Home',	'url' => '/', 'icon' => 'mdi mdi-home' ],
            [ "name" => "Teste", 'icon' => 'mdi mdi-human-greeting', "children" => [
                [ "name" => "Teste 1", "url" => '/' ],
                [ "name" => "Teste 2", "url" => '/' ],
            ]],
        ];

        if ($user) {
            $menu = $user->menu();
        }

    @endphp

    @include('partials._head')

    <body>

        <div class="container-scroller">

            @include('partials._navbar', ['user' => $user, 'userType' => $currentGuard])

            <div class="container-fluid page-body-wrapper">

                @include('partials._sidebar')

                <div class="main-panel">

                    <div class="content-wrapper">

                        @yield('content')

                    </div>

                </div>

            </div>

        </div>

    </body>

    {{-- <footer></footer> --}}

    <script type="text/javascript" src="{{ mix('assets/js/vendor.js') }}"></script>
    <script type="text/javascript" src="{{ mix('assets/js/app.js') }}"></script>

</html>
