<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_konten extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Konten_model');
		$this->load->model('GenerateID_model');
		$this->load->model('Log_model');
		
		if(!isset($_SESSION['logged_in']['username'])){								
			redirect('Login');
		}
	}

	public function edit_konten($id){
		$validate = $this->Log_model->validateAct('43')->num_rows();
		if ($validate > 0) {
			/*$paragraph = $this->input->post('paragraph');
			echo $nama_dokumen;*/
			$data = array(
				'JUDUL' => ucwords($this->input->post('judul')),
				'DESKRIPSI' => $this->input->post('paragraph')
			);
			$result = $this->Konten_model->editKonten($id, $data);
			if ($result == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Konten berhasil diedit
					</div>');
				$data_log = array(
					'JENIS' => '43',
					'CODE' => $id,
					'AKSI' => 'UPDATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/Konten/detail/'.$id);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Konten gagal diedit
					</div>');
				$data_log = array(
					'JENIS' => '43',
					'CODE' => $id,
					'AKSI' => 'UPDATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/Konten/detail/'.$id);
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function add_konten(){
		$validate = $this->Log_model->validateAct('45')->num_rows();
		if ($validate > 0) {
			$id = $this->GenerateID_model->generateid();
			$data = array(
				"ID" => $id,
				'JUDUL' => ucwords($this->input->post('judul')),
				'JENIS_KONTEN' => $this->input->post('jenis'),
				'DESKRIPSI' => $this->input->post('paragraph'),
				'CREATED_BY' => $_SESSION['logged_in']['id_user']
			);
			$result = $this->Konten_model->addKonten($data);
			if ($result == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Konten berhasil dipublish
					</div>');
				$data_log = array(
					'JENIS' => '45',
					'CODE' => $id,
					'AKSI' => 'INSERT',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/Konten/detail/'.$id);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Konten gagal dipublish
					</div>');
				$data_log = array(
					'JENIS' => '45',
					'CODE' => $id,
					'AKSI' => 'INSERT',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/Konten/');
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function changestatus_konten($value, $id){
		$validate = $this->Log_model->validateAct('44')->num_rows();
		if ($validate > 0) {
			$result = $this->Konten_model->Changestatus_konten($value, $id);
			if ($result == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Sukses
					</div>');
				$data_log = array(
					'JENIS' => '44',
					'CODE' => $id,
					'AKSI' => 'UPDATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/Konten/');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> Gagal
					</div>');
				$data_log = array(
					'JENIS' => '44',
					'CODE' => $id,
					'AKSI' => 'UPDATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/Konten/');
			}
		} else {
			redirect('Error_/er_403');
		}
	}
}