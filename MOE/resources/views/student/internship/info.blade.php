@extends('layouts.default')

@section('content')

    @php
        $isEdit = $internship->id ? true : false;
        $type = $isEdit ? 'Editar' : 'Cadastrar';
    @endphp

    <div class="page page-internships page-create-edit">

        @include('partials._page-header', [
            'title' => 'Informações da Vaga de Estágio',
            'icon' => 'mdi mdi-tie',
            'breadcrumb' => [
                ['name' => 'Home', 'url' => ''],
                ['name' => 'Vagas de Estágio', 'url' => 'vagas'],
                ['name' => 'Informações'],
            ]
        ])

        <div class="card main-card">

            <div class="card-body">

                <h4 class="card-title">Informações</h4>
                <p class="card-description">Visualize as informaçãoes da vaga</p>

                <div class="form-group">

                    <label>Empresa</label>
                    <input type="text" class="form-control" name="company" value="{{ $internship->company->fantasy_name }}" disabled>

                </div>

                <div class="form-group">

                    <label>Título</label>
                    <input type="text" class="form-control" name="title" value="{{ $internship->title }}" disabled>

                </div>

                <div class="form-group">

                    <label>Descrição</label>
                    <textarea class="form-control" name="description" rows="3" disabled>{{ $internship->description }}</textarea>

                </div>

                <div class="form-group">

                    <label>Atribuições</label>
                    <textarea class="form-control" name="assignments" rows="3" disabled>{{ $internship->assignments }}</textarea>

                </div>

                <div class="form-group">

                    <label>Habilidades Desejadas</label>
                    <textarea class="form-control" name="desired_abilities" rows="3" disabled>{{ $internship->desired_abilities }}</textarea>

                </div>

                <div class="row">

                    <div class="col-12 col-lg-4">

                        <div class="form-group">

                            @php
                                $workModels = [
                                    'p' => 'Presencial',
                                    'r' => 'Remoto'
                                ];
                            @endphp

                            <label>Modelo de Trabalho</label>
                            <input type="text" class="form-control" name="work_model" value="{{ $workModels[$internship->work_model] }}" disabled>

                        </div>

                    </div>


                    <div class="col-12 col-lg-4">

                        <div class="form-group">

                            <label>Remuneração</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="text" class="form-control" name="remuneration" value="{{ $internship->remuneration ?? '-' }}" disabled>
                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-lg-4">

                        <div class="form-group">

                            <label>Integralização</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="completion" value="{{ $internship->completion ?? '-' }}" disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-12 col-lg-4">

                        <div class="form-group">

                            @php
                                $shifts = [
                                    'm' => 'Matutino',
                                    'v' => 'Vespertino',
                                    'i' => 'Integral',
                                ];
                            @endphp

                            <label>Turno</label>
                            <input type="text" class="form-control" name="shift" value="{{ $shifts[$internship->shift] }}" disabled>

                        </div>

                    </div>

                    @php
                        $state = $internship->state;
                        $city = $internship->city;
                    @endphp

                    <div class="col-12 col-lg-4">

                        <div class="form-group">

                            <label>Estado</label>
                            <input type="text" class="form-control" name="state" value="{{ $state->name }}" disabled>

                        </div>

                    </div>

                    <div class="col-12 col-lg-4">

                        <div class="form-group">

                            <label>Cidade</label>
                            <input type="text" class="form-control" name="city" value="{{ $city->name }}" disabled>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="page-buttons btn-row">

            <a href="{{ studentUrl('vagas') }}" type="button" class="btn btn-light" title="Voltar">
                <i class="mdi mdi-arrow-left"></i> Voltar
            </a>

        </div>

    </div>

@endsection
