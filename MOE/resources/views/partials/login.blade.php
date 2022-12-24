@php

    switch ($userType) {
        case 'universitario':
            $name = 'Universitário';
            break;

        case 'empresa':
            $name = 'Empresa';
            break;

        case 'coordenador':
            $name = 'Coordenador de Curso';
            break;

        case 'admin':
            $name = 'Administrador';
            break;

        default:
            $name = '';
            break;
    }

@endphp

<div class="auth d-flex align-items-center">

    <div class="row flex-grow">

        <div class="col-lg-4 mx-auto">

            <div class="auth-form-light text-left p-5">

                <div class="brand-logo">
                    <img src="{{ asset('assets/img/moe-logo.png') }}">
                </div>

                <h4>Bem Vindo(a)!</h4>
                <h6 class="font-weight-light pb-3">Faça o login para continuar para o painel de {{ $name }}.</h6>

                @include('partials._alert')

                <form class="onsubmit-wait" action="{{ url($userType.'/login') }}" data-parsley-validate method="POST">

                    @method('POST')
                    @csrf

                    <div class="form-group">
                        <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" required>
                    </div>

                    <div class="form-group">
                        <div class="input-with-icon password-icon">
                            <input type="password" class="form-control form-control-lg" name="password" placeholder="Senha" required data-parsley-errors-container="#password-error">
                            <i class="mdi mdi-eye"></i>
                        </div>
                        <div id="password-error"></div>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit">ENTRAR</button>
                    </div>

                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                        <label class="form-check-label text-muted">
                            <input type="checkbox" name="remember" class="form-check-input"> Manter Conectado </label>
                        </div>
                        <a href="" class="auth-link text-black">Esqueceu sua senha?</a>
                    </div>

                    @if ($userType != 'admin')

                        <div class="text-center mt-4 font-weight-light">
                            Não tem uma conta?
                            <a href="" class="text-primary">Criar</a>
                        </div>

                    @endif

                </form>

            </div>

        </div>

    </div>

</div>
