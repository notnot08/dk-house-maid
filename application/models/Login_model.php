<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function check_user($user){
		return $this->db->get_where('MST_USER', $user);
	}

	public function get_user_info($username){
		$this->db->select('ID, USERNAME, NAMA, JENIS, STATUS, AKTIVASI, ID_GROUP');
		$this->db->where('USERNAME', $username);
		return $this->db->get('MST_USER');
	}

	public function reset_password($id, $data){
		$query = $this->db->where('ID', $id)
		->set($data)
		->update('MST_USER');
		return $query;
	}
}