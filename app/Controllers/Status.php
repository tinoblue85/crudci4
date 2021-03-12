<?php

namespace App\Controllers;

class Status extends BaseController
{
	public function index()
	{
		$session = \Config\Services::session($config);
		if($session->has('username')){
			$data['session']=$session;
			return view("daftar_status",$data);
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
		$builder=$this->db->table("tbl_status");
		if($mode=='edit'){
		$builder->where('id_status',$post['id']);
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
			$builder->where('id_status',$post['id']);
			unset($post['id']);
			$builder->delete();
			if($builder){
				echo "Data berhasil dihapus";
			}
			
		}
	}
	
	
	public function json_status(){
		$session = \Config\Services::session($config);
		$page = $_POST['page']; // get the requested page
		$limit = $_POST['rows']; // get how many rows we want to have into the grid
		$sidx = $_POST['sidx']; // get index row - i.e. status click to sort
		$sord = $_POST['sord']; // get the direction
		$searchString = isset($_POST['searchString'])?$_POST['searchString']:''; // get the direction
		$searchField = isset($_POST['searchField'])?$_POST['searchField']:''; // get the direction
		if (!$sidx) {
			$sidx = 1;
		}
		$db      = \Config\Database::connect();
		$builder = $db->table('tbl_status a');

		$filter="";
		if($searchString!=""){
			$builder->like($searchField,$searchString);
			
		}
		
		
		$count = $builder->countAllResults();
		
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
		
	
		$responce = new \stdClass();
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i = 0;
		
		$get=$builder->get()->getResultArray();
		//var_dump($get);die();
		foreach($get as $row){
			$id=$row['id_status'];
			$responce->rows[$i]['id'] = $row['id_status'];
			
			$responce->rows[$i]['cell'] = array($row['id_status'], $row['nama_status']);
			$i++;
		}
		echo json_encode($responce);
	}
	
	
}
