<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kualifikasi extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Kualifikasi_model');
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
		$validate = $this->Log_model->validateUrl('26')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Master Data';
		$data['menu'] = 'masterdata';
		$data['submenu'] = 'kualifikasi';
		$data['submenu2'] = '-';
		$data['isform'] = 'Y';
		$array['data_kualifikasi'] = $this->Kualifikasi_model->get_kualifikasi();
		$array['data_log_kualifikasi'] = $this->Log_model->get_log('KUALIFIKASI');
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		$this->load->view('template/v_header', $data);
		$this->load->view('master/kualifikasi/v_kualifikasi', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}
	
}