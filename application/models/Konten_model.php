<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konten_model extends CI_Model {

	public function getKonten($param = FALSE){
		if ($param == '1') {
			$query = "SELECT ID, JUDUL, JENIS_KONTEN, DATE_FORMAT(UPDATE_DATE, '%d %M %Y %H.%i.%s') as 'UPDATE_DATE', DATE_FORMAT(INSERT_DATE, '%d %M %Y %H.%i.%s') as 'INSERT_DATE', (SELECT NAMA FROM TB_USER WHERE ID = CREATED_BY) as 'USER', STATUS FROM TB_KONTEN WHERE JENIS_KONTEN = '1' ORDER BY INSERT_DATE DESC";
		} elseif ($param == '2') {
			$query = "SELECT ID, JUDUL, JENIS_KONTEN, DATE_FORMAT(UPDATE_DATE, '%d %M %Y %H.%i.%s') as 'UPDATE_DATE', DATE_FORMAT(INSERT_DATE, '%d %M %Y %H.%i.%s') as 'INSERT_DATE', (SELECT NAMA FROM TB_USER WHERE ID = CREATED_BY) as 'USER', STATUS FROM TB_KONTEN WHERE JENIS_KONTEN = '2' ORDER BY INSERT_DATE DESC";
		} elseif ($param == '3') {
			$query = "SELECT ID, JUDUL, JENIS_KONTEN, DATE_FORMAT(UPDATE_DATE, '%d %M %Y %H.%i.%s') as 'UPDATE_DATE', DATE_FORMAT(INSERT_DATE, '%d %M %Y %H.%i.%s') as 'INSERT_DATE', (SELECT NAMA FROM TB_USER WHERE ID = CREATED_BY) as 'USER', STATUS FROM TB_KONTEN WHERE JENIS_KONTEN = '3' ORDER BY INSERT_DATE DESC";
		} else {
			$query = "SELECT ID, JUDUL, JENIS_KONTEN, DATE_FORMAT(INSERT_DATE, '%d %M %Y %H.%i.%s') as 'INSERT_DATE', (SELECT NAMA FROM TB_USER WHERE ID = CREATED_BY) as 'USER', STATUS FROM TB_KONTEN ORDER BY INSERT_DATE DESC";
		}
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function getDetailKonten($id){
		$hasil = $this->db->query("SELECT ID, JUDUL, JENIS_KONTEN, DESKRIPSI, INSERT_DATE, CREATED_BY, STATUS FROM TB_KONTEN WHERE ID ='".$id."'");
		return $hasil;
	}

	public function addKonten($data) {
		$this->db->trans_start();
		$this->db->insert('TB_KONTEN', $data);
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

	public function editKonten($id, $data) {
		$this->db->trans_start();
		$this->db->where('ID', $id);
		$this->db->update('TB_KONTEN', $data);
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

	public function Changestatus_konten($value, $id){
		$hasil = $this->db->query("UPDATE TB_KONTEN SET STATUS = '".$value."' WHERE ID = '".$id."'");
		return $hasil;
	}
}