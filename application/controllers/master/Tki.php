<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tki extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('User_model');
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
		$data['title'] = 'Master Data';
		$data['menu'] = 'masterdata';
		$data['submenu'] = 'tki';
		$data['submenu2'] = '-';
		$data['isform'] = 'Y';
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		$this->load->view('template/v_header', $data);
		$this->load->view('v_dashboard');
		$this->load->view('template/v_footer');
	}
}