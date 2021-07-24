<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan_model extends CI_Model {

	public function get_penyalur_group(){
		$hasil = $this->db->query("SELECT a.ID, b.NAMA_PERUSAHAAN FROM TB_GROUP a JOIN MST_PERUSAHAAN b ON a.ID_PERUSAHAAN = b.ID WHERE KET = 'PENYALUR'");
		return $hasil;
	}

	public function get_all_perusahaan(){
		$hasil = $this->db->query("SELECT a.ID, a.NAMA_PERUSAHAAN, a.EMAIL, a.ALAMAT, a.STATUS, b.ID as 'ID_GROUP', b.KET, c.NAMA, c.INSERT_DATE FROM MST_PERUSAHAAN a LEFT JOIN TB_GROUP b ON a.ID = b.ID_PERUSAHAAN JOIN TB_USER c ON a.CREATED_BY = c.ID");
		return $hasil;
	}

	public function insert_com($data){
		$query = $this->db->insert('MST_PERUSAHAAN', $data);
		return $query;
	}

	public function procgenerateGroupPenyalur($id){
		$hasil = $this->db->query("INSERT INTO TB_GROUP (ID_PERUSAHAAN, KET) VALUES ('".$id."', 'PENYALUR')");
		return $hasil;
	}
}