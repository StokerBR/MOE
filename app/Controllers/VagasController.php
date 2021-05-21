<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Empregador;
use App\Models\Estagiario;
use App\Models\InteresseEmpresa;
use App\Models\Usuario;
use App\Models\Vaga;

class VagasController extends BaseController {

	/**
	 * Retorna as regras de validação da vaga
	 */
	private function regras() {

		$regras = [
			'descricao' => 'required|max_length[200]',
			'lista_atividades' => 'required',
			'lista_habilidades' => 'required',
			'semestre_requerido' => 'required|is_natural',
			'remuneracao' => 'required|numeric|greater_than_equal_to[600]',
			'quantidade_horas' => 'required|is_natural|regex_match[/^(20|30)$/]'
		];

		return $regras;

	}

	/**
	 * Salva os dados da vaga
	 */
	public function salvar($vaga) {

		$modelVaga = new Vaga();
		$request = service('request');

		$vaga['id_empregador'] = session()->get('id');
		$vaga['descricao'] = $request->getVar('descricao');
		$vaga['lista_atividades'] = $request->getVar('lista_atividades');
		$vaga['lista_habilidades'] = $request->getVar('lista_habilidades');
		$vaga['semestre_requerido'] = $request->getVar('semestre_requerido');
		$vaga['remuneracao'] = $request->getVar('remuneracao');
		$vaga['quantidade_horas'] = $request->getVar('quantidade_horas');

		return $modelVaga->save($vaga);

	}

	//--------------------------------------------------------------------------------------------------------------------------------------

	/**
	 * Mostra todas as vagas do empregador
	 */
	public function index() {

		$modelVaga = new Vaga();
		
		$vagas = $modelVaga->where('id_empregador', session()->get('id'))->findAll();

		return view('empregador/vagas', ['vagas' => $vagas]);

	}

	/**
	 * Retorna o formulário para cadastro de vaga
	 */
	public function cadastrar() {

		return view('empregador/vagaCreateEdit');

	}

	/**
	 * Cria a vaga
	 */
	public function inserir() {

		$regras = $this->regras();

		if ($this->validate($regras)) {

			if ($this->salvar([])) {

				$modelInteresseEmpresa = new InteresseEmpresa();
				$modelEmpresa = new Empregador();
				$modelEstagiario = new Estagiario();
				$modelUsuario = new Usuario();

				$email = service('email');

				$interesses = $modelInteresseEmpresa->where('id_empregador', session()->get('id'))->findAll();

				//enviar email aos estagiarios interessados nas vagas da empresa
				if (count($interesses) > 0) {

					foreach ($interesses as $interesse) {

						$estagiario = $modelEstagiario->where('id_usuario', $interesse['id_estagiario'])->first();

						if ($estagiario) {

							$empresa = $modelEmpresa->find(session()->get('id'));

							$usuario = $modelUsuario->find($estagiario['id_usuario']);

							$email->setTo($usuario['email']);
							$email->setSubject('Nova Vaga');
							$email->setMessage('A empresa ' . $empresa['nome_empresa'] . ' cadastrou uma nova vaga!');
							$email->send();

						}

					}

				}

				return redirect('empregador/vagas')->with('success', 'Vaga criada com sucesso!');

			} else {

				return redirect()->back()->withInput()->with('warning', 'Não foi possível salvar os dados. Tente novamente mais tarde.');

			}

		} else { //retorna ao formulário caso a validação falhe
			
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

		}

	}

}
