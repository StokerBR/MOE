<?php

namespace App\Controllers;

use App\Models\Usuario;

// use App\Enum\UserEnum;

class HomeController extends BaseController {

	//Retorna a view home
	public function index() {
		/* $model = new Usuario();

		$pessoa['nome'] = 'b';
		$pessoa['idade'] = '100';
		$model->save($pessoa);
		
		var_dump($model->db->insertID()); */

		return view('home/index');
	}

	//Retorna o formulário de registro de usuário
	public function registrar() {

		return view('home/registrar');

	}

}
