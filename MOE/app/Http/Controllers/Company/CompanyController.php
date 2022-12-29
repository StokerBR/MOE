<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller {

    /**
     * Exibe a página inicial do painel de empresa
     *
     * @return void
     */
    public function home() {
        return view('company.home');
    }

}
