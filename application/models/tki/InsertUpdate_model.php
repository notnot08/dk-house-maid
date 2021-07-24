<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InsertUpdate_model extends CI_Model {

	public function checkAvailability($data){
		return $this->db->get_where('JUSTIFIKASI_PEKERJAAN', $data);
	}

	public function register_ctki($param, $dataTki, $dataAlamat, $id_data = FALSE){
		if ($param == 'INSERT') {
			$this->db->trans_start();
			$this->db->insert('MST_TKI', $dataTki);
			$this->db->insert('ALAMAT', $dataAlamat);
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} 
			else {
				$this->db->trans_commit();
				return TRUE;
			}
		} elseif ($param == 'UPDATE') {
			$this->db->trans_start();
			$this->db->where('ID', $id_data['ID_TKI']);
			$this->db->update('MST_TKI', $dataTki);

			$this->db->where('ID', $id_data['ALAMAT_ID']);
			$this->db->update('ALAMAT', $dataAlamat);
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} 
			else {
				$this->db->trans_commit();
				return TRUE;
			}
		} else {
			return FALSE;
		}
	}

	public function register_kualifikasi($param, $data, $id = FALSE){
		if ($param == 'INSERT') {
			$this->db->trans_start();
			$this->db->insert('KUALIFIKASI', $data);
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} 
			else {
				$this->db->trans_commit();
				return TRUE;
			}
		} elseif ($param == 'UPDATE') {
			$this->db->trans_start();
			$this->db->where('ID', $id);
			$this->db->update('KUALIFIKASI', $data);
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} 
			else {
				$this->db->trans_commit();
				return TRUE;
			}
		}
	}

	public function setApproveToNew($id){
		$data_temp = array(
			'APPROVE' => '0');
		$this->db->trans_start();
		$this->db->where('ID', $id);
		$this->db->update('MST_TKI', $data_temp);
		$this->db->trans_complete(); 

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} 
		else {
			$this->db->trans_commit();
			return TRUE;
		}
	}
}