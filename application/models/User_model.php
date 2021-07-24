<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function get_user($param = FALSE){
		if ($param == 'ACTIVE') {
			$condition = "FROM MST_USER WHERE STATUS = '1'";
		} else if ($param == 'NONACTIVE') {
			$condition = "FROM MST_USER WHERE STATUS = '0'";
		} else {
			$condition = "FROM MST_USER";
		}
		$hasil = $this->db->query("SELECT ID, USERNAME, NAMA, JENIS, STATUS ".$condition." ORDER BY UPDATE_DATE DESC");
		return $hasil;
	}

	public function get_user_detail($param){
		$hasil = $this->db->query("SELECT ID, USERNAME, NAMA, JENIS, STATUS, ID_GROUP FROM MST_USER WHERE ID = '".$param."' ORDER BY UPDATE_DATE DESC");
		return $hasil;
	}

	public function insert_user($data){
		$query = $this->db->insert('MST_USER', $data);
		return $query;
	}

	public function Changestatus_user($value, $id){
		$hasil = $this->db->query("UPDATE MST_USER SET STATUS = '".$value."' WHERE ID = '".$id."'");
		return $hasil;
	}

	public function update_user($id, $data){
		$query = $this->db->where('ID', $id)
		->set($data)
		->update('MST_USER');
		return $query;
	}

	public function resetPassword($value){
		$hasil = $this->db->query("UPDATE MST_USER SET PASSWORD = '575f5d6cef70204485e63956d4366546' WHERE USERNAME = '".$value."'");
		return $hasil;
	}
}