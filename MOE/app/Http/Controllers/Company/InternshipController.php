<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Course;
use App\Models\Internship;
use App\Models\InternshipCourse;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            'courses' => Course::forInternship()->get()
        ];

        return view('company.internship.create-edit', $data);

    }

    /**
     * Valida os dados inseridos
     *
     * @param Request $request
     * @return object
     */
    private function validation(Request $request) {

        $validator = Validator::make($request->all(), [
            'id' => 'nullable|required_if:_method,PUT|exists:internships,id',
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'assignments' => 'required|string|max:500',
            'desired_abilities' => 'required|string|max:500',
            'work_model' => ['required', 'string', 'regex:/^(p|r)$/'],
            'remuneration' => 'nullable|numeric|min:0|max:10000',
            'completion' => 'nullable|integer|min:0|max:100',
            'shift' => ['required', 'string', 'regex:/^(m|v|i)$/'],
            'state_id' => 'required|integer|exists:states,id',
            'city_id' => 'required|integer|exists:cities,id',
            'course_id' => 'required|array|min:1|max:20',
        ]);

        $validator->after(function($validator) use ($request) {

            if ($request->state_id && $request->city_id) {

                $city = City::find($request->city_id);

                if ($city && $city->state_id != $request->state_id) {
                    $validator->errors()->add('city_id', 'A cidade especificada não pertence ao estado especificado');
                }

            }

        });

        return $validator;

    }

    /**
     * Salva os dados da vaga
     *
     * @param Internship $internship
     * @param Request $request
     * @return void
     */
    private function save(Internship $internship, Request $request) {

        $internship->company_id = Auth::guard('company')->user()->id;
        $internship->title = $request->title;
        $internship->description = $request->description;
        $internship->assignments = $request->assignments;
        $internship->desired_abilities = $request->desired_abilities;
        $internship->work_model = $request->work_model;
        $internship->remuneration = $request->remuneration;
        $internship->completion = $request->completion;
        $internship->shift = $request->shift;
        $internship->state_id = $request->state_id;
        $internship->city_id = $request->city_id;

        $internship->save();

        $internship->courses()->syncWithPivotValues($request->course_id, ['approved' => null]);

    }

    //----------------------------------------------------------------------------------------------------//

    /**
     * Exibe a lista de vagas cadastradas
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request) {

        $internships = Internship::orderBy('id', 'desc')->paginate(10);

        $data = [
            'internships' => $internships,
        ];

        return view('company.internship.index', $data);

    }

    /**
     * Exibe as informações da vaga
     *
     * @param [type] $id
     * @return void
     */
    public function info($id) {

        if ($id && is_numeric($id)) {

            $internship = Internship::find($id);

            if ($internship && $internship->company_id == Auth::guard('company')->user()->id) {

                return view('company.internship.info', ['internship' => $internship]);

            }

        }

        return companyRedirect('vagas')->withErrors('Vaga inválida!');

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

    /**
     * Cria vaga
     *
     * @param Request $request
     * @return void
     */
    public function insert(Request $request) {

        $validator = $this->validation($request);

        if (!$validator->fails()) {

            $internship = new Internship();

            $this->save($internship, $request);

            return companyRedirect('vagas')->withSuccess('Vaga de Estágio cadastrada com sucesso');

        } else {

            return back()->withErrors($validator)->withInput();

        }

    }

    /**
     * Exibe o formulário de edição de vaga
     *
     * @param $int $id
     * @return void
     */
    public function edit($id) {

        if ($id && is_numeric($id)) {

            $internship = Internship::find($id);

            if ($internship && $internship->company_id == Auth::guard('company')->user()->id) {

                return $this->form($internship);

            }

        }

        return companyRedirect('vagas')->withErrors('Vaga inválida!');

    }

    /**
     * Atualiza os dados da vaga
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request) {

        $validator = $this->validation($request);

        if (!$validator->fails()) {

            if ($request->id) {

                $internship = Internship::find($request->id);

                if ($internship && $internship->company_id == Auth::guard('company')->user()->id) {

                    $this->save($internship, $request);

                    return companyRedirect('vagas')->withSuccess('Vaga de Estágio editada com sucesso');

                }

            }

            return back()->withErrors('Vaga inválida!')->withInput();

        } else {

            return back()->withErrors($validator)->withInput();

        }

    }

    public function delete(Request $request) {

        if ($request->id) {

            $internship = Internship::find($request->id);

            if ($internship && $internship->company_id == Auth::guard('company')->user()->id) {

                DB::beginTransaction();

                try {

                    $internshipCourses = InternshipCourse::where('internship_id', $internship->id)->get();
                    foreach ($internshipCourses as $internshipCourse) {
                        $internshipCourse->delete();
                    }

                    $internship->delete();

                    DB::commit();

                    return companyRedirect('vagas')->withSuccess('Vaga deletada com sucesso');

                } catch (\Exception $e) {
                    DB::rollBack();
                    return back()->withErrors('Falha ao deletar vaga. Tente novamente mais tarde');
                }

            }

        }

        return back()->withErrors('Vaga inválida!');

    }

}
