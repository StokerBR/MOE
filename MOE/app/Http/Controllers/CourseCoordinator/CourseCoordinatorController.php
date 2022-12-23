<?php

namespace App\Http\Controllers\CourseCoordinator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseCoordinatorController extends Controller {

    public function home() {
        return view('course-coordinator.home');
    }

}
