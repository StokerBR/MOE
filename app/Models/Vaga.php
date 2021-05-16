<?php

namespace App\Models;

use CodeIgniter\Model;

class Vaga extends Model
{
	protected $table                = 'vagas';
	protected $primaryKey           = 'id';
	protected $allowedFields        = ['id_empregador', 'descricao', 'lista_atividades', 'semestre_requerido', 'lista_habilidades', 'quantidade_horas', 'remuneracao'];
}
