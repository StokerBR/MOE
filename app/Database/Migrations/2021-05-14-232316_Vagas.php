<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Vagas extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'auto_increment' => true
			],
			'id_empregador' => [
				'type' => 'INT'
			],
			'descricao' => [
				'type' => 'VARCHAR',
				'constraint' => 200
			],
			'lista_atividades' => [
				'type' => 'TEXT',
			],
			'semestre_requerido' => [
				'type' => 'INT',
			],
			'lista_habilidades' => [
				'type' => 'TEXT',
			],
			'quantidade_horas' => [
				'type' => 'INT'
			],
			'remuneracao' => [
				'type' => 'FLOAT'
			],
		]);

		$this->forge->addField('CONSTRAINT FOREIGN KEY (id_empregador) REFERENCES usuarios(id)');

		$this->forge->addKey('id', true);

		$this->forge->createTable('vagas');

	}

	public function down()
	{
		$this->forge->dropTable('vagas');
	}
}
