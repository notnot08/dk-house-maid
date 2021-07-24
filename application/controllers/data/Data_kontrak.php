<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_kontrak extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Pekerjaan_model');
		$this->load->model('Kontrak_model');
		$this->load->model('GenerateID_model');
		$this->load->model('Log_model');
		$this->load->model('Upload_model');
		
		if(!isset($_SESSION['logged_in']['username'])){								
			redirect('Login');
		}

		$this->uploadPath = "./assets/uploaded/dokumen";
	}

	public function set_kontrak($id){
		$validate = $this->Log_model->validateAct('25')->num_rows();
		if ($validate > 0) {
			$id_kontrak = $this->GenerateID_model->generateid();

			$data = array(
				'ID' => $id_kontrak,
				'CREATED_BY' => $_SESSION['logged_in']['id_user']);

			$result = $this->Kontrak_model->insert_kontrak($data);
			if ($result == TRUE) {
				$data_log1 = array(
					'JENIS' => '25',
					'CODE' => $id_kontrak,
					'AKSI' => 'CREATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log1);

				$result2 = $this->Pekerjaan_model->update_kontrak_justifikasi($id, $id_kontrak);

				if ($result2 == TRUE) {
					$data_log2 = array(
						'JENIS' => '26',
						'CODE' => $id,
						'AKSI' => 'UPDATE',
						'STATUS' => '1',
						'CHANGE_STATUS' => '',
						'CATATAN' => '',
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log2);
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fas fa-ban"></i> Berhasil membuat kontrak
						</div>');
					redirect('Kontrak/detail/'.$id_kontrak);
				} else {
					$data_log2 = array(
						'JENIS' => '26',
						'CODE' => $id,
						'AKSI' => 'UPDATE',
						'STATUS' => '0',
						'CHANGE_STATUS' => '',
						'CATATAN' => '',
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log2);
					redirect('Pekerjaan/detail/'.$id);
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> Gagal membuat kontrak
					</div>');
				$data_log1 = array(
					'JENIS' => '25',
					'CODE' => $id,
					'AKSI' => 'UPDATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log1);
				redirect('Pekerjaan/detail/'.$id);
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function generate_nomor_kontrak(){

		$validate = $this->Log_model->validateAct('27')->num_rows();
		if ($validate > 0) {
			$id_justifikasi = $this->input->post('id_justifikasi');
			$id_kontrak = $this->input->post('id_kontrak');
			$data = array(
				'ID_PERUSAHAAN' => strtoupper($this->input->post('id_perusahaan')),
				'LAMA_KONTRAK' => $this->input->post('lama_kontrak'),
				'SATUAN_LAMA_KONTRAK' => strtoupper($this->input->post('satuan_lama_kontrak')),
				'TANGGAL_MULAI' => $this->input->post('tanggal_mulai'),
				'TANGGAL_SELESAI' => $this->input->post('tanggal_selesai'),
				'WAKTU_KERJA' => $this->input->post('waktu_kerja'),
				'JAM_PERHARI' => $this->input->post('jam_perhari'),
				'ID_PEKERJAAN' => $this->input->post('id_pekerjaan'),
				'TGL_PEMBERIAN_GAJI' => $this->input->post('tgl_pemberian_gaji'),
				'JUMLAH_GAPOK' => $this->input->post('jumlah_gapok'),
				'TUNJANGAN_KESEHATAN' => $this->input->post('tunjangan_kesehatan'),
				'TUNJANGAN_TRANSPORTASI' => $this->input->post('tunjangan_transportasi'),
				'UANG_KERAJINAN' => $this->input->post('uang_kerajinan'),
				'BIAYA_PENGOBATAN' => $this->input->post('biaya_pengobatan'),
				'CUTI_TAHUNAN' => $this->input->post('cuti_tahunan'),
				'SYARAT_UNDURDIRI' => $this->input->post('syarat_undurdiri'),
				'WAKTU_UNDURDIRI' => $this->input->post('waktu_undurdiri'),
				'TGL_PENGESAHAN' => $this->input->post('tgl_pengesahan'),
				'PIHAK_PERTAMA' => strtoupper($this->input->post('pihak_pertama')),
				'PIHAK_KEDUA' => strtoupper($this->input->post('pihak_kedua')),
				'CREATED_BY' => $_SESSION['logged_in']['id_user']);
			$result = $this->Kontrak_model->generate_nomor_kontrak($id_kontrak, $data);
			if ($this->input->post('jenis_aksi') == 'AJUKAN') {
				$create_event = array(
					'EVENTTYPE' => '10',
					'REF1' => '',
					'REF2' => $id_justifikasi,
					'REF3' => $id_kontrak,
					'USER' => $_SESSION['logged_in']['id_user'],
					'REMARK' => NULL
				);
				$this->Log_model->create_event($create_event);
				$data_approve = array(
					'KONTRAK_KERJA_APPROVAL' => '3');
				$result2 = $this->Kontrak_model->update_approval_kontrak('SUBMIT', $id_kontrak, $data_approve);
				if ($result2 == TRUE) {
					$data_log = array(
						'JENIS' => '33',
						'CODE' => $id_kontrak,
						'AKSI' => 'UPDATE',
						'STATUS' => '1',
						'CHANGE_STATUS' => '',
						'CATATAN' => implode("|",$data),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log);
					$message = "SUKSES SUBMIT KONTRAK KERJA";
				} else {
					$data_log = array(
						'ID_USER' => $_SESSION['logged_in']['id_user'],
						'JENIS' => '33',
						'STATUS' => '0');
					$data_log = array(
						'JENIS' => '33',
						'CODE' => $id_kontrak,
						'AKSI' => 'UPDATE',
						'STATUS' => '0',
						'CHANGE_STATUS' => '',
						'CATATAN' => implode("|",$data),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log);
					$message = "GAGAL SUBMIT KONTRAK KERJA";
				}
			} else {
				$message = "SUKSES MENYIMPAN KONTRAK KERJA";
			}
			if ($result == TRUE) {
				$data_log = array(
					'JENIS' => '27',
					'CODE' => $id_kontrak,
					'AKSI' => 'UPDATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> '.$message.'
					</div>');
				redirect('Pekerjaan/detail/'.$id_justifikasi);
			} else {
				$data_log = array(
					'JENIS' => '27',
					'CODE' => $id_kontrak,
					'AKSI' => 'UPDATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> GAGAL MEMPROSES
					</div>');
				redirect('Pekerjaan/detail/'.$id_justifikasi);
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function approve_kontrak($param, $id_kontrak){
		$validate = $this->Log_model->validateAct('28')->num_rows();
		if ($validate > 0) {
			$array['data_pekerjaan'] = $this->Kontrak_model->get_id_justifikasi($id_kontrak);
			foreach($array['data_pekerjaan']->result() as $row ):
				$id_justifikasi =  $row->ID;
			endforeach;
			if ($param == 'SET1') {
				$change_status = '1';
				$nomor_surat = '/'.$this->GenerateID_model->generatebulantahun();
				$data = array(
					'KONTRAK_KERJA_APPROVAL' => '1',
					'APPROVED_BY_3' => $_SESSION['logged_in']['id_user'],
					'APPROVED_DATE_3' => date('Y-m-d H:i:s'),
					'NOMOR_SURAT' => $nomor_surat);
				$result1 = $this->Kontrak_model->update_approval_kontrak('APPROVE', $id_kontrak, $data);
				$create_event = array(
					'EVENTTYPE' => '11',
					'REF1' => '',
					'REF2' => $id_justifikasi,
					'REF3' => $id_kontrak,
					'USER' => $_SESSION['logged_in']['id_user'],
					'REMARK' => NULL
				);
				$this->Log_model->create_event($create_event);
				$redirect = 'Pekerjaan/detail/'.$id_justifikasi;
			} elseif ($param == 'SET2') {
				$change_status = '2';

				$catatan = $this->input->post('catatan');
				$data = array(
					'KONTRAK_KERJA_APPROVAL' => '2',
					'APPROVED_BY_3' => $_SESSION['logged_in']['id_user'],
					'APPROVED_DATE_3' => date('Y-m-d H:i:s'),
					'CATATAN' => $this->input->post('catatan'));
				$result1 = $this->Kontrak_model->update_approval_kontrak('REJECT', $id_kontrak, $data);
				$create_event = array(
					'EVENTTYPE' => '15',
					'REF1' => '',
					'REF2' => $id_justifikasi,
					'REF3' => $id_kontrak,
					'USER' => $_SESSION['logged_in']['id_user'],
					'REMARK' => $catatan
				);
				$this->Log_model->create_event($create_event);
				$redirect = 'Pekerjaan/detail/'.$id_justifikasi;
			}

			if ($result1 == TRUE) {
				$data_log = array(
					'JENIS' => '28',
					'CODE' => $id_kontrak,
					'AKSI' => 'UPDATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => $change_status,
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Sukses mengupdate surat kontrak kerja
					</div>');
				redirect($redirect);
			} else {
				$data_log = array(
					'JENIS' => '28',
					'CODE' => $id_kontrak,
					'AKSI' => 'UPDATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => $change_status,
					'CATATAN' => implode("|",$data),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log);
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> Gagal mengupdate surat kontrak kerja
					</div>');
				redirect('Pekerjaan/detail/'.$id_justifikasi);
			}
		} else {
			redirect('Error_/er_403');
		}
	}

	public function do_upload_kontrak(){
		$validate = $this->Log_model->validateAct('19')->num_rows();
		if ($validate > 0) {
			$id_doc = $this->GenerateID_model->generateid();
			$id_kontrak = $this->input->post('id_kontrak');
			$id_dokumen = $this->input->post('jenis_dokumen');		

			$config = array(
				'upload_path'  => $this->uploadPath,
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => false,
				'max_size' => "2048000",
				'file_name' => $id_doc
			);
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('file_kontrak')) {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fas fa-check"></i> GAGAL mengupload dokumen kontrak</div>');
				$data_log_file = array(
					'JENIS' => '19',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '1',
					'CHANGE_STATUS' => '',
					'CATATAN' => '',
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log_file);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fas fa-check"></i> BERHASIL mengupload dokumen kontrak</div>');
				$filename = $this->upload->data('file_name');
				$data_file = array(
					'ID' => $id_doc,
					'ID_KONTRAK' => $id_kontrak,
					'ID_JENIS_DOK' => $id_dokumen,
					'PATH' => $this->uploadPath,
					'FILE' => $filename,
					'CREATED_BY' => $_SESSION['logged_in']['id_user']);
				$this->Upload_model->insert_file($data_file);

				$data = array(
					'ID_DOKUMEN' => $id_doc);
				$result = $this->Kontrak_model->generate_nomor_kontrak($id_kontrak, $data);

				$data_log_file = array(
					'JENIS' => '19',
					'CODE' => $id,
					'AKSI' => 'CREATE',
					'STATUS' => '0',
					'CHANGE_STATUS' => '',
					'CATATAN' => implode("|",$data_file),
					'ID_USER' => $_SESSION['logged_in']['id_user']
				);
				$this->Log_model->insert_log($data_log_file);
			}
			redirect('Kontrak/detail/'.$id_kontrak);
		} else {
			redirect('Error_/er_403');
		}
	}
}