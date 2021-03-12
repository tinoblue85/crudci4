<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$session = \Config\Services::session($config);
		if($session->has('username')){
			$data['session']=$session;
			return view('dashboard',$data);
		}else{
			return view('login');
			
		}
	}
	
	public function edit(){
		$request = \Config\Services::request();
		$session = \Config\Services::session($config);
		$post=$request->getPost();
		$mode=$post['oper'];
		unset($post['oper']);
		$builder=$this->db->table("tbl_data_karyawan");
		if($mode=='edit'){
		$builder->where('id_data_karyawan',$post['id']);
		unset($post['id']);
		$sql=$builder->getCompiledUpdate();
		//echo $sql;die();
		$update=$builder->update($post);
		if($update){
			echo "Sukses";
		}
		}elseif($mode=='add'){
			unset($post['id']);
			$post['id_unit']=$session->get('id_unit');
			$builder->insert($post);
			echo "Data berhasil ditambah";
		}else{
			$builder->where('id_data_karyawan',$post['id']);
			unset($post['id']);
			$builder->delete();
			if($builder){
				echo "Data berhasil dihapus";
			}
			
		}
	}
	
	public function proses_login(){
		$session = \Config\Services::session($config);
		$request = \Config\Services::request();
		$post=$request->getPost();
		$db      = \Config\Database::connect();
		$builder = $db->table('tbl_user a');
		$builder->where('username',$post['username']);
		$builder->where('password',$post['password']);
		$cek=$builder->countAllResults();
		if($cek==0){
			return redirect()->back()->with('danger', 'Username atau Password Salah!');
		}else{
			$builder->join("tbl_unit b","a.id_unit=b.id_unit");
			$builder->join("tbl_level c","a.id_level=c.id_level");
			$getData=$builder->get()->getRowArray();
			
		$newdata = [
				'username'  => $post['username'],
				'nama_unit'     => $getData['nama_unit'],
				'nama_level'     => $getData['nama_level'],
				'id_unit'     => $getData['id_unit'],
				'logged_in' => TRUE
		];
		
		$session->set($newdata);
			return redirect()->route('/');
		}
	}
	
	public function getJabatan(){
		$builder=$this->db->table('tbl_jabatan');
		$builder->orderBy('nama_jabatan','ASC');
		$get=$builder->get()->getResultArray();
		
		foreach($get as $dt){
			$arr[]=$dt['id_jabatan'].":".$dt['nama_jabatan'];
		}
		return implode(";",$arr);
	}
	
	public function getPendidikan(){
		$builder=$this->db->table('tbl_pendidikan');
		$builder->orderBy('nama_pendidikan','ASC');
		$get=$builder->get()->getResultArray();
		
		foreach($get as $dt){
			$arr[]=$dt['id_pendidikan'].":".$dt['nama_pendidikan'];
		}
		return implode(";",$arr);
	}
	
	public function getStatus(){
		$builder=$this->db->table('tbl_status');
		$builder->orderBy('nama_status','ASC');
		$get=$builder->get()->getResultArray();
		
		foreach($get as $dt){
			$arr[]=$dt['id_status'].":".$dt['nama_status'];
		}
		return implode(";",$arr);
	}
	
	public function getJenisKelamin(){
		$builder=$this->db->table('tbl_jenis_kelamin');
		$builder->orderBy('nama_jenis_kelamin','ASC');
		$get=$builder->get()->getResultArray();
		
		foreach($get as $dt){
			$arr[]=$dt['id_jenis_kelamin'].":".$dt['nama_jenis_kelamin'];
		}
		return implode(";",$arr);
	}
	
	public function pegawai(){
		$data['cboJabatan']=$this->getJabatan();
		$data['cboJenisKelamin']=$this->getJenisKelamin();
		$data['cboStatus']=$this->getStatus();
		$data['cboPendidikan']=$this->getPendidikan();
		return view("daftar_pegawai",$data);
	}
	
	public function json_pegawai(){
		$session = \Config\Services::session($config);
		$page = $_POST['page']; // get the requested page
		$limit = $_POST['rows']; // get how many rows we want to have into the grid
		$sidx = $_POST['sidx']; // get index row - i.e. user click to sort
		$sord = $_POST['sord']; // get the direction
		$searchString = isset($_POST['searchString'])?$_POST['searchString']:''; // get the direction
		$searchField = isset($_POST['searchField'])?$_POST['searchField']:''; // get the direction
		if (!$sidx) {
			$sidx = 1;
		}
		$db      = \Config\Database::connect();
		$builder = $db->table('tbl_data_karyawan a');
		
	
		
		$filter="";
		if($searchString!=""){
			$builder->like($searchField,$searchString);
			
		}
		
		
		$count = $builder->countAllResults();
		$builder->select("b.nama_unit,a.*,c.nama_jabatan,d.nama_jenis_kelamin,e.nama_pendidikan,f.nama_status,TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE())umur,TIMESTAMPDIFF(YEAR, tgl_mulai_kerja, CURDATE())lama_kerja",false);
		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages) {
			$page = $total_pages;
		}
		$id_unit=$session->get('id_unit');
		
		$start = $limit * $page - $limit; // do not put $limit*($page - 1)
		$builder->orderBy($sidx, $sord);
		$builder->limit($start, $limit);
		$builder->join("tbl_unit b","a.id_unit=b.id_unit");
		$builder->join("tbl_jabatan c","a.id_jabatan=c.id_jabatan");
		$builder->join("tbl_jenis_kelamin d","d.id_jenis_kelamin=a.id_jenis_kelamin");
		$builder->join("tbl_pendidikan e","e.id_pendidikan=a.id_pendidikan");
		$builder->join("tbl_status f","f.id_status=a.id_status");
		if($id_unit!=2){
				$builder->where('a.id_unit',$id_unit);
		}
		$responce = new \stdClass();
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i = 0;
		
		$get=$builder->get()->getResultArray();
		//var_dump($get);die();
		foreach($get as $row){
			$id=$row['id_data_karyawan'];
			$responce->rows[$i]['id'] = $row['id_data_karyawan'];
			$link_edit="<a href='javascript:void(0)' onclick='edit_pegawai($id)'><i class='fa fa-edit'></i></a>";
			$link_hapus="<a href='javascript:void(0)' onclick='hapus_pegawai($id)'><i class='fa fa-trash'></i></a>";
			$responce->rows[$i]['cell'] = array($row['nama_unit'], $row['nama'], $row['ktp'], $row['npwp'], $row['nama_jenis_kelamin'], $row['alamat'], $row['tempat_lahir'], $row['tgl_lahir'], $row['umur'], $row['tgl_mulai_kerja'], $row['nama_jabatan'], $row['nama_pendidikan'], $row['nama_status'], $row['flag_bpjs_tk']==1?'Aktif':'Tidak Aktif', $row['flag_bpjs_kes']==1?'Aktif':'Tidak Aktif');
			$i++;
		}
		echo json_encode($responce);
	}
	
	public function logout(){
		$session = \Config\Services::session($config);
		session_destroy();
		return redirect()->route('/');
	}
}
