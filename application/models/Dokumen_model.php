<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen_model extends CI_Model {

	public function get_doc_type($param = FALSE){
		$hasil = $this->db->query("SELECT a.NAMA_DOKUMEN, a.ALIAS, CASE WHEN a.JENIS = '1' THEN 'DOK WAJIB TKI' ELSE 'REGULAR' END AS 'JENIS', a.INSERT_DATE, b.NAMA AS 'CREATED_BY' FROM MST_JENIS_DOK a JOIN MST_USER b ON a.CREATED_BY = b.ID ORDER BY INSERT_DATE DESC");
		return $hasil;
	}

	public function insert_doc_type($data){
		$query = $this->db->insert('MST_JENIS_DOK', $data);
		return $query;
	}

	public function get_active_doc_type(){
		$hasil = $this->db->query("SELECT ID, NAMA_DOKUMEN FROM MST_JENIS_DOK WHERE JENIS = '1' AND STATUS = '1' ORDER BY NAMA_DOKUMEN ASC");
		return $hasil;
	}

	public function get_doc_non_wajib(){
		$hasil = $this->db->query("SELECT ID, NAMA_DOKUMEN FROM MST_JENIS_DOK WHERE JENIS IS NULL AND STATUS = '1' ORDER BY NAMA_DOKUMEN ASC");
		return $hasil;
	}

	public function deleteFile($id, $data){
		$this->db->trans_start();
		$this->db->where('ID', $id);
		$this->db->update('DOKUMEN', $data);
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

	public function get_doc_info($param, $id){
		if ($param == 'TKI') {
			$condition = 'ID';
		} elseif ($param == 'KONTRAK') {
			$condition = 'ID_KONTRAK';
		} elseif ($param == 'ALL') {
			$condition = 'ID';
		}
		$this->db->select('ID, PATH, FILE, ID_KONTRAK, ID_PERJANJIAN');
		$this->db->where($condition, $id);
		$this->db->where('STATUS', '1');
		return $this->db->get('DOKUMEN');
	}
}