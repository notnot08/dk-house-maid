<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','download'));	
		$this->load->model('Dokumen_model');
		$this->load->model('Kontrak_model');
		$this->load->model('Log_model');
		
		if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){								
			redirect('Login');
		}
	}

	public function download($id)
	{
		// echo $id;
		$file = $this->Dokumen_model->get_doc_info('ALL', $id);
		$row1 = $file->row_array();
		force_download($row1['PATH']."/".$row1['FILE'], NULL);
		// echo $row1['PATH']."/".$row1['FILE'];
	}

	public function delete($param, $id) {
		if ($param == 'tki') {
			$validate = $this->Log_model->validateAct('46')->num_rows();
			if ($validate > 0) {
				$file = $this->Dokumen_model->get_doc_info('TKI', $id);
				$row1 = $file->row_array();
				$data = array(
					'STATUS' => '0',
					'DELETED_BY' => $_SESSION['logged_in']['id_user']);
				$result = $this->Dokumen_model->deleteFile($id, $data);

				$file_pointer = $row1['PATH']."/".$row1['FILE']; 

				if (!unlink($file_pointer)) { 
					$message = $file_pointer." cannot be deleted due to an error"; 
					$data = array(
						'STATUS' => '1',
						'DELETED_BY' => NULL);
					$result = $this->Dokumen_model->deleteFile($id, $data);
					$result2 = FALSE;
				} 
				else { 
					$message = $file_pointer." has been deleted"; 
					$result2 = TRUE;
				} 


				if ($result == TRUE && $result2 == TRUE) {
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fas fa-check"></i> '.$message.'
						</div>');
					$data_log = array(
						'JENIS' => '46',
						'CODE' => $id,
						'AKSI' => 'UPDATE',
						'STATUS' => '1',
						'CHANGE_STATUS' => '',
						'CATATAN' => implode("|",$data),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log);
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fas fa-ban"></i> '.$message.'
						</div>');
					$data_log = array(
						'JENIS' => '46',
						'CODE' => $id,
						'AKSI' => 'UPDATE',
						'STATUS' => '0',
						'CHANGE_STATUS' => '',
						'CATATAN' => implode("|",$data),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log);
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
			} else {
				redirect('Error_/er_403');
			}
		} elseif ($param == 'kontrak') {
			$validate = $this->Log_model->validateAct('47')->num_rows();
			if ($validate > 0) {
				$file = $this->Dokumen_model->get_doc_info('KONTRAK', $id);
				$row1 = $file->row_array();
				$data = array(
					'STATUS' => '0',
					'DELETED_BY' => $_SESSION['logged_in']['id_user']);
				$result = $this->Dokumen_model->deleteFile($id, $data);

				$data2 = array(
					'ID_DOKUMEN' => NULL);
				$result3 = $this->Kontrak_model->updateDokNull($id, $data2);

				$file_pointer = $row1['PATH']."/".$row1['FILE']; 

				if (!unlink($file_pointer)) { 
					$message = $file_pointer." cannot be deleted due to an error"; 
					$data = array(
						'STATUS' => '1',
						'DELETED_BY' => NULL);
					$result = $this->Dokumen_model->deleteFile($id, $data);
					$result2 = FALSE;
					$data3 = array(
						'ID_DOKUMEN' => $row1['ID']);
					$result4 = $this->Kontrak_model->updateDokNull($id, $data3);
				} 
				else { 
					$message = $file_pointer." has been deleted"; 
					$result2 = TRUE;
				} 


				if ($result == TRUE && $result2 == TRUE && $result3) {
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fas fa-check"></i> '.$message.'
						</div>');
					$data_log = array(
						'JENIS' => '46',
						'CODE' => $id,
						'AKSI' => 'UPDATE',
						'STATUS' => '1',
						'CHANGE_STATUS' => '',
						'CATATAN' => implode("|",$data),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log);
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fas fa-ban"></i> '.$message.'
						</div>');
					$data_log = array(
						'JENIS' => '46',
						'CODE' => $id,
						'AKSI' => 'UPDATE',
						'STATUS' => '0',
						'CHANGE_STATUS' => '',
						'CATATAN' => implode("|",$data),
						'ID_USER' => $_SESSION['logged_in']['id_user']
					);
					$this->Log_model->insert_log($data_log);
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
			} else {
				redirect('Error_/er_403');
			}
		} elseif ($param == 'perjanjian') {
			# code...
		}
	}

}