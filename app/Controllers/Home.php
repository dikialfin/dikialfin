<?php

namespace App\Controllers;

use \App\Models\superheroModel;
use \App\Models\skillModel;
use \App\Models\skillSuperheroModel;
use Exception;

class Home extends BaseController
{
	protected 	$superheroModel,
				$skillModel,
				$skillSuperheroModel;

	public function __construct()
	{
		$this->superheroModel = new superheroModel();
		$this->skillModel = new skillModel();
		$this->skillSuperheroModel = new skillSuperheroModel();
	}

	public function index()
	{
		$data_superhero = $this->superheroModel->findAll();

		if ($this->request->getGet('keyword')) {
			$data_superhero = $this->superheroModel
							->like('nama',$this->request->getGet('keyword'))
							->orLike('jenis_kelamin',$this->request->getGet('keyword'))
							->findAll();
		}

		$data = [
			'title' => "Daftar Superhero",
			'superhero' => $data_superhero,
			'session' => $this->session
		];

		return view('superhero', $data);
	}

	public function hapusSuperhero($id_superhero = null)
	{
		try {
			$this->superheroModel->where('id',$id_superhero)->delete();
			$this->session->setFlashdata('success','Berhasil menghapus superhero');
			return redirect()->to('/');
		} catch (Exception $error) {
			return $error->getMessage();
			$this->session->setFlashdata('failed','Gagal menghapus suerhero');
			return redirect()->to('/');
		}
	}

	public function detailSuperhero($id = null)
	{

		$data_skill_superhero = 	$this->skillSuperheroModel
									->select('tb_skill.nama as skill_superhero, tb_skill.id')
									->join('tb_skill','tb_skill.id = tb_skill_superhero.id_skill')
									->join('tb_superhero','tb_superhero.id = tb_skill_superhero.id_superhero','let')
									->where('tb_skill_superhero.id_superhero',$id)
									->findAll();
		$data_superhero = $this->superheroModel->where('id',$id)->first();
		$data = [
			'detail_superhero' => $data_superhero,
			'detail_skill' => $data_skill_superhero
		];
		$skill = $this->skillModel->orderBy('id','desc')->findAll();

		$data = [
			'title' => "Detail Superhero",
			'superhero' => $data,
			'skill' => $skill,
			'session' => $this->session
		];

		return view('detail_superhero',$data);
	}

	public function hapusSkillHeroes($id_superhero = null, $id_skill = null) {
		try {
			$this->skillSuperheroModel
			->where("id_superhero = $id_superhero AND id_skill = $id_skill")
			->delete();
			$this->session->setFlashdata('success',"Berhasil menghapus skill pada superhero");
			return redirect()->to("/home/detailSuperhero/".$id_superhero);
		} catch (Exception $error) {
			$this->session->setFlashdata('failed',"Berhasil menghapus skill pada superhero");
			return redirect()->to("/home/detailSuperhero/".$id_superhero);
		}
	}

	public function addSkillSuperhero()
	{
		
		$insert = [
			'id_superhero' => $this->request->getPost('id_superhero'),
			'id_skill' => $this->request->getPost('id_skill')
		];

		try {
			foreach ($insert['id_skill'] as $id_skill) {
				$this->skillSuperheroModel->insert([
					'id_superhero' => $insert['id_superhero'],
					'id_skill' => $id_skill
				]);
			}

			$this->session->setFlashdata('success',"Berhasil menambah skill superhero");
			return redirect()->to("/home/detailSuperhero/".$insert['id_superhero']);
		} catch (Exception $error) {
			return $error->getMessage();
			$this->session->setFlashdata('failed',"Gagal menambah skill superhero");
			return redirect()->to("/home/detailSuperhero/".$insert['id_superhero']);
		}
	}

	public function editSuperhero($id = null){
		$update = [
			'nama' => $this->request->getGet('nama'),
			'jenis_kelamin' => $this->request->getGet('jenis_kelamin')
		];

		try {
			$this->superheroModel->update($id,$update);
			$this->session->setFlashdata('success','Berhasil mengubah data superhero');
			return redirect()->to('/');
		} catch (Exception $error) {
			$this->session->setFlashdata('failed','Gagal mengubah data superhero');
			return redirect()->to('/');
		}
	}

