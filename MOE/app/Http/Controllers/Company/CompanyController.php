<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller {

    public function home() {
        return view('company.home');
    }

}
