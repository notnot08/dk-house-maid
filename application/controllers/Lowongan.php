<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowongan extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Lowongan_model');
		$this->load->model('Log_model');
		
		if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){								
			redirect('Login');
		}

		$this->load->model('Menu_model');
		$this->menuParent = $this->Menu_model->GetMenuParent();
		$this->menuChild = $this->Menu_model->GetMenuChild();
	}

	public function detail($id) {
		$validate = $this->Log_model->validateUrl('12')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Kontrak';
		$data['menu'] = 'kontrak';
		$data['submenu'] = 'kontrak';
		$data['submenu2'] = '-';
		$data['isform'] = 'Y';
		$array['data_kontrak'] = $this->Kontrak_model->get_kontrak_detail($id);
		$array['data_doc'] = $this->Dokumen_model->get_doc_non_wajib();
		foreach($array['data_kontrak']->result() as $row ):
			$data['id_justifikasi'] =  $row->ID_JUSTIFIKASI;
		endforeach;
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		$this->load->view('template/v_header', $data);
		$this->load->view('kontrak/v_detail_kontrak', $array);
		$this->load->view('kontrak/v_print_kontrak', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function all() {
		$validate = $this->Log_model->validateUrl('9')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Lowongan';
		$data['menu'] = 'lowongan';
		$data['submenu'] = 'all';
		$data['submenu2'] = '-';
		$data['isform'] = 'Y';
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		$array['data_result'] = $this->Lowongan_model->get_lowongan();
		$this->load->view('template/v_header', $data);
		$this->load->view('lowongan/v_all_lowongan', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}		
	}
}