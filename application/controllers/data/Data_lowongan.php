<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_lowongan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Lowongan_model');
		$this->load->model('GenerateID_model');
		$this->load->model('Log_model');
		
		if(!isset($_SESSION['logged_in']['username'])){								
			redirect('Login');
		}
	}

	public function insert_lowongan($param){
		$validate = $this->Log_model->validateAct('39')->num_rows();
		if ($validate > 0) {
			if ($param == 'INSERT') {
				$id = $this->GenerateID_model->generateid();
				$data = array(
					'ID' => $id,
					'JOB' => strtoupper($this->input->post('job')),
					'JENIS_PEKERJAAN' => $this->input->post('jenis_pekerjaan'),
					'DESKRIPSI' => strtoupper($this->input->post('deskripsi')),
					'NEGARA' => strtoupper($this->input->post('negara')),
					'ALAMAT_LOKASI' => strtoupper($this->input->post('alamat')),
					'IS_COMPANY' => strtoupper($this->input->post('jenis_penerima_jasa')),
					'PENERIMA_JASA' => strtoupper($this->input->post('penerima_jasa')),
					'EMAIL_PJ' => $this->input->post('email'),
					'KODE_PJ' => $this->input->post('kode_pj'),
					'JUMLAH_GAPOK' => $this->input->post('jumlah_gapok'),
					'TUNJANGAN_KESEHATAN' => $this->input->post('tunjangan_kesehatan'),
					'TUNJANGAN_TRANSPORTASI' => $this->input->post('tunjangan_transportasi'),
					'UANG_KERAJINAN' => $this->input->post('uang_kerajinan'),
					'BIAYA_PENGOBATAN' => $this->input->post('biaya_pengobatan'),
					'CUTI_TAHUNAN' => $this->input->post('cuti_tahunan'),
					'LAMA_BEKERJA' => $this->input->post('lama_bekerja'),
					'SATUAN_LAMA_BEKERJA' => strtoupper($this->input->post('satuan_lama_bekerja')),
					'WAKTU_KERJA' => $this->input->post('waktu_kerja'),
					'SATUAN_WAKTU_KERJA' => 'HARI',
					'JAM_PERHARI' => $this->input->post('jam_perhari'),
					'SLOT_PEKERJAAN' => $this->input->post('slot'),
					'CREATED_BY' => $_SESSION['logged_in']['id_user']);
				$result = $this->Lowongan_model->insert_lowongan($data);
				if ($result == TRUE) {
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
		          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		          <i class="icon fas fa-check"></i> Lowongan berhasil dibuat
		        </div>');
				$data_log = array(
					'JENIS' => '39',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
					redirect('master/Lowongan');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
		          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		          <i class="icon fas fa-ban"></i> Lowongan gagal dibuat
		        </div>');
				$data_log = array(
					'JENIS' => '39',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
					redirect('master/Lowongan');
				}
			} elseif ($param == 'UPDATE') {
				# code...
			}
		} else {
			redirect('Error_/er_403');
		}
	}
}