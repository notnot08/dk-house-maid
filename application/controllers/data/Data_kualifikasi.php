<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_kualifikasi extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Kualifikasi_model');
		$this->load->model('GenerateID_model');
		$this->load->model('Log_model');
		
		if(!isset($_SESSION['logged_in']['username'])){								
			redirect('Login');
		}
	}

	public function insert_kualifikasi(){
		$validate = $this->Log_model->validateAct('11')->num_rows();
		if ($validate > 0) {
			$id = $this->GenerateID_model->generateid();
			$pertanyaan = strtoupper($this->input->post('pertanyaan'));
			$data = array(
				'ID' => $id,
				'PERTANYAAN' => $pertanyaan,
				'JENIS' => $this->input->post('jenis'),
				'CATATAN' => strtoupper($this->input->post('catatan')),
				'CREATED_BY' => $_SESSION['logged_in']['id_user']);

			$result = $this->Kualifikasi_model->insert_kualifikasi($data);
			if ($result == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
	          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	          <i class="icon fas fa-check"></i> Kualifikasi baru berhasil dibuat
	        </div>');
				$data_log = array(
					'JENIS' => '11',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
			$this->Log_model->insert_log($data_log);
				redirect('master/Kualifikasi');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
	          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	          <i class="icon fas fa-ban"></i> Kualifikasi baru gagal dibuat
	        </div>');
				$data_log = array(
					'JENIS' => '11',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
			$this->Log_model->insert_log($data_log);
				redirect('master/Kualifikasi');
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function changestatus_kualifikasi($value, $id){
		$validate = $this->Log_model->validateAct('12')->num_rows();
		if ($validate > 0) {
			$result = $this->Kualifikasi_model->changestatus_kualifikasi($value, $id);
			if ($result == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
	          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	          <i class="icon fas fa-check"></i> Sukses
	        </div>');
				$data_log = array(
					'JENIS' => '12',
					'CODE' => $id,
					'AKSI' => 'UPDATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
			$this->Log_model->insert_log($data_log);
				redirect('master/Kualifikasi');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
	          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	          <i class="icon fas fa-ban"></i> Gagal
	        </div>');
				$data_log = array(
					'JENIS' => '12',
					'CODE' => $id,
					'AKSI' => 'UPDATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
			$this->Log_model->insert_log($data_log);
				redirect('master/Kualifikasi');
			}
		} else {
			redirect('Error_/er_403');
		}
	}
}