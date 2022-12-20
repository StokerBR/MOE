@extends('layouts.blank')

@section('content')

<div class="auth d-flex align-items-center">

    <div class="row flex-grow">

        <div class="col-lg-4 mx-auto">

            <div class="auth-form-light text-left p-5">

                <div class="brand-logo">
                    <img src="{{ asset('assets/img/moe-logo.png') }}">
                </div>

                <h4>Bem Vindo(a)!</h4>
                <h6 class="font-weight-light">Escolha seu tipo de usuário para continuar.</h6>

                <a class="btn btn-gradient-primary btn-lg btn-block" href="{{ url('universitario') }}">
                    Universitário
                    <i class="mdi mdi-school"></i>
                </a>

                <a class="btn btn-gradient-info btn-lg btn-block mt-2" href="{{ url('empresa') }}">
                    Empresa
                    <i class="mdi mdi-domain"></i>
                </a>

                <a class="btn btn-gradient-dark btn-lg btn-block mt-2" href="{{ url('coordenador') }}">
                    Coordenador de Curso
                    <i class="mdi mdi-account-card-details"></i>
                </a>

                <a class="btn btn-gradient-light btn-lg btn-block mt-2" href="{{ url('admin') }}">
                    Administrador
                    <i class="mdi mdi-security"></i>
                </a>

            </div>

        </div>

    </div>

</div>

@endsection
