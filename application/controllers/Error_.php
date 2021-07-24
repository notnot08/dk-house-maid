<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_ extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		if(!isset($_SESSION['logged_in']['username'])){
			redirect('Login');
		} elseif ($_SESSION['logged_in']['aktivasi'] == '0') {
			redirect('Login/aktivasi');
		}

		$this->load->model('Menu_model');
		$this->menuParent = $this->Menu_model->GetMenuParent();
		$this->menuChild = $this->Menu_model->GetMenuChild();
	}

	public function er_403()
	{
		$data['title'] = 'Error';
		$data['menu'] = 'error';
		$data['submenu'] = 'error';
		$data['isform'] = 'Y';
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		$this->load->view('template/v_header1');
		$this->load->view('errors/cli/error_test');
		// $this->load->view('template/v_footer');
	}
}