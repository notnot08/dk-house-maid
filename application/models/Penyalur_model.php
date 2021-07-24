<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyalur_model extends CI_Model {

	public function insert_penyalur($param, $data, $id = FALSE){
		if ($param == 'INSERT') {
			$query = $this->db->insert('MST_PENYALUR', $data);
			return $query;
		} elseif ($param == 'UPDATE') {
			$this->db->set($data);
			$this->db->where('ID', $id);
			return $this->db->update('MST_PENYALUR');
		}
	}

	public function get_all_approve(){
		$hasil = $this->db->query("SELECT a.ID, a.NAMA, a.NIK, a.APPROVE, 
			CASE 
			WHEN APPROVE = '0' THEN 'NEW'
			WHEN APPROVE = '1' THEN 'APPROVED'
			WHEN APPROVE = '2' THEN 'REJECTED'
			END AS APPROVE_PROGRESS, c.NAMA_PERUSAHAAN FROM MST_PENYALUR a JOIN MST_GROUP b ON a.ID_GROUP = b.ID JOIN MST_PERUSAHAAN c 
			ON b.ID_PERUSAHAAN = c.ID WHERE a.APPROVE = '0'");
		return $hasil;	
	}

	public function get_all_penyalur(){
		$hasil = $this->db->query("SELECT a.ID, a.NAMA, a.NIK, a.APPROVE, 
			CASE 
			WHEN APPROVE = '0' THEN 'NEW'
			WHEN APPROVE = '1' THEN 'APPROVED'
			WHEN APPROVE = '2' THEN 'REJECTED'
			END AS APPROVE_PROGRESS, c.NAMA_PERUSAHAAN, (SELECT USERNAME FROM MST_USER WHERE ID_PENYALUR = a.ID) as 'USERNAME' FROM MST_PENYALUR a JOIN MST_GROUP b ON a.ID_GROUP = b.ID JOIN MST_PERUSAHAAN c 
			ON b.ID_PERUSAHAAN = c.ID");
		return $hasil;	
	}

	public function get_penyalur_detail($id){
		$hasil = $this->db->query("SELECT a.ID as 'ID_PENYALUR', a.NAMA as 'NAMA_PENYALUR', a.NPWP, a.APPROVE,
		CASE WHEN a.APPROVE = '0' THEN 'NEW'
			WHEN a.APPROVE = '1' THEN 'APPROVED'
			WHEN a.APPROVE = '2' THEN 'REJECTED'
			END AS APPROVE_PROGRESS, a.INSERT_DATE, a.CATATAN, a.NIK, a.ALAMAT, a.TEMPAT_LAHIR, a.TANGGAL_LAHIR, b.KET, b.ID as 'ID_GROUP', c.NAMA_PERUSAHAAN, e.NAMA as 'NAMA_PENGAJU', (SELECT USERNAME FROM MST_USER WHERE ID_PENYALUR = a.ID) as 'USERNAME' FROM MST_PENYALUR a JOIN MST_GROUP b ON a.ID_GROUP = b.ID JOIN MST_PERUSAHAAN c ON b.ID_PERUSAHAAN = c.ID JOIN MST_USER e ON a.CREATED_BY = e.ID WHERE a.ID = '".$id."'");
		return $hasil;	
	}

	public function approve_penyalur($param, $value){
		$hasil = $this->db->query("UPDATE MST_PENYALUR SET APPROVE = '".$value."', APPROVED_BY = '".$_SESSION['logged_in']['id_user']."', APPROVED_DATE = CURRENT_TIMESTAMP() WHERE ID = '".$param."'");
		return $hasil;
	}

	public function get_name_penyalur($id){
		$this->db->select('ID, NAMA');
		$this->db->where('ID', $id);
		return $this->db->get('MST_PENYALUR');
	}

	public function setUserPenyalur($param, $id_penyalur, $id_user = FALSE, $usernya = FALSE, $data = FALSE){
		if ($param == 'APPROVE') {
			$hasil = $this->db->query("CALL setUserPenyalur('".$id_penyalur."', '".$id_user."', '".$_SESSION['logged_in']['id_user']."', '".$usernya."')");
			return $hasil;
		} elseif ($param == 'REJECT') {
			$this->db->set($data);
			$this->db->where('ID', $id_penyalur);
			return $this->db->update('MST_PENYALUR');
		}
		$hasil = $this->db->query("CALL setUserPenyalur('".$id_penyalur."', '".$id_user."', '".$_SESSION['logged_in']['id_user']."', '".$usernya."')");
		return $hasil;
	}
}