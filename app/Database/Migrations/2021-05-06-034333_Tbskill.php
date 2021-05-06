<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbskill extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' =>	[
				'type' => 'INT',
				'auto_increment' => true,
				'constraint' => 2
			],
			'nama' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'unique' => true
			]
		]);

		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('tb_skill');
	}

	public function down()
	{
		//
	}
}
