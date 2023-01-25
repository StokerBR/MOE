@extends('layouts.default')

@section("page-buttons")

	<div class="page-buttons btn-row">

        <button type="button" class="btn btn-outline-secondary btn-toggle-filters" title="Exibir/esconder filtros da página">
            <i class="mdi mdi-filter-outline"></i>
            Exibir filtros
        </button>

	</div>

@endsection

@section('content')

    <div class="page page-coordinator page-internships page-index">

        @include('partials._page-header', [
            'title' => 'Vagas de Estágio para seu Curso',
            'icon' => 'mdi mdi-tie',
            'breadcrumb' => [
                ['name' => 'Home', 'url' => ''],
                ['name' => 'Vagas de Estágio'],
            ]
        ])

        @include('partials._alert')

        <div class="card main-card">

            <div class="card-body table-responsive">

                @if (count($internships) > 0)

                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php
                                $statuses = [
                                    'pending' => ['name' => 'Pendente', 'class' => ''],
                                    'approved' => ['name' => 'Aprovada', 'class' => 'tag-success'],
                                    'rejected' => ['name' => 'Rejeitada', 'class' => 'tag-danger'],
                                ]
                            @endphp

                            @foreach ($internships as $internship)

                                @php
                                    if ($internship->approved === null) {
                                        $status = $statuses['pending'];

                                    } else if ($internship->approved == true) {
                                        $status = $statuses['approved'];

                                    } else {
                                        $status = $statuses['rejected'];
                                    }
                                @endphp

                                <tr>
                                    <td>{{ $internship->id }}</td>
                                    <td>{{ $internship->title }}</td>
                                    <td><span class="tag {{ $status['class'] }}">{{ $status['name'] }}</span></td>
                                    <td class="actions">
                                        <a class="btn btn-info btn-icon" title="Informações da Vaga" href="{{ courseCoordUrl('vagas/'.$internship->ic_id.'/info') }}">
                                            <i class="mdi mdi-information-variant"></i>
                                        </a>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                @else

                    <div class="card-message">
                        <h3>Nenhum registro foi encontrado</h3>
                    </div>

                @endif

            </div>

            @php
                $pagination = $internships->appends(Request::except('page'))->links();
            @endphp

            @if ($internships->hasPages() && count($internships) > 0)

                <div class="card-footer">
                    {!! $pagination !!}
                </div>

            @else

                <div class="card-footer">
                    <div class="pagination-wrapper">
                        <div class="pagination-status ml-auto">{{ count($internships) }}</div>
                    </div>
                </div>

            @endif

        </div>

    </div>

@endsection
