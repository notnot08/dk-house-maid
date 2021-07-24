<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_dokumen extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Dokumen_model');
		$this->load->model('GenerateID_model');
		$this->load->model('Log_model');
		
		if(!isset($_SESSION['logged_in']['username'])){								
			redirect('Login');
		}
	}

	public function insert_doc_type(){
		$validate = $this->Log_model->validateAct('7')->num_rows();
		if ($validate > 0) {
			$id = $this->GenerateID_model->generateid();
			$nama_dokumen = strtoupper($this->input->post('nama_dokumen'));
			if ($this->input->post('jenis') == '0') {
				$tipe = NULL;
			} else {
				$tipe = '1';
			}

			$data = array(
				'ID' => $id,
				'NAMA_DOKUMEN' => $nama_dokumen,
				'ALIAS' => strtoupper($this->input->post('alias')),
				'JENIS' => $tipe,
				'CREATED_BY' => $_SESSION['logged_in']['id_user']);

			$result = $this->Dokumen_model->insert_doc_type($data);
			if ($result == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
	          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	          <i class="icon fas fa-check"></i> Jenis Dokumen baru berhasil dibuat
	        </div>');
				$data_log = array(
					'JENIS' => '7',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
			$this->Log_model->insert_log($data_log);
				redirect('master/Dokumen');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
	          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	          <i class="icon fas fa-ban"></i> Jenis Dokumen baru gagal dibuat
	        </div>');
				$data_log = array(
					'JENIS' => '7',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
			$this->Log_model->insert_log($data_log);
				redirect('master/Dokumen');
			}
		} else {
			redirect('Error_/er_403');
		}
	}
}