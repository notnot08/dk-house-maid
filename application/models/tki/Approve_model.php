<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approve_model extends CI_Model {

	public function approve_tki($id, $data){
		$query1 = "UPDATE MST_TKI SET MAID_CODE = CONCAT(JENIS_KELAMIN, ID) WHERE ID = '".$id."'";
		$this->db->trans_start();
		if ($data['APPROVE'] == '1') {
			$this->db->query($query1);
		}
		$this->db->where('ID', $id);
		$this->db->update('MST_TKI', $data);
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
}