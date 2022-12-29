@extends('layouts.default')

@section('content')

    @php
        $isEdit = $internship->id ? true : false;
        $type = $isEdit ? 'Editar' : 'Cadastrar';
    @endphp

    <div class="page page-internships page-create-edit">

        @include('partials._page-header', [
            'title' => $type.' Vaga de Estágio',
            'icon' => 'mdi mdi-tie',
            'breadcrumb' => [
                ['name' => 'Home', 'url' => ''],
                ['name' => 'Vagas de Estágio', 'url' => 'vagas'],
                ['name' => $type],
            ]
        ])

        @include('partials._alert')

        <form class="onsubmit-wait" action="{{ companyUrl('vagas') }}" method="POST" data-parsley-validate>

            @method($isEdit ? "PUT" : "POST")
            @csrf

            <div class="card main-card">

                <div class="card-body">

                    <h4 class="card-title">Informações</h4>
                    <p class="card-description">Insira as informaçãoes da vaga</p>

                    <input type="text" hidden name="id" value="{{ $internship->id }}">

                    <div class="form-group">

                        <label>Título <span class="required">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Título da vaga" value="{{ old('title', $internship->title) }}" maxlength="100" required>

                    </div>

                    <div class="form-group">

                        <label>Descrição <span class="required">*</span></label>
                        <textarea class="form-control" name="description" rows="3" maxlength="500" required>{{ old('description', $internship->description) }}</textarea>

                    </div>

                    <div class="form-group">

                        <label>Atribuições <span class="required">*</span></label>
                        <textarea class="form-control" name="assignments" rows="3" maxlength="500" required>{{ old('assignments', $internship->assignments) }}</textarea>

                    </div>

                    <div class="form-group">

                        <label>Habilidades Desejadas <span class="required">*</span></label>
                        <textarea class="form-control" name="desired_abilities" rows="3" maxlength="500" required>{{ old('desired_abilities', $internship->desired_abilities) }}</textarea>

                    </div>

                    <div class="row">

                        <div class="col-12 col-lg-4">

                            <div class="form-group">

                                <label>Modelo de Trabalho <span class="required">*</span></label>
                                <select class="form-control form-select select2 no-search" name="work_model" required data-parsley-errors-container="#work_model-errors">
                                    <option value="">Selecione</option>
                                    <option value="p" {{ old('work_model', $internship->work_model) == 'p' ? 'selected' : '' }}>Presencial</option>
                                    <option value="r" {{ old('work_model', $internship->work_model) == 'r' ? 'selected' : '' }}>Remoto</option>
                                </select>
                                <div id="work_model-errors"></div>

                            </div>

                        </div>


                        <div class="col-12 col-lg-4">

                            <div class="form-group">

                                <label>Remuneração</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">R$</span>
                                    </div>
                                    <input type="number" class="form-control" name="remuneration" placeholder="Valor da Remuneração" value="{{ old('remuneration', $internship->remuneration) }}" step="0.01" min="0" max="10000" data-parsley-errors-container="#remuneration-errors">
                                </div>
                                <div id="remuneration-errors"></div>

                            </div>

                        </div>

                        <div class="col-12 col-lg-4">

                            <div class="form-group">

                                <label>Integralização</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="completion" placeholder="Integralização Mínima do Curso" value="{{ old('completion', $internship->completion) }}" min="0" max="100" data-parsley-errors-container="#completion-errors">
                                    <div class="input-group-append">
                                      <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <div id="completion-errors"></div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12 col-lg-4">

                            <div class="form-group">

                                <label>Turno <span class="required">*</span></label>
                                <select class="form-control form-select select2 no-search" name="shift" required data-parsley-errors-container="#shift-errors">
                                    <option value="">Selecione</option>
                                    <option value="m" {{ old('shift', $internship->shift) == 'm' ? 'selected' : '' }}>Matutino</option>
                                    <option value="v" {{ old('shift', $internship->shift) == 'v' ? 'selected' : '' }}>Vespertino</option>
                                    <option value="i" {{ old('shift', $internship->shift) == 'i' ? 'selected' : '' }}>Integral</option>
                                </select>
                                <div id="shift-errors"></div>

                            </div>

                        </div>

                        <div class="col-12 col-lg-4">

                            <div class="form-group">

                                <label>Estado <span class="required">*</span></label>
                                <select class="form-control form-select state-select select2" name="state_id" required data-parsley-errors-container="#state_id-errors">
                                    <option value="">Selecione</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" {{ old('state_id', $internship->state_id) == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                <div id="state_id-errors"></div>

                            </div>

                        </div>

                        <div class="col-12 col-lg-4">

                            <div class="form-group">

                                <label>Cidade <span class="required">*</span></label>
                                <select class="form-control form-select city-select select2" name="city_id" required data-parsley-errors-container="#city_id-errors" data-id="{{ old('city_id', $internship->city_id) }}">
                                    <option value="">Selecione um estado</option>
                                </select>
                                <div id="city_id-errors"></div>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        @php
                            $oldCoursesIds = old('course_id');
                            $internshipCourses = $internship->courses;
                        @endphp

                        <label>Cursos <span class="required">*</span></label>
                        <select class="form-control form-select course-select select2" name="course_id[]"  multiple="multiple" required data-parsley-errors-container="#course_id-errors">
                            <option value="">Selecione</option>
                            @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ (($oldCoursesIds && in_array($course->id, $oldCoursesIds)) || ($internshipCourses && $internshipCourses->contains('id', $course->id))) ? 'selected' : '' }}>{{ $course->name }} - {{ $course->acronym }}</option>
                            @endforeach
                        </select>
                        <div id="course_id-errors"></div>

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

    </div>

@endsection
