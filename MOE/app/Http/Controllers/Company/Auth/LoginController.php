<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Traits\LoginTrait;

class LoginController extends Controller {

    use LoginTrait;

    public $model = Company::class;
    public $guard = 'company';
    public $baseViewPath = 'company.';

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
