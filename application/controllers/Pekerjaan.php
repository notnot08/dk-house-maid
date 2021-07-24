<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pekerjaan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Log_model');
		$this->load->model('Pekerjaan_model');
		$this->load->model('Dashboard_model');
		$this->load->model('Tki_model');
		$this->load->model('GenerateID_model');
		
		if(!isset($_SESSION['logged_in']['username'])){								
			redirect('Login');
		}

		$this->load->model('Menu_model');
		$this->menuParent = $this->Menu_model->GetMenuParent();
		$this->menuChild = $this->Menu_model->GetMenuChild();
	}

	public function pengajuan($param = FALSE) {
		$validate = $this->Log_model->validateUrl('13')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Pengajuan Pekerjaan';
		$data['menu'] = 'pekerjaan';
		$data['submenu'] = 'pengajuan';
		$data['submenu2'] = '-';
		$data['isform'] = 'Y';
		if ($param == 'search') {
			$param1 = $this->input->post('param');
			$value = strtoupper($this->input->post('cari'));
			$array['data_result'] = $this->Pekerjaan_model->validate_justifikasi('SEARCH', $param1, $value);
		} else {
			$array['data_result'] = '';
		}
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		$array['data_pekerjaan_available'] = $this->Pekerjaan_model->validate_justifikasi('AVAILABLE');
		$this->load->view('template/v_header', $data);
		$this->load->view('pekerjaan/v_pengajuan_pekerjaan', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function aktif() {
		$validate = $this->Log_model->validateUrl('14')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Pengajuan Pekerjaan';
		$data['menu'] = 'pekerjaan';
		$data['submenu'] = 'aktif';
		$data['submenu2'] = '-';
		$data['isform'] = 'N';
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;

		$array['data_pekerjaan_aktif'] = $this->Pekerjaan_model->get_pekerjaan_aktif();
		$this->load->view('template/v_header', $data);
		$this->load->view('pekerjaan/v_aktif_pekerjaan', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function all() {
		$validate = $this->Log_model->validateUrl('16')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Pengajuan Pekerjaan';
		$data['menu'] = 'pekerjaan';
		$data['submenu'] = 'aktif';
		$data['submenu2'] = '-';
		$data['isform'] = 'N';
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;

		$array['count_job'] = $this->Dashboard_model->get_count_job();

		$array['data_pekerjaan_aktif'] = $this->Pekerjaan_model->get_all_pekerjaan();
		$this->load->view('template/v_header', $data);
		$this->load->view('pekerjaan/v_all_pekerjaan', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function detail($id){
		$validate = $this->Log_model->validateUrl('15')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Detail Pekerjaan';
		$data['menu'] = 'pekerjaan';
		$data['submenu'] = 'pengajuan';
		$data['submenu2'] = '-';
		$data['isform'] = 'N';
		if ($id === FALSE) {
			redirect('Pekerjaan/pengajuan');
		} else {
			$array['data_justifikasi'] = $this->Pekerjaan_model->get_justifikasi($id);
			$array['data_timeline'] = $this->Pekerjaan_model->get_timeline($id);
			$array['data_active_job'] = $this->Pekerjaan_model->get_active_job();
			
			foreach($array['data_justifikasi']->result() as $row ):
			$id_tki =  $row->ID_TKI;
			endforeach;
			$array['data_tki'] = $this->Tki_model->getTkiDetail($id_tki);
		}
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		$this->load->view('template/v_header', $data);
		$this->load->view('pekerjaan/v_detail_pekerjaan', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function tambah($id = FALSE){
		$validate = $this->Log_model->validateUrl('17')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Tambah Pekerjaan';
		$data['menu'] = 'pekerjaan';
		$data['submenu'] = 'pengajuan';
		$data['submenu2'] = '-';
		$data['isform'] = 'Y';
		if ($id === FALSE) {
			redirect('Pekerjaan/pengajuan');
		} else {
			$array['data_active_job'] = $this->Pekerjaan_model->get_active_job();
			$array['data_tki'] = $this->Tki_model->getTkiDetail($id);
			$array['data_tki2'] = $this->Tki_model->getValidateJustifikasi($id);
		}
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		$this->load->view('template/v_header', $data);
		$this->load->view('pekerjaan/v_tambah_pekerjaan', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function assign(){
		$validate = $this->Log_model->validateUrl('18')->num_rows();
		if ($validate > 0) {
		$data['title'] = 'Assign Pekerjaan';
		$data['menu'] = 'pekerjaan';
		$data['submenu'] = 'pengajuan';
		$data['submenu2'] = '-';
		$data['isform'] = 'Y';
		$id_pekerjaan = $this->input->post('id_pekerjaan');
		$array['id_justifikasi'] = $this->input->post('id_justifikasi');
		$array['data_pekerjaan'] = $this->Pekerjaan_model->get_assign_pekerjaan('LISTASSIGN', $id_pekerjaan);
		
		$data['menuParent'] = $this->menuParent;
		$data['menuChild'] = $this->menuChild;
		$this->load->view('template/v_header', $data);
		$this->load->view('pekerjaan/v_assign_pekerjaan', $array);
		$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}
}