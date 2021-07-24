<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Konten_model');
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

	public function index()	{
		$validate = $this->Log_model->validateUrl('34')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'Master Konten';
			$data['menu'] = 'masterdata';
			$data['submenu'] = 'konten';
			$data['submenu2'] = '-';
			$data['isform'] = 'Y';
			$array['data_result'] = $this->Konten_model->getKonten('1');
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;
			$this->load->view('template/v_header', $data);
			$this->load->view('master/konten/pengumuman/v_all', $array);
			$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}
}