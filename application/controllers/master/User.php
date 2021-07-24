<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Log_model');
		$this->load->model('Perusahaan_model');
		
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

	public function index($param = FALSE) {
		$validate = $this->Log_model->validateUrl('29')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Master Data';
		$data['menu'] = 'masterdata';
		$data['submenu'] = 'user';
		$data['submenu2'] = '-';
		$data['isform'] = 'Y';

		if ($param === FALSE) {
			$array['data_user'] = $this->User_model->get_user();
		} else {
			$array['data_user'] = $this->User_model->get_user($param);
		}
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;		
		$this->load->view('template/v_header', $data);
		$this->load->view('master/user/v_user_all', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function detail($param = FALSE){
		$validate = $this->Log_model->validateUrl('30')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Master Data';
		$data['menu'] = 'masterdata';
		$data['submenu'] = 'user';
		$data['submenu2'] = '-';
		$data['isform'] = 'Y';

		if ($param === FALSE) {
			redirect('master/User');
		} else {
			$array['data_user'] = $this->User_model->get_user_detail($param);
			$array['data_log_activity'] = $this->Log_model->get_log('ACTIVITY', $param);
			$array['data_log_user'] = $this->Log_model->get_log('USER', $param);
		}
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		
		$this->load->view('template/v_header', $data);
		$this->load->view('master/user/v_user_edit', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

}