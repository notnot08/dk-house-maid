<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('GenerateID_model');
		$this->load->model('Log_model');
		
		if(!isset($_SESSION['logged_in']['username'])){								
			redirect('Login');
		}
	}

	public function insert_user(){
		$validate = $this->Log_model->validateAct('2')->num_rows();
		if ($validate > 0) {
			$id = $this->GenerateID_model->generateid();
			if ($this->input->post('jenis') == '3') {
				$id_group = $this->input->post('id_group');
			} else {
				$id_group = '-';
			}
			$data = array(
				'ID' => $id,
				'USERNAME' => $this->input->post('username'),
				'NAMA' => strtoupper($this->input->post('nama')),
				'JENIS' => $this->input->post('jenis'),
				'ID_GROUP' => $id_group,
				'CREATED_BY' => $_SESSION['logged_in']['id_user']);

			$result = $this->User_model->insert_user($data);
			if ($result == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> User baru berhasil dibuat
					</div>');
				$data_log = array(
					'JENIS' => '2',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/User');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> User baru gagal dibuat
					</div>');
				$data_log = array(
					'JENIS' => '2',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/User');
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function changestatus_user($value, $id){
		$validate = $this->Log_model->validateAct('3')->num_rows();
		if ($validate > 0) {
			$result = $this->User_model->Changestatus_user($value, $id);
			if ($result == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Sukses
					</div>');
				$data_log = array(
					'JENIS' => '3',
					'CODE' => $id,
					'AKSI' => 'UPDATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/User');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> Gagal
					</div>');
				$data_log = array(
					'JENIS' => '3',
					'CODE' => $id,
					'AKSI' => 'UPDATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/User');
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function edit_user(){
		$validate = $this->Log_model->validateAct('6')->num_rows();
		$id_user = $this->input->post('id_user');

		if ($validate > 0) {
			$username = $this->input->post('username');
			$data = array(
				'USERNAME' => $username,
				'NAMA' => strtoupper($this->input->post('nama')),
				'JENIS' => $this->input->post('jenis'),
				'STATUS' => $this->input->post('status'));

			$result = $this->User_model->update_user($id_user, $data);
			if ($result == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> User '.$username.' berhasil diedit
					</div>');
				$data_log = array(
					'JENIS' => '6',
					'CODE' => $id,
					'AKSI' => 'UPDATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/User/detail/'.$id_user);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> User '.$username.' gagal diedit
					</div>');
				$data_log = array(
					'JENIS' => '6',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/User/detail/'.$id_user);
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon fas fa-ban"></i> Gagal, anda bukan admin/superadmin
				</div>');
			redirect('master/User/detail/'.$id_user);
		}
	}

	public function resetPassword($value){
		$validate = $this->Log_model->validateAct('48')->num_rows();
		if ($validate > 0) {
			$result = $this->User_model->resetPassword($value);
			if ($result == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Sukses reset password
					</div>');
				$data_log = array(
					'JENIS' => '48',
					'CODE' => $value,
					'AKSI' => 'UPDATE',
					'STATUS' => '1',
					'CATATAN' => $value,
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/User');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> Gagal reset password
					</div>');
				$data_log = array(
					'JENIS' => '48',
					'CODE' => $value,
					'AKSI' => 'UPDATE',
					'STATUS' => '0',
					'CATATAN' => $value,
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/User');
			}
		} else {
			redirect('Error_/er_403');
		}
	}
}