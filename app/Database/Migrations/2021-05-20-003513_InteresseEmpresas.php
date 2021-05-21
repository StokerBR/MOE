<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InteresseEmpresas extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'auto_increment' => true
			],
			'id_estagiario' => [
				'type' => 'INT'
			],
			'id_empregador' => [
				'type' => 'INT'
			]
		]);

		$this->forge->addField('CONSTRAINT FOREIGN KEY (id_estagiario) REFERENCES usuarios(id)');
		$this->forge->addField('CONSTRAINT FOREIGN KEY (id_empregador) REFERENCES usuarios(id)');

		$this->forge->addKey('id', true);

		$this->forge->createTable('interesse_empresas');
	}

	public function down()
	{
		$this->forge->dropTable('interesse_empresas');
	}
}
