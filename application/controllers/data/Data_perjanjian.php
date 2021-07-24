<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_perjanjian extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Pekerjaan_model');
		$this->load->model('Perjanjian_model');
		$this->load->model('GenerateID_model');
		$this->load->model('Log_model');
		$this->load->model('Upload_model');
		
		if(!isset($_SESSION['logged_in']['username'])){								
			redirect('Login');
		}
	}

	public function set_perjanjian($id, $id_tki){
		$validate = $this->Log_model->validateAct('22')->num_rows();
		if ($validate > 0) {
			$id_perjanjian = $this->GenerateID_model->generateid();

			$data = array(
				'ID' => $id_perjanjian,
				'ID_TKI' => $id_tki,
				'CREATED_BY' => $_SESSION['logged_in']['id_user']);

			$result = $this->Perjanjian_model->insert_perjanjian($data);
			if ($result == TRUE) {
				$data_log1 = array(
					'JENIS' => '21',
					'CODE' => $id_perjanjian,
					'AKSI' => 'CREATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log1);

				$result2 = $this->Pekerjaan_model->update_perjanjian_justifikasi($id, $id_perjanjian);

				if ($result2 == TRUE) {
					$data_log2 = array(
						'JENIS' => '22',
						'CODE' => $id_perjanjian,
						'AKSI' => 'UPDATE',
						'STATUS' => '1',
						'CHANGE_STATUS' => '',
						'CATATAN' => implode("|",$data),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log2);
					redirect('Perjanjian/detail/'.$id_perjanjian);
				} else {
					$data_log2 = array(
						'JENIS' => '22',
						'CODE' => $id_perjanjian,
						'AKSI' => 'UPDATE',
						'STATUS' => '0',
						'CHANGE_STATUS' => '',
						'CATATAN' => implode("|",$data),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log2);
					redirect('Pekerjaan/detail/'.$id);
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> Gagal membuat surat perjajian
					</div>');
				$data_log1 = array(
					'JENIS' => '21',
					'CODE' => $id_perjanjian,
					'AKSI' => 'CREATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log1);
				redirect('Pekerjaan/detail/'.$id);
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function generate_nomor_perjanjian(){
		$validate = $this->Log_model->validateAct('23')->num_rows();
		if ($validate > 0) {
			$id_justifikasi = $this->input->post('id_justifikasi');
			$id_perjanjian = $this->input->post('id_perjanjian');
			$data = array(
				'NAMA_PJ' => strtoupper($this->input->post('nama_pj')),
				'NIK_PJ' => strtoupper($this->input->post('nik_pj')),
				'JABATAN_PJ' => strtoupper($this->input->post('jabatan_pj')),
				'ALAMAT_PJ' => strtoupper($this->input->post('alamat_pj')),
				'NOMOR_SK' => strtoupper($this->input->post('nomor_sk')),
				'TANGGAL_SK' => strtoupper($this->input->post('tanggal_sk')),
				'NEGARA_TUJUAN' => strtoupper($this->input->post('negara_tujuan')),
				'ALAMAT' => strtoupper($this->input->post('alamat_tki')),
				'TANGGAL_PENGESAHAN' => $this->input->post('tanggal_perjanjian'),
				'CREATED_BY' => $_SESSION['logged_in']['id_user']);

			$result = $this->Perjanjian_model->generate_nomor_perjanjian($id_perjanjian, $data);
			if ($this->input->post('jenis_aksi') == 'AJUKAN') {
				$create_event = array(
					'EVENTTYPE' => '8',
					'REF1' => '',
					'REF2' => $id_justifikasi,
					'REF3' => $id_perjanjian,
					'USER' => $_SESSION['logged_in']['id_user'],
					'REMARK' => NULL
				);
				$this->Log_model->create_event($create_event);
				$data_approve = array(
					'SURAT_PERJANJIAN_APPROVAL' => '3');
				$result2 = $this->Perjanjian_model->update_approval_perjanjian('SUBMIT', $id_perjanjian, $data_approve);
				if ($result2 == TRUE) {
					$data_log = array(
						'JENIS' => '34',
						'CODE' => $id,
						'AKSI' => 'UPDATE',
						'STATUS' => '1',
						'CHANGE_STATUS' => '',
						'CATATAN' => implode("|",$data),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log);
					$message = "SUKSES SUBMIT PERJANJIAN KERJA";
				} else {
					$data_log = array(
						'JENIS' => '34',
						'CODE' => $id,
						'AKSI' => 'UPDATE',
						'STATUS' => '0',
						'CHANGE_STATUS' => '',
						'CATATAN' => implode("|",$data),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log);
					$message = "GAGAL SUBMIT PERJANJIAN KERJA";
				}
			} else {
				$message = "SUKSES MENYIMPAN PERJANJIAN KERJA";
			}
			if ($result == TRUE) {
				$data_log = array(
					'JENIS' => '23',
					'CODE' => $id_perjanjian,
					'AKSI' => 'UPDATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Sukses mengupdate surat perjajian
					</div>');
				redirect('Pekerjaan/detail/'.$id_justifikasi);
			} else {
				$data_log = array(
					'JENIS' => '23',
					'CODE' => $id_perjanjian,
					'AKSI' => 'UPDATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> Gagal mengupdate surat perjajian
					</div>');
				redirect('Pekerjaan/detail/'.$id_justifikasi);
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function approve_perjanjian($param, $id_perjanjian){
		$validate = $this->Log_model->validateAct('24')->num_rows();
		if ($validate > 0) {
			$array['data_pekerjaan'] = $this->Perjanjian_model->get_id_justifikasi($id_perjanjian);
			foreach($array['data_pekerjaan']->result() as $row ):
				$id_justifikasi =  $row->ID;
			endforeach;
			if ($param == 'SET1') {
				$change_status = '1';
				$nomor_surat = '/'.$this->GenerateID_model->generatebulantahun();
				$data = array(
					'SURAT_PERJANJIAN_APPROVAL' => '1',
					'APPROVED_BY_2' => $_SESSION['logged_in']['id_user'],
					'APPROVED_DATE_2' => date('Y-m-d H:i:s'),
					'NOMOR_SURAT' => $nomor_surat);
				$result1 = $this->Perjanjian_model->update_approval_perjanjian('APPROVE', $id_perjanjian, $data);
				$create_event = array(
					'EVENTTYPE' => '9',
					'REF1' => '',
					'REF2' => $id_justifikasi,
					'REF3' => $id_perjanjian,
					'USER' => $_SESSION['logged_in']['id_user'],
					'REMARK' => NULL
				);
				$this->Log_model->create_event($create_event);
				$redirect = 'Perjanjian/print/'.$id_perjanjian;
			} elseif ($param == 'SET2') {
				$catatan = $this->input->post('catatan');
				$data = array(
					'SURAT_PERJANJIAN_APPROVAL' => '2',
					'APPROVED_BY_2' => $_SESSION['logged_in']['id_user'],
					'APPROVED_DATE_2' => date('Y-m-d H:i:s'),
					'CATATAN' => $this->input->post('catatan'));
				$result1 = $this->Perjanjian_model->update_approval_perjanjian('REJECT', $id_perjanjian, $data);
				$change_status = '2';
				$create_event = array(
					'EVENTTYPE' => '14',
					'REF1' => '',
					'REF2' => $id_justifikasi,
					'REF3' => $id_perjanjian,
					'USER' => $_SESSION['logged_in']['id_user'],
					'REMARK' => $catatan
				);
				$this->Log_model->create_event($create_event);
				$redirect = 'Pekerjaan/detail/'.$id_justifikasi;
			}

			if ($result1 == TRUE) {
				$data_log = array(
					'JENIS' => '24',
					'CODE' => $id_perjanjian,
					'AKSI' => 'UPDATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => $change_status,
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Sukses mengupdate surat perjajian
					</div>');
				redirect($redirect);
			} else {
				$data_log = array(
					'JENIS' => '24',
					'CODE' => $id_perjanjian,
					'AKSI' => 'UPDATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => $change_status,
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> Gagal mengupdate surat perjajian
					</div>');
				redirect('Pekerjaan/detail/'.$id_justifikasi);
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function do_upload_perjanjian(){
		$validate = $this->Log_model->validateAct('19')->num_rows();
		if ($validate > 0) {
			$id_doc = $this->GenerateID_model->generateid();
			$id_perjanjian = $this->input->post('id_perjanjian');
			$id_dokumen = $this->input->post('jenis_dokumen');		

			$config = array(
				'upload_path'  => "./assets/uploaded",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => false,
				'max_size' => "2048000",
				'file_name' => $id_doc
			);
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('file_perjanjian')) {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fas fa-check"></i> GAGAL mengupload dokumen perjajian kerja</div>');
				$data_log_file = array(
					'JENIS' => '19',
					'CODE' => $id_doc,
					'AKSI' => 'INSERT',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log_file);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fas fa-check"></i> BERHASIL mengupload dokumen perjajian kerja</div>');
				$filename = $this->upload->data('file_name');
				$data_file = array(
					'ID' => $id_doc,
					'ID_PERJANJIAN' => $id_perjanjian,
					'ID_JENIS_DOK' => $id_dokumen,
					'FILE' => $filename,
					'CREATED_BY' => $_SESSION['logged_in']['id_user']);
				$this->Upload_model->insert_file($data_file);

				$data = array(
					'ID_DOKUMEN' => $id_doc);
				$result = $this->Perjanjian_model->generate_nomor_perjanjian($id_perjanjian, $data);

			// echo "berhasil";
				$data_log_file = array(
					'JENIS' => '19',
					'CODE' => $id_doc,
					'AKSI' => 'CREATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data_file),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log_file);
			}
			redirect('Perjanjian/detail/'.$id_perjanjian);
		} else {
			redirect('Error_/er_403');
		}
	}
}