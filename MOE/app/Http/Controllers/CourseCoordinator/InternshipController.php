<?php

namespace App\Http\Controllers\CourseCoordinator;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipController extends Controller
{

    /**
     * Salva a aprovação/rejeição da vaga
     *
     * @param [type] $id
     * @param [type] $approved
     * @return void
     */
    private function changeApproval($id, $approved) {

        if ($id) {

            $courseCoordinator = Auth::guard('course-coordinator')->user();

            $internshipCourse = InternshipCourse::find($id);

            if ($internshipCourse && $internshipCourse->course_id == $courseCoordinator->course_id) {

                $internshipCourse->approved = $approved;
                $internshipCourse->save();

                $status = $approved ? 'aprovada' : 'rejeitada';

                return courseCoordRedirect('vagas')->withSuccess('Vaga '.$status.' com sucesso');

            }

        }

        return back()->withErrors('Vaga inválida');

    }

    //----------------------------------------------------------------------------------------------------//

    /**
     * Exibe a lista de vagas cadastradas do curso do coordenador
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request) {

        $courseCoordinator = Auth::guard('course-coordinator')->user();

        $internships = Internship::forCoordinator($courseCoordinator)->paginate(10);

        $data = [
            'internships' => $internships,
        ];

        return view('course-coordinator.internship.index', $data);

    }

    /**
     * Exibe as informações da vaga
     *
     * @param [type] $id
     * @return void
     */
    public function info($id) {

        if ($id) {

            $courseCoordinator = Auth::guard('course-coordinator')->user();

            $internshipCourse = InternshipCourse::find($id);

            if ($internshipCourse && $internshipCourse->course_id == $courseCoordinator->course_id) {

                $data = [
                    'internshipCourse' => $internshipCourse,
                    'internship' => $internshipCourse->internship
                ];

                return view('course-coordinator.internship.info', $data);

            }

        }

        return back()->withErrors('Vaga inválida');

    }

    /**
     * Aprova a vaga
     *
     * @param int id
     * @return void
     */
    public function approve($id) {
        return $this->changeApproval($id, true);
    }

    /**
     * Rejeita a vaga
     *
     * @param int id
     * @return void
     */
    public function reject($id) {
        return $this->changeApproval($id, false);
    }

}
