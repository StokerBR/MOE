<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Empregadores extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'auto_increment' => true
			],
			'id_usuario' => [
				'type' => 'INT'
			],
			'nome_empresa' => [
				'type' => 'VARCHAR',
				'constraint' => '50'
			],
			'pessoa_contato' => [
				'type' => 'VARCHAR',
				'constraint' => '50'
			],
			'endereco_empresa' => [
				'type' => 'VARCHAR',
				'constraint' => '150'
			],
			'descricao' => [
				'type' => 'TEXT'
			],
		]);

		$this->forge->addField('CONSTRAINT FOREIGN KEY (id_usuario) REFERENCES usuarios(id)');

		$this->forge->addKey('id', true);

		$this->forge->createTable('empregadores');

	}

	public function down()
	{
		$this->forge->dropTable('empregadores');
	}
}
