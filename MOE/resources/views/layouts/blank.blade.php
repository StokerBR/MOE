<!DOCTYPE html>
<html lang="pt-br">

    @include('partials._head')

    <body>

        <div class="container-scroller">

            <div class="container-fluid page-body-wrapper">

                <div class="content-wrapper">

                    @yield('content')

                </div>

            </div>

        </div>

    </body>

    <script type="text/javascript" src="{{ mix('assets/js/vendor.js') }}"></script>
    <script type="text/javascript" src="{{ mix('assets/js/app.js') }}"></script>

</html>