	public function menikah()
	{
		$suami = $this->superheroModel->where('jenis_kelamin','Laki Laki')->findAll();
		$istri = $this->superheroModel->where('jenis_kelamin','Perempuan')->findAll();
		$anak = null;
		$id_suami = null;
		$id_istri = null;
		if ($this->request->getPost()) {
			$id_suami = $this->request->getPost('suami');
			$id_istri = $this->request->getPost('istri');

			$anak = $this->skillSuperheroModel
					->select('tb_skill.nama as nama_skill')
					->join('tb_skill','tb_skill.id = tb_skill_superhero.id_skill')
					->where("id_superhero = $id_suami AND $id_istri")
					->findAll();
		}
		$data = [
			'title' => 'Menikah',
			'session' => $this->session,
			'suami' => $suami,
			'istri' => $istri,
			'anak' => $anak,
			'id_suami' => $id_suami,
			'id_istri' => $id_istri
		];

		return view('menikah',$data);
	}

	public function skill()
	{
		$data_skill = $this->skillModel->findAll();

		if ($this->request->getGet('keyword')) {
			$data_skill = $this->skillModel
							->like('nama',$this->request->getGet('keyword'))
							->findAll();
		}

		$data = [
			'title' => "Daftar Skill",
			'skill' => $data_skill,
			'session' => $this->session
		];

		return view('skill',$data);
	}

	public function detailSkill($id = null)
	{
		$list_heroes = 	$this->skillSuperheroModel
						->select('tb_superhero.nama as nama_superhero, tb_superhero.id as id_superhero')
						->join('tb_superhero','tb_superhero.id = tb_skill_superhero.id_superhero')
						->where("tb_skill_superhero.id_skill = $id")
						->findAll();

		$list_heroes2 = $this->superheroModel->findAll();

		$detail_skill = $this->skillModel->where('id',$id)->first();

		$data = [
			'title' => "Detail Superhero",
			'list_heroes' => $list_heroes,
			'list_heroes2' => $list_heroes2,
			'detail_skill' => $detail_skill,
			'session' => $this->session
		];

		return view('detail_skill',$data);
	}

	public function editSkill($id = null){
		$update = [
			'nama' => $this->request->getGet('nama')
		];

		try {
			$this->skillModel->update($id,$update);
			$this->session->setFlashdata('success','Berhasil mengubah data skill');
			return redirect()->to('/home/detailSkill/'.$id);
		} catch (Exception $error) {
			$this->session->setFlashdata('failed','Gagal mengubah data skill');
			return redirect()->to('/home/detailSkill/'.$id);
		}
	}

	public function addHeroSkill()
	{
		$insert = [
			'id_skill' => $this->request->getPost('id_skill'),
			'id_superhero' => $this->request->getPost('id_superhero'),
		];

		try {
			foreach ($insert['id_superhero'] as $id_superhero) {
				$this->skillSuperheroModel->insert([
					'id_superhero' => $id_superhero,
					'id_skill' => $insert['id_skill']
				]);
			}

			$this->session->setFlashdata('success',"Berhasil menambah skill superhero");
			return redirect()->to("/home/detailSkill/".$insert['id_skill']);
		} catch (Exception $error) {
			return $error->getMessage();
			$this->session->setFlashdata('failed',"Gagal menambah skill superhero");
			return redirect()->to("/home/detailSkill/".$insert['id_skill']);
		}
	}

	public function removeHeroSkill($id_superhero = null, $id_skill = null)
	{
		try {
			$this->skillSuperheroModel
			->where("id_superhero = $id_superhero AND id_skill = $id_skill")
			->delete();
			$this->session->setFlashdata('success',"Berhasil menghapus skill pada superhero");
			return redirect()->to("/home/detailSkill/".$id_skill);
		} catch (Exception $error) {
			$this->session->setFlashdata('failed',"Gagal menghapus skill pada superhero");
			return redirect()->to("/home/detailSkill/".$id_skill);
		}
	}

	public function hapusSkill($id_skill)
	{
		try {
			$this->skillModel->where('id',$id_skill)->delete();
			$this->session->setFlashdata('success',"Berhasil menghapus skill");
			return redirect()->to("/home/skill");
		} catch (\Throwable $th) {
			$this->session->setFlashdata('failed',"Gagal menghapus skill");
			return redirect()->to("/home/skill");
		}
	}
}
