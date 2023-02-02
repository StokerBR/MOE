@extends('layouts.default')

@section('content')

    <div class="page page-company page-profile">

        @include('partials._page-header', [
            'title' => 'Perfil da Empresa',
            'icon' => 'mdi mdi-account',
            'breadcrumb' => [
                ['name' => 'Home', 'url' => ''],
                ['name' => 'Perfil'],
            ]
        ])

        @include('partials._alert')

        <form class="onsubmit-wait" action="{{ companyUrl('perfil') }}" method="POST" data-parsley-validate>

            @method("PUT")
            @csrf

            <div class="card main-card">

                <div class="card-body">

                    <h4 class="card-title">Informações</h4>
                    <p class="card-description">Dados da Empresa</p>

                    <div class="row">

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nome Fantasia <span class="required">*</span></label>
                                <input type="text" class="form-control form-control-lg" value="{{ old('fantasy_name', $company->fantasy_name) }}" name="fantasy_name" placeholder="Nome Fantasia da Empresa" maxlength="100" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Razão Social <span class="required">*</span></label>
                                <input type="text" class="form-control form-control-lg" value="{{ old('social_reason', $company->social_reason) }}" name="social_reason" placeholder="Razão Social da Empresa" maxlength="100" required>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>CNPJ <span class="required">*</span></label>
                                <input type="text" class="form-control form-control-lg" value="{{ $company->cnpj }}" disabled>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">

                            <div class="form-group">

                                <label>Estado <span class="required">*</span></label>
                                <select class="form-control form-select state-select select2" name="state_id" required data-parsley-errors-container="#state_id-errors">
                                    <option value="">Selecione</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" {{ old('state_id', $company->state_id) == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                <div id="state_id-errors"></div>

                            </div>

                        </div>

                        <div class="col-12 col-md-4">

                            <div class="form-group">

                                <label>Cidade <span class="required">*</span></label>
                                <select class="form-control form-select city-select select2" name="city_id" required data-parsley-errors-container="#city_id-errors" data-id="{{ old('city_id', $company->city_id) }}">
                                    <option value="">Selecione um estado</option>
                                </select>
                                <div id="city_id-errors"></div>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Informações Adidionais</label>
                        <textarea class="form-control" name="additional_info" rows="3" maxlength="500" placeholder="Escreva aqui quaisquer informações adicionais pertinentes">{{ old('additional_info', $company->additional_info) }}</textarea>

                    </div>

                    <div class="row">

                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <label>Email <span class="required">*</span></label>
                                <input type="email" class="form-control form-control-lg" value="{{ old('email', $company->email) }}" name="email" placeholder="Email da Empresa" maxlength="100" required>
                            </div>
                        </div>

                    </div>

                    <div class="form-check">
                        <label class="form-check-label text-muted">
                        <input type="checkbox" name="change_password" class="form-check-input change-password-checkbox" {{ old('change_password') ? 'checked' : '' }}>Alterar Senha</label>
                    </div>

                    <div class="row password-fields d-none">

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Senha <span class="required">*</span></label>
                                <div class="input-with-icon password-icon">
                                    <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="Senha" minlength="6" maxlength="60" data-parsley-errors-container="#password-error">
                                    <i class="mdi mdi-eye"></i>
                                </div>
                                <div id="password-error"></div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Confirmação da Senha <span class="required">*</span></label>
                                <div class="input-with-icon password-icon">
                                    <input type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirme a Senha" minlength="6" maxlength="60" data-parsley-equalto="#password" data-parsley-errors-container="#password_confirmation-error">
                                    <i class="mdi mdi-eye"></i>
                                </div>
                                <div id="password_confirmation-error"></div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="page-buttons btn-row">

                <a href="{{ companyUrl('/') }}" type="button" class="btn btn-light" title="Voltar">
                    <i class="mdi mdi-arrow-left"></i> Voltar
                </a>

                <button type="submit" class="btn btn-gradient-primary" title="Salvar">
                    <i class="mdi mdi-content-save"></i> Salvar
                </button>

            </div>

        </form>

    </div>

@endsection
