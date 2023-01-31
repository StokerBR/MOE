<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller {

    /**
     * Exibe a página inicial do painel de empresa
     *
     * @return void
     */
    public function home() {
        return view('company.home');
    }

    /**
     * Exibe a página de perfil da empresa
     *
     * @return void
     */
    public function profile() {

        $data = [
            'company' => Auth::guard('company')->user(),
            'states' => State::orderBy('name', 'asc')->get()
        ];

        return view('company.auth.profile', $data);

    }

}
