<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyalur extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Penyalur_model');
		$this->load->model('Perusahaan_model');
		$this->load->model('Log_model');
		$this->load->model('GenerateID_model');
		
		if(!isset($_SESSION['logged_in']['username'])){								
			redirect('Login');
		}

		$this->load->model('Menu_model');
		$this->menuParent = $this->Menu_model->GetMenuParent();
		$this->menuChild = $this->Menu_model->GetMenuChild();
	}

	public function index(){
		$response = file_get_contents('https://restcountries.eu/rest/v2/all');
		$response = json_encode($response);
		echo $response;
	}

	public function pengajuan() {
		$validate = $this->Log_model->validateUrl('19')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Registrasi Penyalur';
		$data['menu'] = 'penyalur';
		$data['submenu'] = 'pengajuan_penyalur';
		$data['submenu2'] = '-';
		$data['isform'] = 'Y';
		$array['data_perusahaan'] = $this->Perusahaan_model->get_penyalur_group();
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		$this->load->view('template/v_header', $data);
		$this->load->view('penyalur/v_pengajuan_penyalur', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function detail($id = FALSE){
		$validate = $this->Log_model->validateUrl('20')->num_rows();
		if ($validate > 0) {
		if ($id === FALSE) {
			redirect('Penyalur/approve');
		} else {
			$data['title'] = 'Detail Penyalur';
			$data['menu'] = 'penyalur';
			$data['submenu'] = 'approve_penyalur';
			$data['submenu2'] = '-';
			$data['isform'] = 'Y';
			$array['data_penyalur'] = $this->Penyalur_model->get_penyalur_detail($id);
			$array['data_perusahaan'] = $this->Perusahaan_model->get_penyalur_group();
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;
			$this->load->view('template/v_header', $data);
			$this->load->view('penyalur/v_detail_penyalur', $array);
			$this->load->view('template/v_footer');
		}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function approve() {
		$validate = $this->Log_model->validateUrl('21')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Approve Penyalur';
		$data['menu'] = 'penyalur';
		$data['submenu'] = 'approve_penyalur';
		$data['submenu2'] = '-';
		$data['isform'] = 'Y';
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		$array['data_penyalur'] = $this->Penyalur_model->get_all_approve();
		$this->load->view('template/v_header', $data);
		$this->load->view('penyalur/v_approve_penyalur', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function all() {
		$validate = $this->Log_model->validateUrl('22')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Manage Penyalur';
		$data['menu'] = 'penyalur';
		$data['submenu'] = 'all_penyalur';
		$data['submenu2'] = '-';
		$data['isform'] = 'Y';
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		$array['data_penyalur'] = $this->Penyalur_model->get_all_penyalur();
		$this->load->view('template/v_header', $data);
		$this->load->view('penyalur/v_all_penyalur', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}
}