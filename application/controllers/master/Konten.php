<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konten extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Konten_model');
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

	public function index()	{
		$validate = $this->Log_model->validateUrl('32')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'Master Konten';
			$data['menu'] = 'masterdata';
			$data['submenu'] = 'konten';
			$data['submenu2'] = '-';
			$data['isform'] = 'Y';
			$array['data_result'] = $this->Konten_model->getKonten();
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;
			$this->load->view('template/v_header', $data);
			$this->load->view('master/konten/v_dashboard', $array);
			$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function detail($id) {
		$validate = $this->Log_model->validateUrl('33')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'Master Konten';
			$data['menu'] = 'masterdata';
			$data['submenu'] = 'konten';
			$data['submenu2'] = '-';
			$data['isform'] = 'Y';
			$array['data_result'] = $this->Konten_model->getDetailKonten($id);
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;
			$this->load->view('template/v_header', $data);
			$this->load->view('master/konten/v_detail', $array);
			$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}

	public function add($jenis){
		$validate = $this->Log_model->validateUrl('37')->num_rows();
		if ($validate > 0) {
			$data['title'] = 'Master Konten';
			$data['menu'] = 'masterdata';
			$data['submenu'] = 'konten';
			$data['submenu2'] = '-';
			$data['isform'] = 'Y';
			if ($jenis == '1') {
				$jenis_detail = 'Pengumuman';
			} elseif ($jenis == '2') {
				$jenis_detail = 'Karir';
			} elseif ($jenis == '3') {
				$jenis_detail = 'Berita';
			}
			$array['jenis'] = $jenis;
			$array['jenis_detail'] = $jenis_detail;
			$data['menuParent'] = $this->menuParent;
			$data['menuChild'] = $this->menuChild;
			$this->load->view('template/v_header', $data);
			$this->load->view('master/konten/v_add_konten', $array);
			$this->load->view('template/v_footer');
		} else {
			redirect('Error_/er_403');
		}
	}
}