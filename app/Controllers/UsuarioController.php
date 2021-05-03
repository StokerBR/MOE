<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Empregador;
use App\Models\Estagiario;
use App\Models\Usuario;

class UsuarioController extends BaseController {

	public function index() {
		
	}

	public function registrar() {
		
		$request = service('request');

		//regras de validação
		$regras = [
			'email' => 'required|valid_email|max_length[50]|is_unique[usuarios.email]',
			'senha' => 'required|min_length[6]|max_length[50]|regex_match[/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/]',
			'senha_confirm' => 'required|matches[senha]',
			'tipo_conta' => 'required|regex_match[/^(estagiario|empregador)$/]'
		];

		if ($request->getVar('tipo_conta') == 'estagiario') {

			$regrasEstagiario = [
				'nome' => 'required|string|max_length[50]',
				'curso' => 'required|string|max_length[50]',
				'ano_ingresso' => 'required|is_natural|greater_than_equal_to[' . (date('Y') - 10) . ']|less_than_equal_to[' . date('Y') . ']',
				'minicurriculo' => 'required|string',
			];

			$regras = array_merge($regras, $regrasEstagiario);

		} else {

			$regrasEmpregador = [
				'nome_empresa' => 'required|string|max_length[50]',
				'pessoa_contato' => 'required|string|max_length[50]',
				'endereco_empresa' => 'required|string|max_length[150]',
				'descricao' => 'required|string',
			];

			$regras = array_merge($regras, $regrasEmpregador);

		}

		//mensagens de erro customizadas
		$mensagens = [
			'email' => [
				'is_unique' => 'Esse endereço de email já está sendo utilizado'
			],
			'senha' => [
				'regex_match' => 'A senha deve possuir ao menos 6 caracteres, uma letra maiúscula, um número e um caractere especial.'
			]
		];

		//realiza a validação
		if ($this->validate($regras, $mensagens)) { //salva os dados do usuário se a validação tiver sucesso

			$db = db_connect();
			
			$db->transStart(); //inicia a transação
			
			//usuario
			$modelUsuario = new Usuario();

			$usuario['tipo'] = $request->getVar('tipo_conta');
			$usuario['email'] = $request->getVar('email');
			$usuario['senha'] = password_hash($request->getVar('senha'), PASSWORD_DEFAULT);

			$modelUsuario->save($usuario);

			$idUsuario = $modelUsuario->db->insertID();

			//estagiario
			if ($request->getVar('tipo_conta') == 'estagiario') {

				$modelEstagiario = new Estagiario();

				$estagiario['id_usuario'] = $idUsuario;
				$estagiario['nome'] = $request->getVar('nome');
				$estagiario['curso'] = $request->getVar('curso');
				$estagiario['ano_ingresso'] = $request->getVar('ano_ingresso');
				$estagiario['minicurriculo'] = $request->getVar('minicurriculo');

				$modelEstagiario->save($estagiario);

			} else { //empregador

				$modelEmpregador = new Empregador();

				$empregador['id_usuario'] = $idUsuario;
				$empregador['nome_empresa'] = $request->getVar('nome_empresa');
				$empregador['pessoa_contato'] = $request->getVar('pessoa_contato');
				$empregador['endereco_empresa'] = $request->getVar('endereco_empresa');
				$empregador['descricao'] = $request->getVar('descricao');

				$modelEmpregador->save($empregador);

			}

			$db->transComplete(); //finaliza a transação

			if ($db->transStatus() == false) {

				return redirect()->back()->withInput()->with('warning', 'Não foi possível salvar os dados. Tente novamente mais tarde.');

			} else {

				return redirect('dashboard')->with('success', 'Registrado com sucesso!');

			}
			
		} else { //retorna ao formulário de registro caso a validação falhe
			
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

		}

	}
}
