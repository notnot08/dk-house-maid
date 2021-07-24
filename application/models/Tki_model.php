<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tki_model extends CI_Model {

	public function getTkiDetail($id){
		return $query = $this->db->select('a.ID, a.NAMA, a.NIK, a.MAID_CODE, a.PASSPORT, a.TEMPAT_LAHIR, a.TANGGAL_LAHIR')
			->from('MST_TKI a')
			->where('a.ID', $id)->get();
	}

	public function getValidateJustifikasi($id){
		$query = "SELECT CASE WHEN a.APPROVE = '1' AND b.STATUS = '0' THEN '1' WHEN a.APPROVE = '1' AND b.STATUS is null THEN '1' WHEN a.APPROVE = '2' THEN '2' ELSE '0' END AS APPROVAL FROM MST_TKI a LEFT JOIN JUSTIFIKASI_PEKERJAAN b ON a.ID = b.ID_TKI WHERE a.ID = '".$id."' ORDER BY APPROVAL DESC";
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function get_timeline($id){
		$hasil = $this->db->query("SELECT MESSAGE, USER, DATE_FORMAT(INSERT_DATE, '%d %M %Y %H.%i.%s') as 'INSERT_DATE', REMARK FROM LOG_EVENT WHERE REF1 = '".$id."' ORDER BY INSERT_DATE DESC");
		return $hasil;
	}

	public function get_tki_list($param = FALSE){
		if ($param == 'UNAPPROVED') {
			$condition = "WHERE a.APPROVE != '1'";
		} else {
			if ($_SESSION['logged_in']['role'] == '3') {
				$condition = "WHERE a.ID_GROUP = '".$_SESSION['logged_in']['group']."'";
			} else {
				$condition = "";
			}
		}
		$hasil = $this->db->query("SELECT a.ID, c.NAMA_PERUSAHAAN, CONCAT('xxxxxxxxxxxx', SUBSTRING(a.NIK, 13,16)) as 'NIK', a.MAID_CODE, a.NAMA, a.APPROVE, CASE WHEN a.APPROVE = '0' THEN 'NOT APPROVED' WHEN a.APPROVE = '1' THEN 'APPROVED' WHEN a.APPROVE = '2' THEN 'REJECTED' END AS STATUS_PROGRESS FROM MST_TKI a JOIN MST_GROUP b ON a.ID_GROUP = b.ID JOIN MST_PERUSAHAAN c ON b.ID_PERUSAHAAN = c.ID ".$condition);
		return $hasil;
	}

	public function get_tki_detail($param, $id){
		if ($param == 'DETAIL_TKI') {
			$query = "SELECT a.ID, a.NIK, a.MAID_CODE, a.NAMA, a.PASSPORT, a.TEMPAT_LAHIR, a.JENIS_KELAMIN, a.TANGGAL_LAHIR, a.TINGGI_BADAN, a.BERAT_BADAN, a.KEWARGANEGARAAN, a.NEGARA_ASAL, a.AGAMA, a.JML_SAUDARA, a.ANAK_KE, a.STATUS_NIKAH, a.JML_ANAK, a.PENDIDIKAN_TERAKHIR, a.APPROVE, a.CATATAN, a.APPROVED_BY, CASE WHEN a.APPROVE = '0' THEN 'NOT APPROVED' WHEN a.APPROVE = '1' THEN 'APPROVED' WHEN a.APPROVE = '2' THEN 'REJECTED' END AS 'STATUS_APPROVE', c.NAMA as 'NAMA_PENGAJU', a.INSERT_DATE, e.NAMA_PERUSAHAAN FROM MST_TKI a JOIN ALAMAT b ON a.ID = b.ID_TKI JOIN MST_USER c ON a.CREATED_BY = c.ID JOIN MST_GROUP d ON c.ID_GROUP = d.ID JOIN MST_PERUSAHAAN e ON d.ID_PERUSAHAAN = e.ID WHERE a.ID = '".$id."' LIMIT 1";
		} elseif ($param == 'ALAMAT') {
			$query = "SELECT b.ID, b.JENIS_ALAMAT, b.JALAN, b.RT, b.RW, b.KECAMATAN, b.KELURAHAN, b.KOTA, b.KD_POS, b.PROVINSI, b.DESA, b.JENIS_ALAMAT, CASE WHEN b.STATUS = '1' THEN 'SESUAI KTP' WHEN b.STATUS = '2' THEN 'TEMPAT TINGGAL SAAT INI' END AS 'DJENIS_ALAMAT' FROM ALAMAT b WHERE b.ID_TKI = '".$id."' AND STATUS = '1'";
		}
		$hasil = $this->db->query($query);
		return $hasil;
	}

	public function get_tki_kualifikasi($id){
		$hasil = $this->db->query("SELECT * FROM(SELECT a.ID, a.ID_KUALIFIKASI, b.ID AS 'ID_PERTANYAAN', b.PERTANYAAN, b.JENIS, b.CATATAN, 
			CASE WHEN a.JAWABAN = 'Y' THEN 'IYA' WHEN a.JAWABAN = 'N' THEN 'TIDAK' END AS 'JAWABAN', a.KETERANGAN FROM KUALIFIKASI a  JOIN MST_KUALIFIKASI b ON a.ID_KUALIFIKASI = b.ID WHERE b.STATUS = '1' AND a.ID_TKI = '".$id."' UNION ALL SELECT '-', '-', ID, PERTANYAAN, JENIS, CATATAN, '-', '-' FROM MST_KUALIFIKASI WHERE STATUS = '1') AS A GROUP BY ID_PERTANYAAN ORDER BY ID DESC");
		return $hasil;
	}

	public function get_tki_dokumen($id){
		$hasil = $this->db->query("SELECT * FROM (SELECT a.ID, a.ID_JENIS_DOK, b.NAMA_DOKUMEN, a.FILE, a.PATH FROM DOKUMEN a JOIN MST_JENIS_DOK b ON a.ID_JENIS_DOK = b.ID WHERE a.ID_TKI = '".$id."' AND a.STATUS = '1' UNION ALL SELECT '-', ID, NAMA_DOKUMEN, '-', '-' FROM MST_JENIS_DOK WHERE JENIS = '1') AS A GROUP BY ID_JENIS_DOK ORDER BY NAMA_DOKUMEN ASC");
		return $hasil;
	}
}