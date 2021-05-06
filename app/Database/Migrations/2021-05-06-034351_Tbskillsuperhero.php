<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbskillsuperhero extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_superhero' =>	[
				'type' => 'INT',
				'constraint' => 2
			],
			'id_skill' => [
				'type' => 'INT',
				'constraint' => 2
			]
		]);

		$this->forge->addForeignKey('id_superhero','tb_superhero','id','cascade','cascade');
		$this->forge->addForeignKey('id_skill','tb_skill','id','cascade','cascade');
		$this->forge->createTable('tb_skill_superhero');
	}

	public function down()
	{
		//
	}
}
