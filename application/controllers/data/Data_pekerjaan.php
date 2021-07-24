<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pekerjaan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Pekerjaan_model');
		$this->load->model('GenerateID_model');
		$this->load->model('Log_model');
		
		if(!isset($_SESSION['logged_in']['username'])){								
			redirect('Login');
		}
	}

	public function insert_job(){
		$validate = $this->Log_model->validateAct('8')->num_rows();
		if ($validate > 0) {
			$id = $this->GenerateID_model->generateid();
			$nama_pekerjaan = strtoupper($this->input->post('nama_pekerjaan'));
			$data = array(
				'ID' => $id,
				'PEKERJAAN' => $nama_pekerjaan,
				'CATATAN' => strtoupper($this->input->post('catatan')),
				'CREATED_BY' => $_SESSION['logged_in']['id_user']);

			$result = $this->Pekerjaan_model->insert_job($data);
			if ($result == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Pekerjaan baru berhasil dibuat
					</div>');
				$data_log = array(
					'JENIS' => '8',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/Pekerjaan');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> Pekerjaan baru gagal dibuat
					</div>');
				$data_log = array(
					'JENIS' => '8',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/Pekerjaan');
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function changestatus_pekerjaan($value, $id){
		$validate = $this->Log_model->validateAct('9')->num_rows();
		if ($validate > 0) {
			$result = $this->Pekerjaan_model->changestatus_pekerjaan($value, $id);
			if ($result == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Sukses
					</div>');
				$data_log = array(
					'JENIS' => '9',
					'CODE' => $id,
					'AKSI' => 'UPDATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/Pekerjaan');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> Gagal
					</div>');
				$data_log = array(
					'JENIS' => '9',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('master/Pekerjaan');
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function insert_justifikasi(){
		$validate = $this->Log_model->validateAct('17')->num_rows();
		if ($validate > 0) {
			$id_tki = $this->input->post('id_tki');
			if ($this->input->post('approval') == '1') {
				$id = $this->GenerateID_model->generateid();

				$data = array(
					'ID' => $id,
					'ID_TKI' => $id_tki,
					'ID_PEKERJAAN' => $this->input->post('jenis_pekerjaan'),
					'CATATAN' => strtoupper($this->input->post('catatan')),
					'CREATED_BY' => $_SESSION['logged_in']['id_user']);

				$result = $this->Pekerjaan_model->insert_justifikasi($data);
				$result2 = $this->Pekerjaan_model->setApproveDokTki($id_tki, $id);
				if ($result == TRUE && $result2 == TRUE) {
					$create_event = array(
						'EVENTTYPE' => '6',
						'REF1' => $id_tki,
						'REF2' => $id,
						'REF3' => '',
						'USER' => $_SESSION['logged_in']['id_user'],
						'REMARK' => NULL
					);
					$this->Log_model->create_event($create_event);
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fas fa-check"></i> Pengajuan pekerjaan baru berhasil dibuat
						</div>');
					$data_log = array(
						'JENIS' => '17',
						'CODE' => $id,
						'AKSI' => 'CREATE',
						'STATUS' => '1',
						'CHANGE_STATUS' => '',
						'CATATAN' => implode("|",$data),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log);
					redirect('Pekerjaan/detail/'.$id);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fas fa-ban"></i> Pengajuan pekerjaan baru gagal dibuat
						</div>');
					$data_log = array(
						'JENIS' => '17',
						'CODE' => $id,
						'AKSI' => 'CREATE',
						'STATUS' => '0',
						'CHANGE_STATUS' => '',
						'CATATAN' => implode("|",$data),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log);
					redirect('Pekerjaan/pengajuan');
				}

			} elseif ($this->input->post('jenis_pekerjaan') == 'ERROR') {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> Gagal, silahkan pilih jenis pekerjaan yang benar
					</div>');
				redirect('Pekerjaan/tambah/'.$id_tki);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> Gagal, TKI belum bisa mengajukan
					</div>');
				redirect('Pekerjaan/pengajuan');
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function changestatus_progresspekerjaan($value, $id){
		$validate = $this->Log_model->validateAct('9')->num_rows();
		if ($validate > 0) {
			if ($value == '0') {
				$check_approveable = $this->Pekerjaan_model->check_approveable($id)->num_rows();
				if ($check_approveable > 0) {
					$result = $this->Pekerjaan_model->changestatus_progresspekerjaan($value, $id);
					$message = 'Berhasil di COMPLETE';
					$create_event = array(
						'EVENTTYPE' => '12',
						'REF1' => '',
						'REF2' => $id,
						'REF3' => '',
						'USER' => $_SESSION['logged_in']['id_user'],
						'REMARK' => NULL
					);
					$this->Log_model->create_event($create_event);
					echo $message;
				} else {
					$message = 'Pekerjaan tidak memenuhi syarat untuk di COMPLETE';
					echo $message;
					$create_event = array(
						'EVENTTYPE' => '13',
						'REF1' => '',
						'REF2' => $id,
						'REF3' => '',
						'USER' => $_SESSION['logged_in']['id_user'],
						'REMARK' => NULL
					);
					$this->Log_model->create_event($create_event);
				}
			} elseif ($value == '5') {
				$result = $this->Pekerjaan_model->changestatus_progresspekerjaan($value, $id);
				$message = 'Berhasil di CANCEL';
			} else {
				echo "ERROR";
				return false;
			}

			if ($result == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> SUKSES, '.$message.'</div>');
				$data_log = array(
					'JENIS' => '9',
					'CODE' => $id,
					'AKSI' => 'UPDATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('Pekerjaan/detail/'.$id);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> GAGAL, '.$message.' </div>');
				$data_log = array(
					'JENIS' => '9',
					'CODE' => $id,
					'AKSI' => 'UPDATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('Pekerjaan/detail/'.$id);
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function assign_pekerjaan(){
		$validate = $this->Log_model->validateAct('40')->num_rows();
		if ($validate > 0) {
			$id_justifikasi = $this->input->post('id_justifikasi');
			$id_lowongan = $this->input->post('id_lowongan');
			$result = $this->Pekerjaan_model->update_assign_pekerjaan($id_justifikasi, $id_lowongan);
			if ($result == TRUE) {
				$create_event = array(
					'EVENTTYPE' => '7',
					'REF1' => '',
					'REF2' => $id_justifikasi,
					'REF3' => $id_lowongan,
					'USER' => $_SESSION['logged_in']['id_user'],
					'REMARK' => NULL
				);
				$this->Log_model->create_event($create_event);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> SUKSES, assign pekerjaan</div>');
				$data_log = array(
					'JENIS' => '40',
					'CODE' => $id_justifikasi,
					'AKSI' => 'UPDATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('Pekerjaan/detail/'.$id_justifikasi);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> GAGAL, assign pekerjaan</div>');
				$data_log = array(
					'JENIS' => '40',
					'CODE' => $id_justifikasi,
					'AKSI' => 'UPDATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				redirect('Pekerjaan/detail/'.$id_justifikasi);
			}
		} else {
			redirect('Error_/er_403');
		}
	}
}