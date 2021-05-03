<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'auto_increment' => true,
			],
			'tipo' => [
				'type' => 'ENUM',
				'constraint' => array('coordenador', 'estagiario', 'empregador'),
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
			'senha' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
		]);

		$this->forge->addKey('id', true);
		
		$this->forge->createTable('usuarios');
	}

	public function down()
	{
		$this->forge->dropTable('usuarios');
	}
}
