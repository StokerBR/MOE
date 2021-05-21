<?php

namespace App\Models;

use CodeIgniter\Model;

class Empregador extends Model
{
	protected $table                = 'empregadores';
	protected $primaryKey           = 'id_usuario';
	protected $allowedFields        = ['id_usuario', 'nome_empresa', 'pessoa_contato', 'endereco_empresa', 'descricao'];

	public function vagas($idEmpregador) {

		$this->select('*');
		$this->from('vagas');
		$this->where('vagas.id_empregador', $idEmpregador);
		return $this->get()->getResultArray();

	}

}
