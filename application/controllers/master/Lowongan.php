<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowongan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Lowongan_model');
		$this->load->model('Log_model');
		$this->load->model('GenerateID_model');
		$this->load->model('Pekerjaan_model');
		
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
		$validate = $this->Log_model->validateUrl('11')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Master Data';
		$data['menu'] = 'masterdata';
		$data['submenu'] = 'lowongan';
		$data['submenu2'] = '-';
		$data['isform'] = 'N';
		$array['data_lowongan'] = $this->Lowongan_model->get_lowongan();
		$array['data_log_kualifikasi'] = $this->Log_model->get_log('KUALIFIKASI');
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		$this->load->view('template/v_header', $data);
		$this->load->view('master/lowongan/v_lowongan', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function add(){
		$validate = $this->Log_model->validateUrl('10')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'Master Data';
			$data['menu'] = 'masterdata';
			$data['submenu'] = 'lowongan';
			$data['submenu2'] = '-';
			$data['isform'] = 'Y';
			$array['data_negara'] = $this->GenerateID_model->get_negara_list();
			$array['data_pekerjaan_aktif'] = $this->Pekerjaan_model->get_active_job();
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;
			$this->load->view('template/v_header', $data);
			$this->load->view('lowongan/v_add_lowongan', $array);
			$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}		
	}
	
}