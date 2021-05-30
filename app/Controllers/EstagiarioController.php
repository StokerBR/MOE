<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Empregador;
use App\Models\InteresseEmpresa;

class EstagiarioController extends BaseController {

	public function index() {
		
		return view('estagiario/index');

	}

	/**
	 * Mostra todas as empresas cadastradas
	 */
	public function empresas() {

		$modelEmpresa = new Empregador();
		$modelInteresseEmpresa = new InteresseEmpresa();

		$empresas = $modelEmpresa->findAll();

		return view('estagiario/empresas', [
			'empresas' => $empresas,
			'modelEmpresa' => $modelEmpresa,
			'modelInteresseEmpresa' => $modelInteresseEmpresa
		]);

	}

	/**
	 * Mostra todas as empresas em que o estagiario cadastrou interesse
	 */
	public function empresasInteresse() {

		$db = db_connect();

		$empresas = $db->query('select *
			from interesse_empresas as ie
			left join empregadores as e on ie.id_empregador = e.id_usuario
			where ie.id_estagiario = ' . $db->escape(session()->get('id')))
		->getResultArray();

		$modelEmpresa = new Empregador();

		return view('estagiario/empresasInteresse', [
			'empresas' => $empresas,
			'modelEmpresa' => $modelEmpresa,
		]);

	}

	/**
	 * Cadastra interesse em uma empresa
	 */
	public function cadastrarInteresse() {

		$request = service('request');
		$idEmpresa = $request->getVar('id');

		if ($idEmpresa) {

			$modelEmpresa = new Empregador();

			$empregador = $modelEmpresa->find($idEmpresa);

			if ($empregador) {

				$modelInteresseEmpresa = new InteresseEmpresa();

				$idEstagiario = session()->get('id');
				
				$interesseEmpresa = $modelInteresseEmpresa->where('id_estagiario', $idEstagiario)->where('id_empregador', $idEmpresa)->first();

				if (!$interesseEmpresa) {

					$interesseEmpresa['id_estagiario'] = $idEstagiario;
					$interesseEmpresa['id_empregador'] = $idEmpresa;
	
					$modelInteresseEmpresa->save($interesseEmpresa);
	
					return $this->response->setStatusCode(200);

				}

				return $this->response->setStatusCode(400)->setBody('Interesse já cadastrado');

			}

		}

		return $this->response->setStatusCode(400)->setBody('Id inválido');

	}

	/**
	 * Descadastra interesse em uma empresa
	 */
	public function descadastrarInteresse() {

		$request = service('request');
		$idEmpresa = $request->getVar('id');

		if ($idEmpresa) {

			$modelEmpresa = new Empregador();

			$empregador = $modelEmpresa->find($idEmpresa);

			if ($empregador) {

				$modelInteresseEmpresa = new InteresseEmpresa();

				$idEstagiario = session()->get('id');
				
				$interesseEmpresa = $modelInteresseEmpresa->where('id_estagiario', $idEstagiario)->where('id_empregador', $idEmpresa)->first();

				if ($interesseEmpresa) {

					$modelInteresseEmpresa->delete($interesseEmpresa['id']);
	
					return $this->response->setStatusCode(200);

				}

				return $this->response->setStatusCode(400)->setBody('Interesse já cadastrado');

			}

		}

		return $this->response->setStatusCode(400)->setBody('Id inválido');

	}
	
}
