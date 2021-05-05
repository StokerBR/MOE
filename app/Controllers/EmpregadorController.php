<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class EmpregadorController extends BaseController {

	public function index() {
		
		return view('empregador/index');

	}

}
