<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tki extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Kualifikasi_model');
		$this->load->model('Tki_model');
		$this->load->model('Dokumen_model');
		$this->load->model('Log_model');
		$this->load->model('Dashboard_model');
		
		if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){								
			redirect('Login');
		}

		$this->load->model('Menu_model');
		$this->menuParent = $this->Menu_model->GetMenuParent();
		$this->menuChild = $this->Menu_model->GetMenuChild();
	}

	public function index() {
		$validate = $this->Log_model->validateUrl('2')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'TKI';
			$data['menu'] = 'data_tki';
			$data['submenu'] = 'ctki';
			$data['submenu2'] = 'register_ctki';
			$data['isform'] = 'Y';
			$array['data_kualifikasi'] = $this->Kualifikasi_model->get_active_kualifikasi();
			$array['data_jenis_dok'] = $this->Dokumen_model->get_active_doc_type();
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;
			$this->load->view('template/v_header', $data);
			$this->load->view('tki/v_register_ctki', $array);
			$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function approve() {
		$validate = $this->Log_model->validateUrl('3')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'TKI';
			$data['menu'] = 'data_tki';
			$data['submenu'] = 'ctki';
			$data['submenu2'] = 'approve_tki';
			$data['isform'] = 'N';
			$array['data_tki'] = $this->Tki_model->get_tki_list('UNAPPROVED');
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;
			$this->load->view('template/v_header', $data);
			$this->load->view('tki/v_approve_ctki', $array);
			$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function detail($id = FALSE){
		$validate = $this->Log_model->validateUrl('5')->num_rows();
		if ($validate > 0) {
			if ($id === FALSE) {
			redirect('Tki/approve');
			} else {
				$data['title'] = 'TKI';
				$data['menu'] = 'data_tki';
				$data['submenu'] = 'ctki';
				$data['submenu2'] = 'approve_tki';
				$data['isform'] = 'Y';
				$array['data_tki'] = $this->Tki_model->get_tki_detail('DETAIL_TKI', $id);
				$array['data_alamat'] = $this->Tki_model->get_tki_detail('ALAMAT', $id);
				$array['data_kualifikasi'] = $this->Tki_model->get_tki_kualifikasi($id);
				$array['data_dokumen'] = $this->Tki_model->get_tki_dokumen($id);
				$array['data_timeline'] = $this->Tki_model->get_timeline($id);
				$data['menuParent'] = $this->menuParent;
				$data['menuChild'] = $this->menuChild;
				$this->load->view('template/v_header', $data);
				$this->load->view('tki/v_detail_ctki', $array);
				$this->load->view('template/v_footer');
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function all(){
		$validate = $this->Log_model->validateUrl('4')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'TKI';
			$data['menu'] = 'data_tki';
			$data['submenu'] = 'ctki';
			$data['submenu2'] = 'approve_tki';
			$data['isform'] = 'N';
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;
			$array['count_dashboard'] = $this->Dashboard_model->count_dashboard2();
			$array['data_tki'] = $this->Tki_model->get_tki_list();
			$this->load->view('template/v_header', $data);
			$this->load->view('tki/v_all_ctki', $array);
			$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}		
	}

}