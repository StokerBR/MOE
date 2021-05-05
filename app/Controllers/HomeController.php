<?php

namespace App\Controllers;

class HomeController extends BaseController {

	//Retorna a view home
	public function index() {

		return view('home/index');

	}

}
