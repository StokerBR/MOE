<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipController extends Controller {



    //----------------------------------------------------------------------------------------------------//

    /**
     * Exibe a lista de vagas cadastradas do curso do coordenador
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request) {

        $student = Auth::guard('student')->user();

        $internships = Internship::forStudent($student)->paginate(10);

        $data = [
            'internships' => $internships,
        ];

        return view('student.internship.index', $data);

    }

    /**
     * Exibe as informações da vaga
     *
     * @param [type] $id
     * @return void
     */
    public function info($id) {

        if ($id) {

            $student = Auth::guard('student')->user();

            $internshipCourse = InternshipCourse::find($id);

            if ($internshipCourse && $internshipCourse->course_id == $student->course_id) {

                $data = [
                    'internship' => $internshipCourse->internship
                ];

                return view('student.internship.info', $data);

            }

        }

        return back()->withErrors('Vaga inválida');

    }

}
