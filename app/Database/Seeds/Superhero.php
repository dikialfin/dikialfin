<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Superhero extends Seeder
{
	public function run()
	{
		
	$this->db->query("INSERT INTO tb_superhero (nama, jenis_kelamin) VALUES('Professor X', 'Laki Laki')");
	$this->db->query("INSERT INTO tb_superhero (nama, jenis_kelamin) VALUES('Wolverine', 'Laki Laki')");
	$this->db->query("INSERT INTO tb_superhero (nama, jenis_kelamin) VALUES('Beast', 'Laki Laki')");
	$this->db->query("INSERT INTO tb_superhero (nama, jenis_kelamin) VALUES('Raven', 'Perempuan')");
	$this->db->query("INSERT INTO tb_superhero (nama, jenis_kelamin) VALUES('Storm', 'Perempuan')");

	}
}
