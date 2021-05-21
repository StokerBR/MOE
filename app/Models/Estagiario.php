<?php

namespace App\Models;

use CodeIgniter\Model;

class Estagiario extends Model
{
	protected $table                = 'estagiarios';
	protected $primaryKey           = 'id_usuario';
	protected $allowedFields        = ['id_usuario', 'nome', 'curso', 'ano_ingresso', 'minicurriculo'];
}
