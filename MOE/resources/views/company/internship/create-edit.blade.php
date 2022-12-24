@extends('layouts.default')

@section('content')

    @php
        $isEdit = $internship->id ? true : false;
        $type = $isEdit ? 'Editar' : 'Cadastrar';
    @endphp

    @include('partials._page-header', [
        'title' => $type.' Vaga de Estágio',
        'icon' => 'mdi mdi-tie',
        'breadcrumb' => [
            ['name' => 'Home', 'url' => ''],
            ['name' => 'Vagas de Estágio', 'url' => 'vagas'],
            ['name' => $type],
        ]
    ])

    <form class="onsubmit-wait" action="{{ url('vagas') }}" method="POST" data-parsley-validate>

        @method($isEdit ? "PUT" : "POST")
        @csrf

        <div class="card main-card">

            <div class="card-body">

                <h4 class="card-title">Informações</h4>
                <p class="card-description">Insira as informaçãoes da vaga</p>

                <input type="text" hidden name="id" value="{{ $internship->id }}">

                <div class="form-group">
                    <label>Título</label>
                    <input type="text" class="form-control" name="title" placeholder="Título da vaga" value="{{ old('title', $internship->title) }}" maxlength="100">
                </div>

                <div class="form-group">
                    <label>Descrição</label>
                    <textarea class="form-control" name="description" rows="3" maxlength="500">{{ old('description', $internship->description) }}</textarea>
                </div>

                <div class="row">

                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Modelo de Trabalho</label>
                            <select class="form-control form-select select2 no-search" name="work_model">
                                <option value="">Selecione</option>
                                <option value="p" {{ old('work_model', $internship->work_model) == 'p' ? 'selected' : '' }}>Presencial</option>
                                <option value="r" {{ old('work_model', $internship->work_model) == 'r' ? 'selected' : '' }}>Remoto</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label>Atribuições</label>
                    <textarea class="form-control" name="description" rows="3" maxlength="500">{{ old('description', $internship->description) }}</textarea>
                </div>

            </div>

        </div>

        <div class="page-buttons btn-row">

            <a href="{{ companyUrl('vagas') }}" type="button" class="btn btn-light" title="Voltar">
                <i class="mdi mdi-arrow-left"></i> Voltar
            </a>

            <button type="submit" class="btn btn-gradient-primary" title="Salvar">
                <i class="mdi mdi-content-save"></i> Salvar
            </button>

        </div>

    </form>

@endsection
