<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_model extends CI_Model {

	public function insert_file($data){
		$query = $this->db->insert('DOKUMEN', $data);
		return $query;
	}
}