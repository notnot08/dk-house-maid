<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowongan_model extends CI_Model {

	public function get_lowongan(){
		$hasil = $this->db->query("SELECT a.ID, b.PEKERJAAN, CASE WHEN a.IS_COMPANY = 'N' THEN 'RUMAH TANGGA' WHEN a.IS_COMPANY = 'Y' THEN 'PERUSAHAAN' END AS JENIS, c.NEGARA, a.PENERIMA_JASA, a.IS_USED, CASE WHEN a.IS_USED = 'N' THEN 'TERSEDIA' WHEN a.IS_USED = 'Y' THEN 'TIDAK TERSEDIA' END AS IS_USED2, a.SLOT_PEKERJAAN FROM MST_LOWONGAN a JOIN MST_PEKERJAAN b ON a.JENIS_PEKERJAAN = b.ID JOIN TB_NEGARA c ON a.NEGARA = c.CODE ORDER BY IS_USED ASC");
		return $hasil;
	}

	public function insert_lowongan($data){
		$this->db->insert('MST_LOWONGAN', $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}