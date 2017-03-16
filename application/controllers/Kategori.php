<?php

class Kategori extends MY_Controller {
	function __construct(){

		parent::__construct();
		$this->load->model('M_kategori');
	}

	public function index()
	{
		$data=array(
			"title"=>'Kategori',
			"menu"=>getmenu(),
			"all"=>$this->db->get('kategori')->result(),
			"aktif"=>"kategori",
			"content"=>"kategori/index.php",
		);
		$this->breadcrumb->append_crumb('Kategori', site_url('kategori'));
		$this->load->view('admin/template',$data);
	}

	public function add()
	{	
		$data['kategori'] = $_POST['kategori'];
		$data['status'] = 1;
		$this->M_kategori->save($data, NULL); // model untuk add data
		$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
		redirect('Kategori');
	}

	public function edit()
	{
		$id = $_POST['id'];;
		$data['kategori'] = $_POST['kategori'];
		$this->M_kategori->save($data,$id); // model untuk edit data
		$this->session->set_flashdata('sukses',"Data Berhasil Diedit");
		redirect('Kategori');
	}

	public function hapus($id)
	{
		$this->M_kategori->delete($id); // model untuk delete data
		$this->session->set_flashdata('sukses',"Data Berhasil Dihapus"); // menampilkan notifikasi
		redirect('Kategori');
	}

}
