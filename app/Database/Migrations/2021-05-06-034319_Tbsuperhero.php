<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbsuperhero extends Migration
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
				'constraint' => '50',
				'unique' => true
			],
			'jenis_kelamin' => [
				'type' => 'ENUM',
				'constraint' => ['Laki Laki','Perempuan'],
				'default' => 'Laki Laki',
				'null' => false
			] 
		]);

		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('tb_superhero');
	}

	public function down()
	{
		//
	}
}
