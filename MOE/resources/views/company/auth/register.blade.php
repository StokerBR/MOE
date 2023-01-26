@extends('layouts.blank')

@section('content')

    <div class="auth d-flex align-items-center">

        <div class="container">

            <div class="register-form-light">

                <div class="brand-logo">
                    <img src="{{ asset('assets/img/moe-logo.png') }}">
                </div>

                <h4>Bem Vindo(a)!</h4>
                <h6 class="font-weight-light pb-3">Preencha os campos abaixo para realizar seu cadastro.</h6>

                @include('partials._alert')

                <form class="onsubmit-wait" action="{{ dynUrl('cadastrar') }}" data-parsley-validate method="POST">

                    @method('POST')
                    @csrf

                    <div class="row">

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nome Fantasia <span class="required">*</span></label>
                                <input type="text" class="form-control form-control-lg" value="{{ old('fantasy_name') }}" name="fantasy_name" placeholder="Nome Fantasia" maxlength="100" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Razão Social <span class="required">*</span></label>
                                <input type="text" class="form-control form-control-lg" value="{{ old('social_reason') }}" name="social_reason" placeholder="Razão Social" maxlength="100" required>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>CNPJ <span class="required">*</span></label>
                                <input type="text" class="form-control form-control-lg" value="{{ old('cnpj') }}" name="cnpj" placeholder="CNPJ" sys-mask="cnpj" data-parsley-cnpj maxlength="18" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">

                            <div class="form-group">

                                <label>Estado <span class="required">*</span></label>
                                <select class="form-control form-select state-select select2" name="state_id" required data-parsley-errors-container="#state_id-errors">
                                    <option value="">Selecione</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                <div id="state_id-errors"></div>

                            </div>

                        </div>

                        <div class="col-12 col-md-4">

                            <div class="form-group">

                                <label>Cidade <span class="required">*</span></label>
                                <select class="form-control form-select city-select select2" name="city_id" required data-parsley-errors-container="#city_id-errors" data-id="{{ old('city_id') }}">
                                    <option value="">Selecione um estado</option>
                                </select>
                                <div id="city_id-errors"></div>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Informações Adidionais</label>
                        <textarea class="form-control" name="additional_info" rows="3" maxlength="500">{{ old('additional_info') }}</textarea>

                    </div>

                    <div class="row">

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Email <span class="required">*</span></label>
                                <input type="email" class="form-control form-control-lg" value="{{ old('email') }}" name="email" placeholder="Email" maxlength="100" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Senha <span class="required">*</span></label>
                                <div class="input-with-icon password-icon">
                                    <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="Senha" minlength="6" maxlength="60" required data-parsley-errors-container="#password-error">
                                    <i class="mdi mdi-eye"></i>
                                </div>
                                <div id="password-error"></div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Confirmação da Senha <span class="required">*</span></label>
                                <div class="input-with-icon password-icon">
                                    <input type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirme a Senha" minlength="6" maxlength="60" required data-parsley-equalto="#password" data-parsley-errors-container="#password_confirmation-error">
                                    <i class="mdi mdi-eye"></i>
                                </div>
                                <div id="password_confirmation-error"></div>
                            </div>
                        </div>

                    </div>

                    <div class="register-btns">
                        <a href="{{ dynUrl('login') }}" class="btn btn-light ms-auto" type="submit">VOLTAR</a>
                        <button class="btn btn-gradient-primary" type="submit">CADASTRAR</button>
                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
