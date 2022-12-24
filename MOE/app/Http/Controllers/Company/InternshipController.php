<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\State;
use Illuminate\Http\Request;

class InternshipController extends Controller {

    /**
     * Retorna a view de criação/edição
     *
     * @param Internship $internship
     * @return void
     */
    private function form(Internship $internship) {

        $data = [
            'internship' => $internship,
            'states' => State::orderBy('name', 'asc')->get(),
        ];

        return view('company.internship.create-edit', $data);

    }

    //----------------------------------------------------------------------------------------------------//

    /**
     * Exibe a lista de vagas cadastradas
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request) {

        $internships = Internship::paginate(10);

        $data = [
            'internships' => $internships,
        ];

        return view('company.internship.index', $data);

    }

    /**
     * Exibe o formulário de cadastro de vaga
     *
     * @return void
     */
    public function create() {

        $internship = new Internship();

        return $this->form($internship);

    }

}
