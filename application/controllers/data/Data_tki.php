<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_tki extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('tki/InsertUpdate_model');
		$this->load->model('tki/Approve_model');

		$this->load->model('GenerateID_model');
		$this->load->model('Log_model');
		$this->load->model('Upload_model');
		
		if(!isset($_SESSION['logged_in']['username'])){								
			redirect('Login');
		}

		$this->uploadPath = "./assets/uploaded/tki";
	}

	public function insert_tki($param){
		if ($param == 'INSERT') {
			$validate = $this->Log_model->validateAct('14')->num_rows();
			if ($validate > 0) {
				$id_tki = $this->GenerateID_model->generateid();

				$dataTki = array(
					'ID' => $id_tki,
					'NAMA' => strtoupper($this->input->post('nama')),
					'NIK' => strtoupper($this->input->post('nik')),
					'JENIS_KELAMIN' => strtoupper($this->input->post('jenis_kelamin')),
					'PASSPORT' => strtoupper($this->input->post('passport')),
					'TEMPAT_LAHIR' => strtoupper($this->input->post('tempat_lahir')),
					'TANGGAL_LAHIR' => $this->input->post('tanggal_lahir'),
					'KEWARGANEGARAAN' => $this->input->post('kewarganegaraan'),
					'NEGARA_ASAL' => strtoupper($this->input->post('negara_asal')),
					'AGAMA' => $this->input->post('agama'),
					'PENDIDIKAN_TERAKHIR' => $this->input->post('pendidikan_terakhir'),
					'TINGGI_BADAN' => $this->input->post('tinggi_badan'),
					'BERAT_BADAN' => $this->input->post('berat_badan'),
					'JML_SAUDARA' => $this->input->post('jml_saudara'),
					'ANAK_KE' => $this->input->post('anak_ke'),
					'STATUS_NIKAH' => $this->input->post('status_nikah'),
					'JML_ANAK' => $this->input->post('jml_anak'),
					'ID_GROUP' => $_SESSION['logged_in']['group'],
					'CREATED_BY' => $_SESSION['logged_in']['id_user']);

				$id_alamat = $this->GenerateID_model->generateid();
				$dataAlamat = array(
					'ID' => $id_alamat,
					'ID_TKI' => $id_tki,
					'JENIS_ALAMAT' => strtoupper($this->input->post('jenis_alamat')),
					'JALAN' => strtoupper($this->input->post('alamat')),
					'RT' => $this->input->post('RT'),
					'RW' => $this->input->post('RW'),
					'KECAMATAN' => strtoupper($this->input->post('kecamatan')),
					'KELURAHAN' => strtoupper($this->input->post('kelurahan')),
					'KOTA' => strtoupper($this->input->post('kota')),
					'KD_POS' => $this->input->post('kd_pos'),
					'PROVINSI' => strtoupper($this->input->post('provinsi')),
					'DESA' => strtoupper($this->input->post('desa')),
					'CREATED_BY' => $_SESSION['logged_in']['id_user']);

				$result = $this->InsertUpdate_model->register_ctki('INSERT', $dataTki, $dataAlamat);

				if ($result == TRUE) {
					$status_sukses_data = 'Sukses';
					$data_log_insert_tki = array(
						'JENIS' => '14',
						'CODE' => $id_tki,
						'AKSI' => 'CREATE',
						'STATUS' => '1',
						'CATATAN' => implode("|",$data_diri),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log_insert_tki);

					$status_sukses_alamat = 'Sukses';
					$data_log_alamat = array(
						'JENIS' => '16',
						'CODE' => $id_alamat,
						'AKSI' => 'CREATE',
						'STATUS' => '1',
						'CATATAN' => implode("|",$data_alamat),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log_alamat);

					$create_event = array(
						'EVENTTYPE' => '1',
						'REF1' => $id_tki,
						'REF2' => '',
						'REF3' => '',
						'USER' => $_SESSION['logged_in']['id_user'],
						'REMARK' => NULL
					);
					$this->Log_model->create_event($create_event);

					$jumlah_kualifikasi = $this->input->post('count_kualifikasi');
					$array_kualifikasi = explode(",", $this->input->post('id_kualifikasi'));

					for ($i=0; $i < $jumlah_kualifikasi; $i++) { 
						$id_kualifikasi = $array_kualifikasi[$i];
						$data_kualifikasi = array(
							'ID' => $this->GenerateID_model->generateid(),
							'ID_TKI' => $id_tki,
							'ID_KUALIFIKASI' => $id_kualifikasi,
							'JAWABAN' => $this->input->post('jawaban'.$id_kualifikasi),
							'KETERANGAN' => strtoupper($this->input->post('keterangan'.$id_kualifikasi)),
							'CREATED_BY' => $_SESSION['logged_in']['id_user']);
						$result1 = $this->InsertUpdate_model->register_kualifikasi('INSERT', $data_kualifikasi);
						if ($result1 == TRUE) {
							$status_sukses_kualifikasi = 'SUKSES';
							$data_log_kualifikasi = array(
								'JENIS' => '15',
								'CODE' => $id_kualifikasi,
								'AKSI' => 'CREATE',
								'STATUS' => '1',
								'CATATAN' => implode("|",$data_kualifikasi),
								'ID_USER' => $_SESSION['logged_in']['id_user']
							);
							$this->Log_model->insert_log($data_log_kualifikasi);
						} else {
							$status_sukses_kualifikasi = 'GAGAL';
							$data_log_kualifikasi = array(
								'JENIS' => '15',
								'CODE' => '',
								'AKSI' => 'CREATE',
								'STATUS' => '0',
								'CATATAN' => implode("|",$data_kualifikasi),
								'ID_USER' => $_SESSION['logged_in']['id_user']
							);
							$this->Log_model->insert_log($data_log_kualifikasi);
						}
					}

					$jumlah_dokumen = $this->input->post('count_jenis_dok');
					$array_dokumen = explode(",", $this->input->post('id_jenis_dok'));

					for ($j=0; $j < $jumlah_dokumen; $j++) {
						$id_doc = $this->GenerateID_model->generateid();
						$id_dokumen = $array_dokumen[$j];
						$config = array(
							'upload_path'     => $this->uploadPath,
							'allowed_types' => "gif|jpg|png|jpeg|pdf",
							'overwrite' => false,
							'max_size' => "2048000",
							'file_name' => $id_doc
						);
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('file'.$id_dokumen)) {
							$status_sukses_file = 'GAGAL';

							$data_log_file = array(
								'JENIS' => '18',
								'CODE' => $id_doc,
								'AKSI' => 'CREATE',
								'STATUS' => '0',
								'CATATAN' => '',
								'ID_USER' => $_SESSION['logged_in']['id_user']
							);
							$this->Log_model->insert_log($data_log_file);
						} else {
							$status_sukses_file = 'SUKSES';
							$filename = $this->upload->data('file_name');
							$data_file = array(
								'ID' => $id_doc,
								'ID_TKI' => $id_tki,
								'ID_JENIS_DOK' => $id_dokumen,
								'PATH' => $this->uploadPath,
								'FILE' => $filename,
								'CREATED_BY' => $_SESSION['logged_in']['id_user']);
							$this->Upload_model->insert_file($data_file);

							$data_log_file = array(
								'JENIS' => '18',
								'CODE' => $id_doc,
								'AKSI' => 'CREATE',
								'STATUS' => '1',
								'CATATAN' => implode("|",$data_file),
								'ID_USER' => $_SESSION['logged_in']['id_user']
							);
							$this->Log_model->insert_log($data_log_file);
						}
					}

					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fas fa-check"></i> Sukses Meregister CTKI</div>');
					redirect('Tki/detail/'.$id_tki);
				} else {
					$data_log = array(
						'JENIS' => '14',
						'CODE' => '',
						'AKSI' => 'CREATE',
						'STATUS' => '0',
						'CATATAN' => '',
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log);

					$data_log_alamat = array(
						'JENIS' => '16',
						'CODE' => $id_alamat,
						'AKSI' => 'CREATE',
						'STATUS' => '0',
						'CATATAN' => implode("|",$data_alamat),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log_alamat);
					$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fas fa-check"></i> Gagal meregister calon TKI
						</div>');
					redirect('Tki/');
				}
			} else {
				redirect('Error_/er_403');
			}
		} elseif($param == 'UPDATE') {
			$validate = $this->Log_model->validateAct('35')->num_rows();
			if ($validate > 0) {
				$id_tki_update = $this->input->post('id_tki');
				$data = array(
					'ID_TKI' => $id_tki_update,
					'STATUS' => '1');
				$validate = $this->InsertUpdate_model->checkAvailability($data)->num_rows();
				if ($validate < 1) {
					$dataTki = array(
						'NAMA' => strtoupper($this->input->post('nama')),
						'NIK' => strtoupper($this->input->post('nik')),
						'JENIS_KELAMIN' => strtoupper($this->input->post('jenis_kelamin')),
						'PASSPORT' => strtoupper($this->input->post('passport')),
						'TEMPAT_LAHIR' => strtoupper($this->input->post('tempat_lahir')),
						'TANGGAL_LAHIR' => $this->input->post('tanggal_lahir'),
						'KEWARGANEGARAAN' => $this->input->post('kewarganegaraan'),
						'NEGARA_ASAL' => strtoupper($this->input->post('negara_asal')),
						'AGAMA' => $this->input->post('agama'),
						'PENDIDIKAN_TERAKHIR' => $this->input->post('pendidikan_terakhir'),
						'TINGGI_BADAN' => $this->input->post('tinggi_badan'),
						'BERAT_BADAN' => $this->input->post('berat_badan'),
						'JML_SAUDARA' => $this->input->post('jml_saudara'),
						'ANAK_KE' => $this->input->post('anak_ke'),
						'STATUS_NIKAH' => $this->input->post('status_nikah'),
						'JML_ANAK' => $this->input->post('jml_anak'),
						'ID_GROUP' => $_SESSION['logged_in']['group'],
						'CREATED_BY' => $_SESSION['logged_in']['id_user']);

					$id_alamat_update = $this->input->post('id_alamat');
					$dataAlamat = array(
						'JENIS_ALAMAT' => strtoupper($this->input->post('jenis_alamat')),
						'JALAN' => strtoupper($this->input->post('alamat')),
						'RT' => $this->input->post('rt'),
						'RW' => $this->input->post('rw'),
						'KECAMATAN' => strtoupper($this->input->post('kecamatan')),
						'KELURAHAN' => strtoupper($this->input->post('kelurahan')),
						'KOTA' => strtoupper($this->input->post('kota')),
						'KD_POS' => $this->input->post('kd_pos'),
						'PROVINSI' => strtoupper($this->input->post('provinsi')),
						'DESA' => strtoupper($this->input->post('desa')),
						'CREATED_BY' => $_SESSION['logged_in']['id_user']);
					$id_data = array(
						'ID_TKI' => $id_tki_update,
						'ALAMAT_ID' =>$id_alamat_update);

					$result = $this->InsertUpdate_model->register_ctki('UPDATE', $dataTki, $dataAlamat, $id_data);

					if ($result == TRUE) {
						$data_log_insert_tki = array(
							'JENIS' => '35',
							'CODE' => $id_tki_update,
							'AKSI' => 'UPDATE',
							'STATUS' => '1',
							'CATATAN' => implode("|",$data_diri),
							'ID_USER' => $_SESSION['logged_in']['id_user']
						);
						$this->Log_model->insert_log($data_log_insert_tki);

						$data_log_alamat = array(
							'JENIS' => '36',
							'CODE' => $id_alamat_update,
							'AKSI' => 'UPDATE',
							'STATUS' => '1',
							'CATATAN' => implode("|",$data_alamat),
							'ID_USER' => $_SESSION['logged_in']['id_user']
						);
						$this->Log_model->insert_log($data_log_alamat);

						$jumlah_kualifikasi = $this->input->post('count_kualifikasi');
						$array_kualifikasi = explode(",", $this->input->post('id_kualifikasi'));

						for ($i=0; $i < $jumlah_kualifikasi; $i++) { 
							$id_kualifikasi = $array_kualifikasi[$i];
							$data_kualifikasi = array(
								'JAWABAN' => $this->input->post('jawaban'.$id_kualifikasi),
								'KETERANGAN' => strtoupper($this->input->post('keterangan'.$id_kualifikasi)),
								'CREATED_BY' => $_SESSION['logged_in']['id_user']);
							$result1 = $this->InsertUpdate_model->register_kualifikasi('UPDATE', $data_kualifikasi, $id_kualifikasi);
							if ($result1 == TRUE) {
								$status_sukses_kualifikasi = 'SUKSES';
								$data_log_kualifikasi = array(
									'JENIS' => '37',
									'CODE' => $id_kualifikasi,
									'AKSI' => 'UPDATE',
									'STATUS' => '1',
									'CATATAN' => implode("|",$data_kualifikasi),
									'ID_USER' => $_SESSION['logged_in']['id_user']
								);
								$this->Log_model->insert_log($data_log_kualifikasi);
							} else {
								$status_sukses_kualifikasi = 'GAGAL';
								$data_log_kualifikasi = array(
									'JENIS' => '37',
									'CODE' => $id_kualifikasi,
									'AKSI' => 'UPDATE',
									'STATUS' => '0',
									'CATATAN' => implode("|",$data_kualifikasi),
									'ID_USER' => $_SESSION['logged_in']['id_user']
								);
								$this->Log_model->insert_log($data_log_kualifikasi);
							}
						}

						$jumlah_dokumen = $this->input->post('count_jenis_dok');
						$array_dokumen = explode(",", $this->input->post('id_jenis_dok'));

						for ($j=0; $j < $jumlah_dokumen; $j++) {
							$id_doc = $this->GenerateID_model->generateid();
							$id_dokumen = $array_dokumen[$j];
							$config = array(
								'upload_path'     => $this->uploadPath,
								'allowed_types' => "gif|jpg|png|jpeg|pdf",
								'overwrite' => false,
								'max_size' => "2048000",
								'file_name' => $id_doc
							);
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload('file'.$id_dokumen)) {
								$status_sukses_file = 'GAGAL';
								$data_log_file = array(
									'JENIS' => '18',
									'CODE' => $id_doc,
									'AKSI' => 'CREATE',
									'STATUS' => '0',
									'CATATAN' => '',
									'ID_USER' => $_SESSION['logged_in']['id_user']
								);
								$this->Log_model->insert_log($data_log_file);
							} else {
								$status_sukses_file = 'SUKSES';
								$filename = $this->upload->data('file_name');
								$data_file = array(
									'ID' => $id_doc,
									'ID_TKI' => $id_tki_update,
									'ID_JENIS_DOK' => $id_dokumen,
									'PATH' => $this->uploadPath,
									'FILE' => $filename,
									'CREATED_BY' => $_SESSION['logged_in']['id_user']);
								$this->Upload_model->insert_file($data_file);

						// echo "berhasil";
								$data_log_file = array(
									'JENIS' => '18',
									'CODE' => $id_doc,
									'AKSI' => 'CREATE',
									'STATUS' => '1',
									'CATATAN' => implode("|",$data_file),
									'ID_USER' => $_SESSION['logged_in']['id_user']
								);
								$this->Log_model->insert_log($data_log_file);
							}
						}

						$result3 = $this->InsertUpdate_model->setApproveToNew($id_tki_update);
						if ($result3 == TRUE) {
							$data_log_change_status = array(
								'JENIS' => '20',
								'CODE' => $id_tki_update,
								'AKSI' => 'UPDATE',
								'STATUS' => '1',
								'CATATAN' => implode("|",$data_change_status),
								'ID_USER' => $_SESSION['logged_in']['id_user']
							);
							$this->Log_model->insert_log($data_log_change_status);
						} else {
							$data_log_change_status = array(
								'JENIS' => '20',
								'CODE' => $id_tki_update,
								'AKSI' => 'UPDATE',
								'STATUS' => '0',
								'CATATAN' => implode("|",$data_change_status),
								'ID_USER' => $_SESSION['logged_in']['id_user']
							);
							$this->Log_model->insert_log($data_log_change_status);
						}
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<i class="icon fas fa-check"></i> Sukses Mengupdate CTKI</div>');
						redirect('Tki/detail/'.$id_tki_update);
					} else {
						$data_log = array(
							'JENIS' => '35',
							'CODE' => $id_tki_update,
							'AKSI' => 'UPDATE',
							'STATUS' => '0',
							'CATATAN' => implode("|",$data_change_status),
							'ID_USER' => $_SESSION['logged_in']['id_user']
						);
						$this->Log_model->insert_log($data_log);

						$status_sukses_alamat = 'GAGAL';
						$data_log_alamat = array(
							'JENIS' => '36',
							'CODE' => $id_alamat_update,
							'AKSI' => 'UPDATE',
							'STATUS' => '0',
							'CATATAN' => implode("|",$data_alamat),
							'ID_USER' => $_SESSION['logged_in']['id_user']
						);
						$this->Log_model->insert_log($data_log_alamat);
						$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<i class="icon fas fa-check"></i> Gagal Mengupdate CTKI</div>');
						redirect('Tki/detail/'.$id_tki_update);
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fas fa-check"></i> Tidak Bisa Mengupdate CTKI</div>');
					redirect('Tki/detail/'.$id_tki_update);
				}
			} else {
				redirect('Error_/er_403');
			}
		}
		
	}

	public function approve_tki($id, $value){
		$validate = $this->Log_model->validateAct('20')->num_rows();
		if ($validate > 0) {
			if ($value == '1') {
			$data = array(
				'APPROVE' => $value,
				'APPROVED_BY' => $_SESSION['logged_in']['id_user'],
				'APPROVED_DATE' => date('Y-m-d H:i:s'));
			$result = $this->Approve_model->approve_tki($id, $data);
			$string = 'setujui'; 
			$create_event = array(
				'EVENTTYPE' => '4',
				'REF1' => $id,
				'REF2' => '',
				'REF3' => '',
				'USER' => $_SESSION['logged_in']['id_user'],
				'REMARK' => NULL
			);
			$create_event1 = array(
				'EVENTTYPE' => '2',
				'REF1' => $id,
				'REF2' => '',
				'REF3' => '',
				'USER' => $_SESSION['logged_in']['id_user'],
				'REMARK' => NULL
			);
			$this->Log_model->create_event($create_event);
			$this->Log_model->create_event($create_event1);
		} elseif ($value == '2') {
			$data = array(
				'APPROVE' => $value,
				'APPROVED_BY' => $_SESSION['logged_in']['id_user'],
				'APPROVED_DATE' => date('Y-m-d H:i:s'),
				'CATATAN' => strtoupper($this->input->post('alasan')));
			$result = $this->Approve_model->approve_tki($id, $data);
			$string = 'tolak';
			$create_event = array(
				'EVENTTYPE' => '5',
				'REF1' => $id,
				'REF2' => '',
				'REF3' => '',
				'USER' => $_SESSION['logged_in']['id_user'],
				'REMARK' => $data['CATATAN']
			);
			$create_event1 = array(
				'EVENTTYPE' => '3',
				'REF1' => $id,
				'REF2' => '',
				'REF3' => '',
				'USER' => $_SESSION['logged_in']['id_user'],
				'REMARK' => NULL
			);
			$this->Log_model->create_event($create_event);
			$this->Log_model->create_event($create_event1);
		}
		if ($result == TRUE) {
			$data_log_approve_tki = array(
				'JENIS' => '20',
				'CODE' => $id,
				'AKSI' => 'UPDATE',
				'STATUS' => '1',
				'CHANGE_STATUS' => $value,
				'CATATAN' => implode("|",$data),
				'ID_USER' => $_SESSION['logged_in']['id_user']
			);
			$this->Log_model->insert_log($data_log_approve_tki);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon fas fa-check"></i> Sukses '.$string.' data TKI
				</div>');
		} else {
			$data_log_approve_tki = array(
				'JENIS' => '20',
				'CODE' => $id,
				'AKSI' => 'UPDATE',
				'STATUS' => '0',
				'CHANGE_STATUS' => '',
				'CATATAN' => implode("|",$data),
				'ID_USER' => $_SESSION['logged_in']['id_user']
			);
			$this->Log_model->insert_log($data_log_approve_tki);
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon fas fa-check"></i> Gagal '.$string.' data TKI
				</div>');
		}
		redirect('Tki/detail/'.$id);
		} else {
			redirect('Error_/er_403');
		}

	}

}