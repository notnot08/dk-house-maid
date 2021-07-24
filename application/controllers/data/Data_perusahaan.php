<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_perusahaan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Log_model');
		$this->load->model('Perusahaan_model');
		$this->load->model('GenerateID_model');
		
		if(!isset($_SESSION['logged_in']['username'])){								
			redirect('Login');
		}
	}

	public function insert_com(){
		$validate = $this->Log_model->validateAct('38')->num_rows();

		if ($validate > 0) {
			$id = $this->GenerateID_model->generateid();
			$nama_perusahaan = strtoupper($this->input->post('nama_perusahaan'));
			$npwp = $this->input->post('npwp_perusahaan');

			if ($npwp == '') {
				$npwp = NULL;
			}

			$data = array(
				'ID' => $id,
				'NAMA_PERUSAHAAN' => $nama_perusahaan,
				'NPWP' => $npwp,
				'ALAMAT' => strtoupper($this->input->post('alamat_perusahaan')),
				'NO_TELP' => strtoupper($this->input->post('no_telp_perusahaan')),
				'EMAIL' => strtolower($this->input->post('email_perusahaan')),
				'CREATED_BY' => $_SESSION['logged_in']['id_user']);

			$result = $this->Perusahaan_model->insert_com($data);
			if ($result == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
	          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	          <i class="icon fas fa-check"></i> Perusahaan '.$nama_perusahaan.' berhasil dibuat
	        </div>');
			$data_log = array(
					'JENIS' => '38',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
			$this->Log_model->insert_log($data_log);
				redirect('master/Perusahaan');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
	          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	          <i class="icon fas fa-ban"></i> Perusahaan '.$nama_perusahaan.' gagal dibuat
	        </div>');
				$data_log = array(
					'JENIS' => '38',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
			$this->Log_model->insert_log($data_log);
				redirect('master/Perusahaan');
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function procgenerateGroupPenyalur($id){
		$validate = $this->Log_model->validateAct('42')->num_rows();
		if ($validate > 0) {
			$result = $this->Perusahaan_model->procgenerateGroupPenyalur($id);
			if ($result == TRUE) {
				$data_log = array(
					'JENIS' => '42',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Sukses generate group penyalur
					</div>');
			} else {
				$data_log = array(
					'JENIS' => '42',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Gagal generate group penyalur
					</div>');
			}
			redirect('master/Perusahaan');
		} else {
			redirect('Error_/er_403');
		}
	}
	
}