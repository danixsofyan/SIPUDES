<?php

class Klasifikasi extends CI_Controller {
	function __construct(){

		parent::__construct();
		$this->load->model('M_klasifikasi');
	}

	public function index()
	{
		$data=array(
			"title"=>'Klasifikasi',
			"menu"=>getmenu(),
			"all"=>$this->db->get('klasifikasi')->result(),
			"aktif"=>"klasifikasi",
			"content"=>"klasifikasi/index.php",
		);
		$this->breadcrumb->append_crumb('Klasifikasi', site_url('klasifikasi'));
		$this->load->view('admin/template',$data);
	}

	public function add()
	{	
		$data['klasifikasi'] = $_POST['klasifikasi'];
		$data['status'] = 1;
		$this->M_klasifikasi->save($data, NULL); // model untuk add data
		$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
		redirect('Klasifikasi');
	}

	public function edit()
	{
		$id = $_POST['id'];;
		$data['klasifikasi'] = $_POST['klasifikasi'];
		$this->M_klasifikasi->save($data,$id); // model untuk edit data
		$this->session->set_flashdata('sukses',"Data Berhasil Diedit");
		redirect('Klasifikasi');
	}

	public function hapus($id)
	{
		$this->M_klasifikasi->delete($id); // model untuk delete data
		$this->session->set_flashdata('sukses',"Data Berhasil Dihapus"); // menampilkan notifikasi
		redirect('Klasifikasi');
	}

	
	public function detail($id)
	{
		$getrow=$this->M_klasifikasi->getrow($id)->row_array();
		$data=array(
			"title"=>'Detail||Klasifikasi',
			"menu"=>getmenu(),
			"all"=>$this->db->where('id_klasifikasi',$id)->get('kategori_klasifikasi')->result(),
			"aktif"=>"klasifikasi",
			"kategori"=>$getrow['klasifikasi'],
			"id"=>$id,
			"content"=>"klasifikasi/detail.php",
		);
		$this->breadcrumb->append_crumb('Klasifikasi', site_url('klasifikasi'));
		$this->breadcrumb->append_crumb('Kategori Di Klasifikasi <strong><i>'.$getrow['klasifikasi'].'</i></strong>', site_url('klasifikasi/detail/'.$id));
		$this->load->view('admin/template',$data);
	}
	public function addkategori($id)
	{
		$this->form_validation->set_rules('kategori', 'kategori', 'required');
		$getrow=$this->M_klasifikasi->getnum($_POST['kategori'],$id)->num_rows();
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Inputkan");
			redirect('klasifikasi/detail/'.$id);
		}elseif($getrow>0){
			$this->session->set_flashdata('error',"Data Sudah Ada");
			redirect('klasifikasi/detail/'.$id);
		}else{
			$data=array(
				"id_kategori"=>$_POST['kategori'],
				"id_klasifikasi"=>$id,
				"status"=>1,
			);
			$this->db->insert('kategori_klasifikasi',$data);
			$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
			redirect('klasifikasi/detail/'.$id);
		}
	}
	public function hapuskategori($id_kategori,$id)
	{
		if($id==""){
			$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");
			redirect('klasifikasi/detail/'.$id);
		}else{
			$data=array(
				"status"=>1
			);
			$this->db->where('id_klasifikasi',$id);
			$this->db->where('id_kategori',$id_kategori);
			$this->db->delete('kategori_klasifikasi');
			$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");
			redirect('klasifikasi/detail/'.$id);
		}
	}
}
