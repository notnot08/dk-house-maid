<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pekerjaan_model extends CI_Model {

	public function get_job($param = FALSE){
		$hasil = $this->db->query("SELECT a.ID, a.PEKERJAAN, a.CATATAN, a.STATUS, a.INSERT_DATE, b.NAMA 
			FROM MST_PEKERJAAN a LEFT JOIN MST_USER b ON a.CREATED_BY = b.ID");
		return $hasil;
	}

	public function insert_job($data){
		$query = $this->db->insert('MST_PEKERJAAN', $data);
		return $query;
	}

	public function changestatus_pekerjaan($value, $id){
		$hasil = $this->db->query("UPDATE MST_PEKERJAAN SET STATUS = '".$value."' WHERE ID = '".$id."'");
		return $hasil;
	}

	public function check_approveable($id){
		$query = "SELECT DISTINCT(ID) FROM JUSTIFIKASI_PEKERJAAN WHERE ID = '".$id."' AND DATA_DIRI_APPROVAL = '1' AND SURAT_PERJANJIAN_APPROVAL = '1' AND KONTRAK_KERJA_APPROVAL = '1' AND ID_KONTRAK IS NOT NULL AND ID_PERJANJIAN IS NOT NULL";
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function changestatus_progresspekerjaan($value, $id){
		$hasil = $this->db->query("UPDATE JUSTIFIKASI_PEKERJAAN SET STATUS = '0', PROGRESS = '".$value."' WHERE ID = '".$id."'");
		return $hasil;
	}

	public function get_active_job(){
		$hasil = $this->db->query("SELECT ID, PEKERJAAN FROM MST_PEKERJAAN WHERE STATUS = '1'");
		return $hasil;
	}

	public function validate_justifikasi($param1, $param = FALSE, $value = FALSE){
		if ($param1 == 'SEARCH') {
			if ($param == 'NAMA') {
				$condition = 'a.NAMA';
			} elseif ($param == 'NIK') {
				$condition = 'a.NIK';
			} elseif ($param == 'MAID_CODE') {
				$condition = 'a.MAID_CODE';
			}

			if ($_SESSION['logged_in']['role'] == '3') {
				$condition1 = "AND a.ID_GROUP = '".$_SESSION['logged_in']['group']."'";
			} else {
				$condition1 = '';
			}

			$hasil = $this->db->query("
				SELECT *, 
				CASE
				WHEN APPROVE = '0' AND STATUS_JUSTIFIKASI = '0' THEN '2'
				WHEN APPROVE = '1' AND STATUS_JUSTIFIKASI = '0' THEN '1'
				WHEN APPROVE = '1' AND STATUS_JUSTIFIKASI is null THEN '1'
				WHEN APPROVE = '0' AND STATUS_JUSTIFIKASI is null THEN '2'
				WHEN APPROVE = '2' THEN '2'
				ELSE '0'
				END AS APPROVAL
				FROM (SELECT a.ID 'ID_TKI', a.NIK, a.MAID_CODE, a.NAMA, a.APPROVE, b.ID 'ID_JUSTIFIKASI', b.STATUS 'STATUS_JUSTIFIKASI' 
				FROM MST_TKI a LEFT JOIN JUSTIFIKASI_PEKERJAAN b ON a.ID = b.ID_TKI WHERE ".$condition." LIKE '%".$value."%' AND b.STATUS = '1' ".$condition1."
				UNION
				SELECT a.ID 'ID_TKI', a.NIK, a.MAID_CODE, a.NAMA, a.APPROVE, b.ID 'ID_JUSTIFIKASI', b.STATUS 'STATUS_JUSTIFIKASI' 
				FROM MST_TKI a LEFT JOIN JUSTIFIKASI_PEKERJAAN b ON a.ID = b.ID_TKI WHERE ".$condition." LIKE '%".$value."%' AND b.STATUS = '0' ".$condition1."
				UNION
				SELECT a.ID 'ID_TKI', a.NIK, a.MAID_CODE, a.NAMA, a.APPROVE, b.ID 'ID_JUSTIFIKASI', b.STATUS 'STATUS_JUSTIFIKASI' 
				FROM MST_TKI a LEFT JOIN JUSTIFIKASI_PEKERJAAN b ON a.ID = b.ID_TKI WHERE ".$condition." LIKE '%".$value."%' AND b.STATUS is null ".$condition1.") AS a GROUP BY ID_TKI ORDER BY NAMA ASC LIMIT 10");
			return $hasil;
		} elseif ($param1 == 'AVAILABLE') {
			if ($_SESSION['logged_in']['role'] == '3') {
				$condition1 = "AND a.ID_GROUP = '".$_SESSION['logged_in']['group']."'";
			} else {
				$condition1 = '';
			}
			$hasil = $this->db->query("
				SELECT * FROM (SELECT *, 
				CASE
				WHEN APPROVE = '0' AND STATUS_JUSTIFIKASI = '0' THEN '2'
				WHEN APPROVE = '1' AND STATUS_JUSTIFIKASI = '0' THEN '1'
				WHEN APPROVE = '1' AND STATUS_JUSTIFIKASI is null THEN '1'
				WHEN APPROVE = '0' AND STATUS_JUSTIFIKASI is null THEN '2'
				WHEN APPROVE = '2' THEN '2'
				ELSE '0'
				END AS APPROVAL
				FROM (SELECT a.ID 'ID_TKI', a.NIK, a.MAID_CODE, a.NAMA, a.APPROVE, b.ID 'ID_JUSTIFIKASI', b.STATUS 'STATUS_JUSTIFIKASI' 
				FROM MST_TKI a LEFT JOIN JUSTIFIKASI_PEKERJAAN b ON a.ID = b.ID_TKI WHERE b.STATUS = '1' ".$condition1."
				UNION
				SELECT a.ID 'ID_TKI', a.NIK, a.MAID_CODE, a.NAMA, a.APPROVE, b.ID 'ID_JUSTIFIKASI', b.STATUS 'STATUS_JUSTIFIKASI' 
				FROM MST_TKI a LEFT JOIN JUSTIFIKASI_PEKERJAAN b ON a.ID = b.ID_TKI WHERE b.STATUS = '0' ".$condition1."
				UNION
				SELECT a.ID 'ID_TKI', a.NIK, a.MAID_CODE, a.NAMA, a.APPROVE, b.ID 'ID_JUSTIFIKASI', b.STATUS 'STATUS_JUSTIFIKASI' 
				FROM MST_TKI a LEFT JOIN JUSTIFIKASI_PEKERJAAN b ON a.ID = b.ID_TKI WHERE b.STATUS is null ".$condition1.") AS a GROUP BY ID_TKI ORDER BY NAMA ASC LIMIT 10) AS A WHERE APPROVAL = '1'");
			return $hasil;
		}
	}

	public function insert_justifikasi($data){
		$query = $this->db->insert('JUSTIFIKASI_PEKERJAAN', $data);
		return $query;
	}

	public function setApproveDokTki($id_tki, $id){
		$hasil = $this->db->query("CALL setApproveDokTki(".$id_tki.",".$id.")");
		return $hasil;
	}

	public function get_justifikasi($id){
		$hasil = $this->db->query("SELECT a.ID, a.ID_TKI, a.ID_PEKERJAAN, a.ID_LOWONGAN, c.PEKERJAAN, a.STATUS, a.PROGRESS as 'PROGRESS_STAT',
			CASE WHEN a.STATUS = '1' THEN 'AKTIF'
			WHEN a.STATUS = '0' THEN 'NON-AKTIF' END AS STATUS_STAT,
			CASE WHEN a.PROGRESS = '0' THEN 'CLOSED' 
			WHEN a.PROGRESS = '1' THEN 'NEW' 
			WHEN a.PROGRESS = '2' THEN 'ON PROGRESS' 
			WHEN a.PROGRESS = '3' THEN 'APPROVED' 
			WHEN a.PROGRESS = '4' THEN 'REJECTED' 
			WHEN a.PROGRESS = '5' THEN 'CANCELED' END AS PROGRESS, 

			CASE WHEN a.DATA_DIRI_APPROVAL = '0' THEN 'ON DRAFT' 
			WHEN a.DATA_DIRI_APPROVAL = '1' THEN 'APPROVED' 
			WHEN a.DATA_DIRI_APPROVAL = '2' THEN 'REJECTED' END AS DATA_DIRI_APPROVAL, 

			a.DATA_DIRI_APPROVAL 'STATUS_DATA_DIRI_APPROVAL', (SELECT NAMA FROM MST_USER WHERE ID = a.APPROVED_BY_1) as 'APPROVED_BY_1', DATE_FORMAT(a.APPROVED_DATE_1, '%d %M %Y %H:%i') APPROVED_DATE_1, 

			CASE WHEN a.SURAT_PERJANJIAN_APPROVAL = '0' THEN 'ON DRAFT' 
			WHEN a.SURAT_PERJANJIAN_APPROVAL = '1' THEN 'APPROVED' 
			WHEN a.SURAT_PERJANJIAN_APPROVAL = '2' THEN 'REJECTED' 
			WHEN a.SURAT_PERJANJIAN_APPROVAL = '3' THEN 'SUBMITTED' ELSE 'NOT YET' END AS SURAT_PERJANJIAN_APPROVAL, 

			a.SURAT_PERJANJIAN_APPROVAL 'STATUS_SURAT_PERJANJIAN_APPROVAL', (SELECT NAMA FROM MST_USER WHERE ID = a.APPROVED_BY_2) as 'APPROVED_BY_2', DATE_FORMAT(APPROVED_DATE_2, '%d %M %Y %H:%i') APPROVED_DATE_2, 

			CASE WHEN a.KONTRAK_KERJA_APPROVAL = '0' THEN 'ON DRAFT' 
			WHEN a.KONTRAK_KERJA_APPROVAL = '1' THEN 'APPROVED' 
			WHEN a.KONTRAK_KERJA_APPROVAL = '2' THEN 'REJECTED' 
			WHEN a.KONTRAK_KERJA_APPROVAL = '3' THEN 'SUBMITTED' ELSE 'NOT YET' END AS KONTRAK_KERJA_APPROVAL, 

			a.KONTRAK_KERJA_APPROVAL 'STATUS_KONTRAK_KERJA_APPROVAL', (SELECT NAMA FROM MST_USER WHERE ID = a.APPROVED_BY_3) as 'APPROVED_BY_3', DATE_FORMAT(APPROVED_DATE_3, '%d %M %Y %H:%i') APPROVED_DATE_3, (SELECT NAMA FROM MST_USER WHERE ID = a.ASSIGNED_BY) as 'ASSIGNED_BY', DATE_FORMAT(ASSIGNED_DATE, '%d %M %Y %H:%i') ASSIGNED_DATE, a.ID_KONTRAK, a.ID_PERJANJIAN, a.CATATAN, a.CREATED_BY,
            (SELECT NEGARA FROM TB_NEGARA WHERE CODE = (SELECT NEGARA FROM MST_LOWONGAN WHERE ID = a.ID_LOWONGAN)) as 'NEGARA'
            FROM JUSTIFIKASI_PEKERJAAN a JOIN MST_TKI b ON a.ID_TKI = b.ID JOIN MST_PEKERJAAN c ON a.ID_PEKERJAAN = c.ID WHERE a.ID = '".$id."'");
		return $hasil;
		// JOIN MST_SURAT_PERJANJIAN d ON a.ID_PERJANJIAN = d.ID
	}

	public function get_timeline($id){
		$hasil = $this->db->query("SELECT MESSAGE, USER, DATE_FORMAT(INSERT_DATE, '%d %M %Y %H.%i.%s') as 'INSERT_DATE', REMARK FROM LOG_EVENT WHERE REF2 = '".$id."' ORDER BY INSERT_DATE DESC");
		return $hasil;
	}

	public function get_pekerjaan_aktif(){
		if ($_SESSION['logged_in']['role'] == '3') {
			$condition = "AND a.ID_GROUP = '".$_SESSION['logged_in']['group']."'";
		} else {
			$condition = '';
		}
		$hasil = $this->db->query("SELECT *, CASE WHEN APPROVE = '0' AND STATUS_JUSTIFIKASI = '0' THEN '2' WHEN APPROVE = '1' AND STATUS_JUSTIFIKASI = '0' THEN '1' WHEN APPROVE = '1' AND STATUS_JUSTIFIKASI is null THEN '1' WHEN APPROVE = '0' AND STATUS_JUSTIFIKASI is null THEN '2' WHEN APPROVE = '2' THEN '2' ELSE '0' END AS APPROVAL FROM (SELECT a.ID 'ID_TKI', a.NIK, a.MAID_CODE, a.NAMA, a.APPROVE, b.ID 'ID_JUSTIFIKASI', b.STATUS 'STATUS_JUSTIFIKASI', b.ID_LOWONGAN, b.SURAT_PERJANJIAN_APPROVAL, b.KONTRAK_KERJA_APPROVAL, (SELECT PEKERJAAN FROM MST_PEKERJAAN WHERE ID = b.ID_PEKERJAAN) as 'PEKERJAAN' FROM JUSTIFIKASI_PEKERJAAN b LEFT JOIN MST_TKI a ON a.ID = b.ID_TKI WHERE b.STATUS = '1' ".$condition.") AS ab GROUP BY ID_TKI");
		return $hasil;
	}

	public function get_all_pekerjaan(){
		if ($_SESSION['logged_in']['role'] == '3') {
			$condition = "WHERE a.ID_GROUP = '".$_SESSION['logged_in']['group']."'";
		} else {
			$condition = '';
		}
		$hasil = $this->db->query("SELECT *, CASE WHEN APPROVE = '0' AND STATUS_JUSTIFIKASI = '0' THEN '2' WHEN APPROVE = '1' AND STATUS_JUSTIFIKASI = '0' THEN '1' WHEN APPROVE = '1' AND STATUS_JUSTIFIKASI is null THEN '1' WHEN APPROVE = '0' AND STATUS_JUSTIFIKASI is null THEN '2' WHEN APPROVE = '2' THEN '2' ELSE '0' END AS APPROVAL FROM (SELECT a.ID 'ID_TKI', a.NIK, a.MAID_CODE, a.NAMA, a.APPROVE, b.ID 'ID_JUSTIFIKASI', b.STATUS 'STATUS_JUSTIFIKASI', b.PROGRESS, b.ID_LOWONGAN, b.SURAT_PERJANJIAN_APPROVAL, b.KONTRAK_KERJA_APPROVAL, (SELECT PEKERJAAN FROM MST_PEKERJAAN WHERE ID = b.ID_PEKERJAAN) as 'PEKERJAAN' FROM JUSTIFIKASI_PEKERJAAN b LEFT JOIN MST_TKI a ON a.ID = b.ID_TKI ".$condition.") AS ab");
		return $hasil;
	}

	public function update_perjanjian_justifikasi($id, $id_perjanjian){
		$hasil = $this->db->query("UPDATE JUSTIFIKASI_PEKERJAAN SET ID_PERJANJIAN = '".$id_perjanjian."', SURAT_PERJANJIAN_APPROVAL = '0' WHERE ID = '".$id."'");
		return $hasil;
	}

	public function update_kontrak_justifikasi($id, $id_kontrak){
		$hasil = $this->db->query("UPDATE JUSTIFIKASI_PEKERJAAN SET ID_KONTRAK = '".$id_kontrak."', KONTRAK_KERJA_APPROVAL = '0' WHERE ID = '".$id."'");
		$hasil2 = $this->db->query("UPDATE MST_KONTRAK SET ID_PEKERJAAN = (SELECT ID_PEKERJAAN FROM JUSTIFIKASI_PEKERJAAN WHERE ID_KONTRAK = '".$id_kontrak."') WHERE ID = '".$id_kontrak."'");
		return $hasil;
	}

	public function get_assign_pekerjaan($param, $id){
		if ($param == 'LISTASSIGN') {
			$query = "SELECT a.ID, a.JOB, b.PEKERJAAN, a.PENERIMA_JASA, c.NEGARA, a.SLOT_PEKERJAAN FROM MST_LOWONGAN a JOIN MST_PEKERJAAN b ON a.JENIS_PEKERJAAN = b.ID JOIN TB_NEGARA c ON a.NEGARA = c.CODE WHERE a.JENIS_PEKERJAAN = '".$id."' AND a.IS_USED = 'N'";
		} elseif($param == 'GETASSSIGNJOB') {
			$query = "SELECT a.ID, a.JOB, b.PEKERJAAN, a.PENERIMA_JASA, c.NEGARA FROM MST_LOWONGAN a JOIN MST_PEKERJAAN b ON a.JENIS_PEKERJAAN = b.ID JOIN TB_NEGARA c ON a.NEGARA = c.CODE WHERE a.ID = '".$id."'";
		}
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function update_assign_pekerjaan($id, $id_lowongan){
		$hasil = $this->db->query("UPDATE JUSTIFIKASI_PEKERJAAN SET ID_LOWONGAN = '".$id_lowongan."', ASSIGNED_BY = '".$_SESSION['logged_in']['id_user']."', ASSIGNED_DATE = NOW() WHERE ID = '".$id."'");
		return $hasil;
	}
}