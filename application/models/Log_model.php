<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {
	public function insert_log($data){
		$query = $this->db->insert('LOG', $data);
		return $query;
	}

	public function get_log($param, $id = FALSE){
		if ($param == 'ACTIVITY') {
			$query = "SELECT b.JENIS AS KEGIATAN, a.CATATAN, a.INSERT_DATE FROM LOG a LEFT JOIN TB_RULE_ACT b ON a.JENIS = b.ID 
			WHERE a.JENIS in ('1','4') AND a.ID_USER = '".$id."'";
		} elseif ($param == 'USER') {
			$query = "SELECT b.JENIS KEGIATAN, a.CHANGE_STATUS, a.CATATAN, c.NAMA, a.INSERT_DATE 
			FROM LOG a LEFT JOIN TB_RULE_ACT b ON a.JENIS = b.ID
			JOIN MST_USER c ON a.ID_USER = c.ID
			WHERE a.JENIS in ('2','3','5','6') AND a.CODE = '".$id."'";
		} elseif ($param == 'DOC_TYPE') {
			$query = "SELECT b.JENIS AS KEGIATAN, a.CATATAN, c.NAMA, a.INSERT_DATE FROM LOG a LEFT JOIN TB_RULE_ACT b ON a.JENIS = b.ID JOIN MST_USER c ON a.ID_USER = c.ID
			WHERE a.JENIS in ('7')";
		} elseif ($param == 'JOB') {
			$query = "SELECT b.JENIS AS KEGIATAN, a.CHANGE_STATUS, a.CATATAN, c.NAMA, a.INSERT_DATE FROM LOG a LEFT JOIN TB_RULE_ACT b ON a.JENIS = b.ID JOIN MST_USER c ON a.ID_USER = c.ID WHERE a.JENIS in ('8','9','10')";
		} elseif ($param == 'KUALIFIKASI') {
			$query = "SELECT b.JENIS AS KEGIATAN, a.CHANGE_STATUS, a.CATATAN, c.NAMA, a.INSERT_DATE FROM LOG a LEFT JOIN TB_RULE_ACT b ON a.JENIS = b.ID JOIN MST_USER c ON a.ID_USER = c.ID WHERE a.JENIS in ('11','12','13')";
		}
		$hasil = $this->db->query($query." ORDER BY INSERT_DATE DESC LIMIT 10");
		return $hasil;
	}

	public function create_event($data){
		$query = "INSERT INTO LOG_EVENT (EVENTTYPE, MESSAGE, REF1, REF2, REF3, USER, REMARK)
		    SELECT
		        EVENT AS EVENTTYPE,
		        DETAIL AS MESSAGE,
		        '".$data['REF1']."' AS REF1,
		        '".$data['REF2']."' AS REF2,
		        '".$data['REF3']."' AS REF3,
		        (SELECT NAMA FROM MST_USER WHERE ID = '".$data['USER']."') AS 'USER',
		        '".$data['REMARK']."' AS REMARK
		    FROM TB_EVENTTYPE
		    WHERE ID = '".$data['EVENTTYPE']."'";
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function validateAct($id){
		$query = "SELECT 1 FROM TB_RULE_ACT WHERE ID = '".$id."' AND ALLOWED_USERS LIKE '%".$_SESSION['logged_in']['role']."%'";
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function validateUrl($id){
		$query = "SELECT 1 FROM TB_RULE_URL WHERE ID = '".$id."' AND ALLOWED_ROLE LIKE '%".$_SESSION['logged_in']['role']."%'";
		$hasil = $this->db->query($query);
		return $hasil;
	}
}