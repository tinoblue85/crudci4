<?php

namespace App\Controllers;

class User extends BaseController
{
	public function index()
	{
		$session = \Config\Services::session($config);
		if($session->has('username')){
			$data['session']=$session;
			$data['cboUnit']=$this->getUnit();
			$data['cboLevel']=$this->getLevel();
			return view("daftar_user",$data);
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
		$builder=$this->db->table("tbl_user");
		if($mode=='edit'){
		$builder->where('id_user',$post['id']);
		unset($post['id']);
		$sql=$builder->getCompiledUpdate();
		//echo $sql;die();
		$update=$builder->update($post);
		if($update){
			echo "Sukses";
		}
		}elseif($mode=='add'){
			
			$builder->insert($post);
			echo "Data berhasil ditambah";
		}else{
			$builder->where('id_user',$post['id']);
			unset($post['id']);
			$builder->delete();
			if($builder){
				echo "Data berhasil dihapus";
			}
			
		}
	}
	
	
	public function json_user(){
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
		$builder = $db->table('tbl_user a');

		$filter="";
		if($searchString!=""){
			$builder->like($searchField,$searchString);
			
		}
		
		
		$count = $builder->countAllResults();
		$builder->select("b.nama_unit,a.*,c.nama_level",false);
		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages) {
			$page = $total_pages;
		}
		
		$start = $limit * $page - $limit; // do not put $limit*($page - 1)
		$builder->orderBy($sidx, $sord);
		$builder->limit($start, $limit);
		$builder->join("tbl_unit b","a.id_unit=b.id_unit");
		$builder->join("tbl_level c","a.id_level=c.id_level");
	
		$responce = new \stdClass();
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i = 0;
		
		$get=$builder->get()->getResultArray();
		//var_dump($get);die();
		foreach($get as $row){
			$id=$row['id_user'];
			$responce->rows[$i]['id'] = $row['id_user'];
			
			$responce->rows[$i]['cell'] = array($row['nama_unit'], $row['username'], $row['password'], $row['nama_level']);
			$i++;
		}
		echo json_encode($responce);
	}
	
	public function getUnit(){
		$builder=$this->db->table('tbl_unit');
		$builder->orderBy('nama_unit','ASC');
		$get=$builder->get()->getResultArray();
		
		foreach($get as $dt){
			$arr[]=$dt['id_unit'].":".$dt['nama_unit'];
		}
		return implode(";",$arr);
	}	
	
	public function getLevel(){
		$builder=$this->db->table('tbl_level');
		$builder->orderBy('nama_level','ASC');
		$get=$builder->get()->getResultArray();
		
		foreach($get as $dt){
			$arr[]=$dt['id_level'].":".$dt['nama_level'];
		}
		return implode(";",$arr);
	}
	
}
