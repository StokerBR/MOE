<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Estagiarios extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_usuario' => [
				'type' => 'INT'
			],
			'nome' => [
				'type' => 'VARCHAR',
				'constraint' => '50'
			],
			'curso' => [
				'type' => 'ENUM',
				'constraint' => array('es', 'cc', 'si')
			],
			'percentual_curso' => [
				'type' => 'INT'
			],
			'ano_ingresso' => [
				'type' => 'INT'
			],
			'minicurriculo' => [
				'type' => 'TEXT'
			],
		]);

		$this->forge->addField('CONSTRAINT FOREIGN KEY (id_usuario) REFERENCES usuarios(id)');

		$this->forge->addKey('id_usuario', true);

		$this->forge->createTable('estagiarios');

	}

	public function down()
	{
		$this->forge->dropTable('estagiarios');
	}
}
