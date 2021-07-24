<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontrak extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Kontrak_model');
		$this->load->model('Dokumen_model');
		$this->load->model('Log_model');
		
		if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){								
			redirect('Login');
		}

		$this->load->model('Menu_model');
		$this->menuParent = $this->Menu_model->GetMenuParent();
		$this->menuChild = $this->Menu_model->GetMenuChild();
	}

	public function detail($id) {
		$validate = $this->Log_model->validateUrl('8')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'Kontrak';
			$data['menu'] = 'kontrak';
			$data['submenu'] = 'kontrak';
			$data['submenu2'] = '-';
			$data['isform'] = 'Y';
			/*$file = $this->Dokumen_model->get_doc_info('KONTRAK', $id);
			$row1 = $file->row_array();*/
			/*$array['path'] = $row1['PATH'];
			$array['file'] = $row1['FILE'];
			$array['id_file'] = $row1['ID'];*/
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

	public function print($id) {
		$data['isform'] = 'Y';
		$array['title'] = 'Print Surat Perjanjian';
		$array['data_kontrak'] = $this->Kontrak_model->get_kontrak_detail($id);
		$this->load->view('kontrak/v_print', $array);
	}

	public function cari($param = FALSE){
		$validate = $this->Log_model->validateUrl('6')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'Kontrak';
			$data['menu'] = 'kontrak';
			$data['submenu'] = 'cari';
			$data['submenu2'] = '-';
			$data['isform'] = 'Y';
			if ($param == 'search') {
				$param1 = $this->input->post('param');
				$value = strtoupper($this->input->post('cari'));
				$array['data_result'] = $this->Kontrak_model->searchKontrak($param1, $value);
			} else {
				$array['data_result'] = '';
			}
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;

			$this->load->view('template/v_header', $data);
			$this->load->view('kontrak/v_cari_kontrak', $array);
			$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function all(){
		$validate = $this->Log_model->validateUrl('7')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'Kontrak';
			$data['menu'] = 'kontrak';
			$data['submenu'] = 'cari';
			$data['submenu2'] = '-';
			$data['isform'] = 'Y';
			$array['data_result'] = '';
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;
			$array['data_result'] = $this->Kontrak_model->getAllKontrak();
			$this->load->view('template/v_header', $data);
			$this->load->view('kontrak/v_all_kontrak', $array);
			$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}	
	}
}