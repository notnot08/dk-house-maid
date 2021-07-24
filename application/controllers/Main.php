<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Dashboard_model');
		$this->load->model('Log_model');
		$this->load->model('User_model');
		
		if(!isset($_SESSION['logged_in']['username'])){
			redirect('Login');
		} elseif ($_SESSION['logged_in']['aktivasi'] == '0') {
			redirect('Login/aktivasi');
		} 

		$this->load->model('Menu_model');
		$this->menuParent = $this->Menu_model->GetMenuParent();
		$this->menuChild = $this->Menu_model->GetMenuChild();
	}

	public function index() {
		$validate = $this->Log_model->validateUrl('1')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'Dashboard';
			$data['menu'] = 'dashboard';
			$data['submenu'] = 'dashboard';
			$data['submenu2'] = '-';
			$data['isform'] = 'N';
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;
		// print_r($data['menu']);
			$this->load->view('template/v_header', $data);
			if ($_SESSION['logged_in']['role'] == '1') {
				$array['count_dashboard'] = $this->Dashboard_model->count_dashboard();

				$array['ctki_unapprove'] = $this->Dashboard_model->get_data_dashboard('UNAPPROVECTKI');
				$array['perjanjian_notcreated'] = $this->Dashboard_model->get_data_dashboard('NOTCREATEDPERJANJIAN');

				$array['penyalur_unapprove'] = $this->Dashboard_model->get_data_dashboard('UNAPPROVEPENYALUR');
				$array['penyalur_rejected'] = $this->Dashboard_model->get_data_dashboard('REJECTEDPENYALUR');

				$array['count_job'] = $this->Dashboard_model->get_count_job();

				$array['perjanjian_unapprovetab'] = $this->Dashboard_model->get_data_dashboard('UNAPPROVEPERJANJIANTAB');
				$array['perjanjian_rejectedtab'] = $this->Dashboard_model->get_data_dashboard('REJECTEDPERJANJIANTAB');
			} elseif ($_SESSION['logged_in']['role'] == '2') {
				$array['count_dashboard'] = $this->Dashboard_model->count_dashboard();

				$array['kontrak_notcreated'] = $this->Dashboard_model->get_data_dashboard('NOTCREATEDKONTRAK');
				$array['kontrak_rejected'] = $this->Dashboard_model->get_data_dashboard('REJECTEDKONTRAK');

				$array['count_job'] = $this->Dashboard_model->get_count_job();

				$array['pekerjaan_notcreated'] = $this->Dashboard_model->get_data_dashboard('NOTCREATEDPEKERJAAN');
			} elseif ($_SESSION['logged_in']['role'] == '3') {
				$array['count_dashboard'] = $this->Dashboard_model->count_dashboard();

				$array['ctki_unapprove'] = $this->Dashboard_model->get_data_dashboard('NOTAPPROVEDTKI');
				$array['ctki_rejected'] = $this->Dashboard_model->get_data_dashboard('REJECTEDTKI');

				$array['count_job'] = $this->Dashboard_model->get_count_job();

				$array['approve_perjanjian'] = $this->Dashboard_model->get_data_dashboard('APPROVEPERJANJIAN');
				$array['approve_kontrak'] = $this->Dashboard_model->get_data_dashboard('APPROVEKONTRAK');
			} elseif ($_SESSION['logged_in']['role'] == '0') {
				$param = $this->input->post('filter');
				if ($param == '') {
					$array['audit'] = $this->Dashboard_model->get_data_dashboard('AUDIT');
				} else {
					$array['audit'] = $this->Dashboard_model->get_data_dashboard('AUDITPARAM', $param);
				}
				$array['count_dashboard'] = '';
				$array['list_user'] = $this->User_model->get_user();
			}
			$this->load->view('v_dashboard', $array);
			$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}
}