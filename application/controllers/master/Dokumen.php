<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Dokumen_model');
		$this->load->model('Log_model');
		
		if(!isset($_SESSION['logged_in']['username'])){
			redirect('Login');
		} elseif ($_SESSION['logged_in']['aktivasi'] == '0') {
			redirect('Login/aktivasi');
		} elseif ($_SESSION['logged_in']['role'] == '3') {
			redirect('Error_/er_403');
		} 

		$this->load->model('Menu_model');
		$this->menuParent = $this->Menu_model->GetMenuParent();
		$this->menuChild = $this->Menu_model->GetMenuChild();
	}

	public function index() {
		$validate = $this->Log_model->validateUrl('25')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Master Data';
		$data['menu'] = 'masterdata';
		$data['submenu'] = 'jenis_doc';
		$data['submenu2'] = '-';
		$data['isform'] = 'Y';
		$array['data_doc'] = $this->Dokumen_model->get_doc_type();
		$array['data_log_doc_type'] = $this->Log_model->get_log('DOC_TYPE');
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		$this->load->view('template/v_header', $data);
		$this->load->view('master/dokumen/v_jenis_dokumen', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}
}