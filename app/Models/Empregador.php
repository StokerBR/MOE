<?php

namespace App\Models;

use CodeIgniter\Model;

class Empregador extends Model
{
	protected $table                = 'empregadores';
	protected $primaryKey           = 'id';
	protected $allowedFields        = ['id_usuario', 'nome_empresa', 'pessoa_contato', 'endereco_empresa', 'descricao'];
}
