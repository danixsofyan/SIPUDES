<?php

class Ins extends MY_Controller {
	function __construct(){

		parent::__construct();
		$this->load->model('M_desa');
	}

	public function index()
	{
		$data=array(
			"title"=>'Manajemen Desa',
			"menu"=>getmenu(),
			"aktif"=>"ins",
			"getrow"=>$this->db->get('desa')->row_array(),
			"content"=>"ins/index.php",
		);
		$this->breadcrumb->append_crumb('Manajemen Desa', site_url('ins'));
		$this->load->view('admin/templatedash',$data);
	}

	public function add()
	{
		$id = $_POST['id_desa'];;
		$data['desa'] 			= $_POST['desa'];
		$data['kecamatan'] 		= $_POST['kecamatan'];
		$data['kabupaten'] 		= $_POST['kabupaten'];
		$data['kepala_desa'] 	= $_POST['kepala_desa'];
		$this->M_desa->save($data,$id); // model untuk edit data
		$this->session->set_flashdata('sukses',"Data Berhasil Diupdate");
		redirect('Ins');
	}



}
