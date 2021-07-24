<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function check_user($user){
		return $this->db->get_where('TB_USER', $user);
	}

	public function get_user_info($username){
		$this->db->select('ID, USERNAME, NAMA, JENIS, STATUS, AKTIVASI, ID_GROUP');
		$this->db->where('USERNAME', $username);
		return $this->db->get('TB_USER');
	}

	public function reset_password($id, $data){
		$query = $this->db->where('ID', $id)
		->set($data)
		->update('TB_USER');
		return $query;
	}
}