<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Skill extends Seeder
{
	public function run()
	{
		$this->db->query("INSERT INTO tb_skill (nama) VALUES('Terbang')");
		$this->db->query("INSERT INTO tb_skill (nama) VALUES('Makan Beling')");
		$this->db->query("INSERT INTO tb_skill (nama) VALUES('Tidur Tanpa Merem')");
		$this->db->query("INSERT INTO tb_skill (nama) VALUES('Merem Tanpa Tidur')");
		$this->db->query("INSERT INTO tb_skill (nama) VALUES('Sembuh Dengan Cepat')");
		$this->db->query("INSERT INTO tb_skill (nama) VALUES('Mempunyai Cakar Yang Lebih Kuat Dari Baja')");
		$this->db->query("INSERT INTO tb_skill (nama) VALUES('Membuat Hujan')");
		$this->db->query("INSERT INTO tb_skill (nama) VALUES('Membuat Petir')");
		$this->db->query("INSERT INTO tb_skill (nama) VALUES('Mengendalikan Angin dan Badai')");
	}
}
