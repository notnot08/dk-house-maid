<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_penyalur extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Penyalur_model');
		$this->load->model('GenerateID_model');
		$this->load->model('Log_model');
		
		if(!isset($_SESSION['logged_in']['username'])){								
			redirect('Login');
		}
	}

	public function insert_penyalur($param){
		$validate = $this->Log_model->validateAct('29')->num_rows();
		if ($validate > 0) {
			if ($param == 'INSERT') {
				$id = $this->GenerateID_model->generateid();
				if ($this->input->post('id_group') != 'ERROR') {
					$data = array(
						'ID' => $id,
						'NAMA' => strtoupper($this->input->post('nama')),
						'NIK' => strtoupper($this->input->post('nik')),
						'NPWP' => strtoupper($this->input->post('npwp')),
						'ALAMAT' => strtoupper($this->input->post('alamat')),
						'TEMPAT_LAHIR' => strtoupper($this->input->post('tempat_lahir')),
						'TANGGAL_LAHIR' => $this->input->post('tanggal_lahir'),
						'ID_GROUP' => $this->input->post('id_group'),
						'CREATED_BY' => $_SESSION['logged_in']['id_user']);

					$result = $this->Penyalur_model->insert_penyalur('INSERT', $data);
					if ($result == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<i class="icon fas fa-check"></i> Pengajuan penyalur berhasil dibuat</div>');
						$data_log = array(
							'JENIS' => '29',
							'CODE' => $id,
							'AKSI' => 'CREATE',
							'STATUS' => '1',
							'CHANGE_STATUS' => '',
							'CATATAN' => implode("|",$data),
							'ID_USER' => $_SESSION['logged_in']['id_user']
						);
						$this->Log_model->insert_log($data_log);
						redirect('Penyalur/pengajuan');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<i class="icon fas fa-ban"></i> Pengajuan penyalur gagal
							</div>');
						$data_log = array(
							'JENIS' => '29',
							'CODE' => $id,
							'AKSI' => 'CREATE',
							'STATUS' => '0',
							'CHANGE_STATUS' => '',
							'CATATAN' => implode("|",$data),
							'ID_USER' => $_SESSION['logged_in']['id_user']
						);
						$this->Log_model->insert_log($data_log);
						redirect('Penyalur/pengajuan');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fas fa-ban"></i> Pilih perusahaan yang benar!
						</div>');
					redirect('Penyalur/pengajuan');
				}
			} elseif ($param == 'UPDATE') {
				if ($this->input->post('id_group') != 'ERROR') {
					$id_penyalur = $this->input->post('id_penyalur');
					$data = array(
						'NAMA' => strtoupper($this->input->post('nama')),
						'NIK' => strtoupper($this->input->post('nik')),
						'NPWP' => strtoupper($this->input->post('npwp')),
						'ALAMAT' => strtoupper($this->input->post('alamat')),
						'TEMPAT_LAHIR' => strtoupper($this->input->post('tempat_lahir')),
						'TANGGAL_LAHIR' => $this->input->post('tanggal_lahir'),
						'ID_GROUP' => $this->input->post('id_group'),
						'APPROVE' => '0',
						'CREATED_BY' => $_SESSION['logged_in']['id_user']);

					$result = $this->Penyalur_model->insert_penyalur('UPDATE', $data, $id_penyalur);
					if ($result == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<i class="icon fas fa-check"></i> Update penyalur berhasil</div>');
						$data_log = array(
							'JENIS' => '29',
							'CODE' => $id_penyalur,
							'AKSI' => 'UPDATE',
							'STATUS' => '1',
							'CHANGE_STATUS' => '',
							'CATATAN' => implode("|",$data),
							'ID_USER' => $_SESSION['logged_in']['id_user']
						);
						$this->Log_model->insert_log($data_log);
						redirect('Penyalur/detail/'.$id_penyalur);
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<i class="icon fas fa-ban"></i> Update penyalur gagal
							</div>');
						$data_log = array(
							'JENIS' => '29',
							'CODE' => $id_penyalur,
							'AKSI' => 'UPDATE',
							'STATUS' => '0',
							'CHANGE_STATUS' => '',
							'CATATAN' => implode("|",$data),
							'ID_USER' => $_SESSION['logged_in']['id_user']
						);
						$this->Log_model->insert_log($data_log);
						redirect('Penyalur/detail/'.$id_penyalur);
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fas fa-ban"></i> Pilih perusahaan yang benar!
						</div>');
					redirect('Penyalur/detail/'.$id_penyalur);
				}
			}
		} else {
			redirect('Error_/er_403');
		}		
	}

	public function approve_penyalur($id, $value){
		$validate = $this->Log_model->validateAct('30')->num_rows();
		if ($validate > 0) {
			$id_user = $this->GenerateID_model->generateid();
			$result = $this->Penyalur_model->approve_penyalur($id, $value);
			if ($value == '1') {
				$string = 'approve'; 
				$penyalur = $this->Penyalur_model->get_name_penyalur($id);
				$row1 = $penyalur->row_array();
				$strings = explode(" ", strtolower($row1['NAMA']));
				if ( ! isset($strings[1])) {
					$strings[1] = null;
				}
				$usernya = $strings[0].$strings[1];
				$result = $this->Penyalur_model->setUserPenyalur('APPROVE', $id, $id_user, $usernya);
			} else {
				$string = 'tolak';
				$data = array(
					'APPROVE' => $value,
					'APPROVED_BY' => $_SESSION['logged_in']['id_user'],
					'APPROVED_DATE' => date('Y-m-d H:i:s'),
					'CATATAN' => strtoupper($this->input->post('alasan')));
				$result = $this->Penyalur_model->setUserPenyalur('REJECT', $id, '', '', $data);
			}

			if ($result == TRUE) {
				$data_log_penyalur = array(
					'JENIS' => '30',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log_penyalur);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Sukses '.$string.' penyalur
					</div>');
			} else {
				$data_log_penyalur = array(
					'JENIS' => '30',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log_penyalur);
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Gagal '.$string.' penyalur
					</div>');
			}
			redirect('Penyalur/approve');
		} else {
			redirect('Error_/er_403');
		}		
	}

	public function procgenerateAccountPenyalur($id){
		$validate = $this->Log_model->validateAct('41')->num_rows();
		if ($validate > 0) {
			$id_user = $this->GenerateID_model->generateid();
			$penyalur = $this->Penyalur_model->get_name_penyalur($id);
			$row1 = $penyalur->row_array();
			$strings = explode(" ", strtolower($row1['NAMA']));
			if ( ! isset($strings[1])) {
				$strings[1] = null;
			}
			$usernya = $strings[0].$strings[1];
			$result = $this->Penyalur_model->setUserPenyalur('APPROVE', $id, $id_user, $usernya);
			if ($result == TRUE) {
				$data_log_penyalur = array(
					'JENIS' => '41',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log_penyalur);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Sukses generate user penyalur
					</div>');
			} else {
				$data_log_penyalur = array(
					'JENIS' => '41',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => $value,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log_penyalur);
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Gagal generate user penyalur
					</div>');
			}
			redirect('Penyalur/all');
		} else {
			redirect('Error_/er_403');
		}
	}
}