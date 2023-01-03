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

                            <label>Modelo de Trabalho</label>
                            <select class="form-control form-select" name="work_model" disabled>
                                <option value="p" {{ $internship->work_model == 'p' ? 'selected' : '' }}>Presencial</option>
                                <option value="r" {{ $internship->work_model == 'r' ? 'selected' : '' }}>Remoto</option>
                            </select>

                        </div>

                    </div>


                    <div class="col-12 col-lg-4">

                        <div class="form-group">

                            <label>Remuneração</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="number" class="form-control" name="remuneration" value="{{ $internship->remuneration }}" disabled>
                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-lg-4">

                        <div class="form-group">

                            <label>Integralização</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="completion" value="{{ $internship->completion }}" disabled>
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

                            <label>Turno</label>
                            <select class="form-control form-select" name="shift" disabled>
                                <option value="m" {{ $internship->shift == 'm' ? 'selected' : '' }}>Matutino</option>
                                <option value="v" {{ $internship->shift == 'v' ? 'selected' : '' }}>Vespertino</option>
                                <option value="i" {{ $internship->shift == 'i' ? 'selected' : '' }}>Integral</option>
                            </select>

                        </div>

                    </div>

                    @php
                        $state = $internship->state;
                        $city = $internship->city;
                    @endphp

                    <div class="col-12 col-lg-4">

                        <div class="form-group">

                            <label>Estado</label>
                            <select class="form-control form-select" name="state_id" disabled>
                                <option value="{{ $state->id }}" selected>{{ $state->name }}</option>
                            </select>

                        </div>

                    </div>

                    <div class="col-12 col-lg-4">

                        <div class="form-group">

                            <label>Cidade</label>
                            <select class="form-control form-select" name="city_id" disabled>
                                <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                            </select>

                        </div>

                    </div>

                </div>

                @php
                    $internshipCourses = $internship->courses;
                @endphp

                <h4 class="card-title">Cursos</h4>
                <p class="card-description">Cursos selecionados para a vaga e seu status de aprovação respectivo</p>

                <div class="courses table-responsive">

                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Faculdade</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($internshipCourses as $i => $course)

                                @php
                                    $university = $course->university;

                                    $status = [
                                        'tag' => '',
                                        'text' => ''
                                    ];

                                    $approved = $course->getRawOriginal('pivot_approved');

                                    if ($approved === null) {
                                        $status['tag'] = 'pending';
                                        $status['text'] = 'Pendente';

                                    } else if ($approved === false) {
                                        $status['tag'] = 'rejected';
                                        $status['text'] = 'Rejeitada';

                                    } else {
                                        $status['tag'] = 'approved';
                                        $status['text'] = 'Aprovada';
                                    }

                                @endphp

                                <tr>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $university->name }} - {{ $university->acronym }}</td>
                                    <td><span class="internship-status-tag {{ $status['tag'] }}">{{ $status['text'] }}</span></td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="page-buttons btn-row">

            <a href="{{ companyUrl('vagas') }}" type="button" class="btn btn-light" title="Voltar">
                <i class="mdi mdi-arrow-left"></i> Voltar
            </a>

        </div>

    </div>

@endsection
