<?php

namespace App\Models;

use CodeIgniter\Model;

class InteresseEmpresa extends Model
{
	protected $table                = 'interesse_empresas';
	protected $primaryKey           = 'id';
	protected $allowedFields        = ['id_estagiario', 'id_empregador'];
}
