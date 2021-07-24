<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perjanjian extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Perjanjian_model');
		$this->load->model('Log_model');
		$this->load->model('Dokumen_model');
		
		if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){								
			redirect('Login');
		}

		$this->load->model('Menu_model');
		$this->menuParent = $this->Menu_model->GetMenuParent();
		$this->menuChild = $this->Menu_model->GetMenuChild();
	}

	public function detail($id) {
		$validate = $this->Log_model->validateUrl('24')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'Surat Perjanjian';
			$data['menu'] = 'perjanjian';
			$data['submenu'] = 'perjanjian';
			$data['submenu2'] = '-';
			$data['isform'] = 'Y';
			$array['data_perjanjian'] = $this->Perjanjian_model->get_perjanjian_detail($id);
			$array['data_doc'] = $this->Dokumen_model->get_doc_non_wajib();
			foreach($array['data_perjanjian']->result() as $row ):
				$data['id_justifikasi'] =  $row->ID_JUSTIFIKASI;
			endforeach;
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;
			$this->load->view('template/v_header', $data);
			$this->load->view('perjanjian/v_detail_perjanjian', $array);
			$this->load->view('perjanjian/v_print_perjanjian', $array);
			$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function print($id) {
		$data['isform'] = 'Y';
		$array['title'] = 'Print Surat Perjanjian';
		$array['data_perjanjian'] = $this->Perjanjian_model->get_perjanjian_detail($id);
		$this->load->view('perjanjian/v_print', $array);
	}

	public function cari($param = FALSE) {
		$validate = $this->Log_model->validateUrl('23')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'Perjanjian';
			$data['menu'] = 'perjanjian';
			$data['submenu'] = 'cari';
			$data['submenu2'] = '-';
			$data['isform'] = 'Y';
			if ($param == 'search') {
				$param1 = $this->input->post('param');
				$value = strtoupper($this->input->post('cari'));
				$array['data_result'] = $this->Perjanjian_model->searchPerjanjian($param1, $value);
			} else {
				$array['data_result'] = '';
			}
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;

			$this->load->view('template/v_header', $data);
			$this->load->view('perjanjian/v_cari_perjanjian', $array);
			$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function all(){
		$validate = $this->Log_model->validateUrl('31')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'Perjanjian';
			$data['menu'] = 'perjanjian';
			$data['submenu'] = 'cari';
			$data['submenu2'] = '-';
			$data['isform'] = 'Y';
			$array['data_result'] = '';
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;
			$array['data_result'] = $this->Perjanjian_model->getAllPerjanjian();
			$this->load->view('template/v_header', $data);
			$this->load->view('perjanjian/v_all_perjanjian', $array);
			$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}	
	}
}