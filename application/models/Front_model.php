<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_model extends CI_Model {

	public function getContent($param){
		if ($param == 'ABOUT-US') {
			$query = "SELECT TITLE, CONTENT, (SELECT NAMA FROM MST_USER WHERE ID = CREATED_BY) as 'USER' FROM MST_SETTING WHERE TYPE = 'ABOUT-US'";
		} elseif ($param == 'ABOUT-US-DETAIL') {
			$query = "SELECT TITLE, CONTENT, (SELECT NAMA FROM MST_USER WHERE ID = CREATED_BY) as 'USER' FROM MST_SETTING WHERE TYPE = 'ABOUT-US-DETAIL'";
		}
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function getTopPengumuman(){
		$query = "SELECT ID, JUDUL, CONCAT(SUBSTRING(DESKRIPSI, 1, 100), '...') as 'DESKRIPSI', PIC, DATE_FORMAT(INSERT_DATE, '%d %M %Y %H.%i.%s') as 'INSERT_DATE', DATE_FORMAT(INSERT_DATE, '%M') as 'INSERT_DATE_MONTH', DATE_FORMAT(INSERT_DATE, '%d') as 'INSERT_DATE_DATE', (SELECT NAMA FROM MST_USER WHERE ID = CREATED_BY) as 'USER' FROM MST_KONTEN WHERE JENIS_KONTEN = '1' AND STATUS = '1' AND INSERT_DATE IS NOT NULL ORDER BY INSERT_DATE DESC";
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function getDetPengumuman($id){
		$query = "SELECT ID, JUDUL, DESKRIPSI, PIC, DATE_FORMAT(INSERT_DATE, '%d %M %Y %H.%i.%s') as 'INSERT_DATE', (SELECT NAMA FROM MST_USER WHERE ID = CREATED_BY) as 'USER' FROM MST_KONTEN WHERE ID = '".$id."' AND STATUS = '1'";
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function getSumPengumuman(){
		$query = "SELECT ID, JUDUL, DATE_FORMAT(INSERT_DATE, '%d %M %Y') as 'INSERT_DATE' FROM MST_KONTEN WHERE JENIS_KONTEN = '1' AND STATUS = '1' ORDER BY INSERT_DATE DESC LIMIT 10";
		$hasil = $this->db->query($query);
		return $hasil;
	}


	public function getTopKarir(){
		$query = "SELECT ID, JUDUL, CONCAT(SUBSTRING(DESKRIPSI, 1, 100), '...') as 'DESKRIPSI', PIC, DATE_FORMAT(INSERT_DATE, '%d %M %Y %H.%i.%s') as 'INSERT_DATE', DATE_FORMAT(INSERT_DATE, '%M') as 'INSERT_DATE_MONTH', DATE_FORMAT(INSERT_DATE, '%d') as 'INSERT_DATE_DATE', (SELECT NAMA FROM MST_USER WHERE ID = CREATED_BY) as 'USER' FROM MST_KONTEN WHERE JENIS_KONTEN = '2' AND STATUS = '1' AND INSERT_DATE IS NOT NULL ORDER BY INSERT_DATE DESC";
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function getDetKarir($id){
		$query = "SELECT ID, JUDUL, DESKRIPSI, PIC, DATE_FORMAT(INSERT_DATE, '%d %M %Y %H.%i.%s') as 'INSERT_DATE', (SELECT NAMA FROM MST_USER WHERE ID = CREATED_BY) as 'USER' FROM MST_KONTEN WHERE ID = '".$id."' AND STATUS = '1'";
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function getSumKarir(){
		$query = "SELECT ID, JUDUL, DATE_FORMAT(INSERT_DATE, '%d %M %Y') as 'INSERT_DATE' FROM MST_KONTEN WHERE JENIS_KONTEN = '2' AND STATUS = '1' ORDER BY INSERT_DATE DESC LIMIT 10";
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function getTopBerita(){
		$query = "SELECT ID, JUDUL, CONCAT(SUBSTRING(DESKRIPSI, 1, 100), '...') as 'DESKRIPSI', PIC, DATE_FORMAT(INSERT_DATE, '%d %M %Y %H.%i.%s') as 'INSERT_DATE', DATE_FORMAT(INSERT_DATE, '%M') as 'INSERT_DATE_MONTH', DATE_FORMAT(INSERT_DATE, '%d') as 'INSERT_DATE_DATE', (SELECT NAMA FROM MST_USER WHERE ID = CREATED_BY) as 'USER' FROM MST_KONTEN WHERE JENIS_KONTEN = '3' AND STATUS = '1' AND INSERT_DATE IS NOT NULL ORDER BY INSERT_DATE DESC";
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function getDetBerita($id){
		$query = "SELECT ID, JUDUL, DESKRIPSI, PIC, DATE_FORMAT(INSERT_DATE, '%d %M %Y %H.%i.%s') as 'INSERT_DATE', (SELECT NAMA FROM MST_USER WHERE ID = CREATED_BY) as 'USER' FROM MST_KONTEN WHERE ID = '".$id."' AND STATUS = '1'";
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function getSumBerita(){
		$query = "SELECT ID, JUDUL, DATE_FORMAT(INSERT_DATE, '%d %M %Y') as 'INSERT_DATE' FROM MST_KONTEN WHERE JENIS_KONTEN = '3' AND STATUS = '1' ORDER BY INSERT_DATE DESC LIMIT 10";
		$hasil = $this->db->query($query);
		return $hasil;
	}
}