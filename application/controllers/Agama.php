<?php

class Agama extends MY_Controller {
	function __construct(){

		parent::__construct();
		$this->load->model('M_agama');
	}
	
	public function index()
	{
		$data=array(
			"title"=>'Agama',
			"menu"=>getmenu(),
			"all"=>$this->db->get('agama')->result(),
			"aktif"=>"agama",
			"content"=>"agama/index.php",
		);
		$this->breadcrumb->append_crumb('Agama', site_url('agama'));
		$this->load->view('admin/template',$data);
	}

	public function add()
	{	
		$data['agama'] = $_POST['agama'];
		$data['status'] = 1;
		$this->M_agama->save($data, NULL); // model untuk add data
		$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
		redirect('Agama');
	}

	public function edit()
	{
		$id = $_POST['id'];;
		$data['agama'] = $_POST['agama'];
		$this->M_agama->save($data,$id); // model untuk edit data
		$this->session->set_flashdata('sukses',"Data Berhasil Diedit");
		redirect('Agama');
	}

	public function hapus($id)
	{
		$this->M_agama->delete($id); // model untuk delete data
		$this->session->set_flashdata('sukses',"Data Berhasil Dihapus"); // menampilkan notifikasi
		redirect('Agama');
	}
}
