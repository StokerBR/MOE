<?php

namespace App\Http\Controllers\CourseCoordinator\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseCoordinator;
use App\Traits\LoginTrait;

class LoginController extends Controller {

    use LoginTrait;

    public $model = CourseCoordinator::class;
    public $guard = 'course-coordinator';
    public $baseViewPath = 'course-coordinator.';

    /**
     * Carregar página de login
     * @return void
     */
    public function index() {

        return $this->traitIndex();

    }

    /**
     * Realizar login
     * @param Request $request
     * @return void
     */
    public function login(Request $request) {

        return $this->traitLogin($request);

    }

    /**
     * Realizar logout
     * @return void
     */
    public function logout() {

        return $this->traitLogout();

    }

}
