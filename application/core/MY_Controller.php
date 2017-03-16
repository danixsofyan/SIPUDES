<?php
class MY_Controller extends CI_Controller {
	
	public $data = array();
		function __construct() {
			parent::__construct();
			$this->load->helper('url');
			$this->load->helper('form');
			$config['tag_open'] = '<ul class="breadcrumb">';
			$config['tag_close'] = '</ul>';
			$config['li_open'] = '<li>';
			$config['li_close'] = '</li>';
			$config['divider'] = '<span class="divider"> » </span>';
			$this->breadcrumb->initialize($config);
			no_access();
			levelsuper();
		}
}