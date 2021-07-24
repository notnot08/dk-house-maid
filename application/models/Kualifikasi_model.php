<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kualifikasi_model extends CI_Model {

	public function get_kualifikasi($param = FALSE){
		$hasil = $this->db->query("SELECT a.ID, a.PERTANYAAN, a.JENIS, a.CATATAN, a.STATUS, a.INSERT_DATE, b.NAMA 
			FROM MST_KUALIFIKASI a LEFT JOIN MST_USER b ON a.CREATED_BY = b.ID");
		return $hasil;
	}

	public function insert_kualifikasi($data){
		$this->db->insert('MST_KUALIFIKASI', $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function changestatus_kualifikasi($value, $id){
		$hasil = $this->db->query("UPDATE MST_KUALIFIKASI SET STATUS = '".$value."' WHERE ID = '".$id."'");
		return $hasil;
	}

	public function get_active_kualifikasi(){
		$hasil = $this->db->query("SELECT ID, PERTANYAAN, JENIS FROM MST_KUALIFIKASI WHERE STATUS = '1'");
		return $hasil;
	}
}