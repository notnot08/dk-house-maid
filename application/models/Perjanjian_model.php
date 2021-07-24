<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perjanjian_model extends CI_Model {

	public function insert_perjanjian($data){
		$query = $this->db->insert('MST_SURAT_PERJANJIAN', $data);
		return $query;
	}

	public function get_perjanjian_detail($id){
		$hasil = $this->db->query("SELECT a.ID, a.NO, a.NOMOR_SURAT, a.NAMA_PJ, a.NIK_PJ, a.JABATAN_PJ, a.ALAMAT_PJ, a.NOMOR_SK, DATE_FORMAT(a.TANGGAL_SK, '%d %M %Y') as 'TANGGAL_SK', a.TANGGAL_SK as 'TANGGAL_SK2', a.ID_TKI, a.NEGARA_TUJUAN, a.ALAMAT, a.ID_DOKUMEN, DATE_FORMAT(a.TANGGAL_PENGESAHAN, '%d %M %Y') as 'TANGGAL_PENGESAHAN', a.TANGGAL_PENGESAHAN as 'TANGGAL_PENGESAHAN2', b.NAMA AS 'NAMA_TKI', b.NIK AS 'NIK_TKI', CONCAT_WS(' ', c.JALAN, CONCAT('RT. ', c.RT), CONCAT('RW. ', c.RW), CONCAT('KEL. ', c.KELURAHAN), CONCAT('KEC. ', c.KECAMATAN), c.KOTA, c.KD_POS, c.PROVINSI, c.DESA) AS ALAMAT_TKI, d.ID AS 'ID_JUSTIFIKASI', d.ID_PERJANJIAN, d.SURAT_PERJANJIAN_APPROVAL, f.NEGARA, h.NAMA as 'PIHAK1', 'PENYALUR' as 'JABATAN', h.NIK as 'NIK_PIHAK', h.ALAMAT as 'ALAMAT_PIHAK1', d.STATUS FROM MST_SURAT_PERJANJIAN a LEFT JOIN MST_TKI b ON a.ID_TKI = b.ID LEFT JOIN ALAMAT c ON b.ID = c.ID_TKI LEFT JOIN JUSTIFIKASI_PEKERJAAN d ON a.ID = d.ID_PERJANJIAN LEFT JOIN MST_LOWONGAN e ON d.ID_LOWONGAN = e.ID LEFT JOIN TB_NEGARA f ON e.NEGARA = f.CODE LEFT JOIN MST_USER g ON d.CREATED_BY = g.ID LEFT JOIN MST_PENYALUR h ON g.ID_PENYALUR = h.ID WHERE a.ID = '".$id."'");
		return $hasil;
	}

	public function generate_nomor_perjanjian($id, $data){
		$this->db->set($data);
		$this->db->where('ID', $id);
		return $this->db->update('MST_SURAT_PERJANJIAN');

	}

	public function getAllPerjanjian(){
		if ($_SESSION['logged_in']['role'] == '3') {
			$condition1 = "WHERE AND c.ID_GROUP = '".$_SESSION['logged_in']['group']."'";
		} else {
			$condition1 = '';
		}

		$hasil = $this->db->query("
			SELECT a.ID, a.NOMOR_SURAT, c.MAID_CODE, c.NAMA, b.SURAT_PERJANJIAN_APPROVAL, b.ID_PEKERJAAN, (SELECT PEKERJAAN FROM MST_PEKERJAAN WHERE ID = b.ID_PEKERJAAN) as 'PEKERJAAN', a.NAMA_PJ, DATE_FORMAT(a.TANGGAL_PENGESAHAN, '%d %M %Y') as 'TANGGAL_PENGESAHAN', b.ID as 'ID_JUSTIFIKASI' FROM MST_SURAT_PERJANJIAN a JOIN JUSTIFIKASI_PEKERJAAN b ON a.ID = b.ID_PERJANJIAN JOIN MST_TKI c ON b.ID_TKI = c.ID ".$condition1."");
		return $hasil;
	}

	public function searchPerjanjian($param, $value){
		if ($param == 'NOMOR') {
			$condition = 'a.NOMOR_SURAT';
		} elseif ($param == 'TANGGAL') {
			$condition = 'a.TANGGAL_PENGESAHAN';
		} elseif ($param == 'MAID_CODE') {
			$condition = 'c.MAID_CODE';
		} elseif ($param == 'TKI') {
			$condition = 'c.NAMA';
		} elseif ($param == 'PJ') {
			$condition = 'a.NAMA_PJ';
		}

		if ($_SESSION['logged_in']['role'] == '3') {
			$condition1 = "AND c.ID_GROUP = '".$_SESSION['logged_in']['group']."'";
		} else {
			$condition1 = '';
		}

		$hasil = $this->db->query("
			SELECT a.ID, a.NOMOR_SURAT, a.NAMA_PJ, a.TANGGAL_PENGESAHAN, c.MAID_CODE, c.NAMA, b.SURAT_PERJANJIAN_APPROVAL, (SELECT PEKERJAAN FROM MST_PEKERJAAN WHERE ID = b.ID_PEKERJAAN) as 'PEKERJAAN', (SELECT NAMA FROM MST_USER WHERE ID = b.APPROVED_BY_2) as 'APPROVED_BY', b.ID as 'ID_JUSTIFIKASI' FROM MST_SURAT_PERJANJIAN a JOIN JUSTIFIKASI_PEKERJAAN b ON a.ID = b.ID_PERJANJIAN JOIN MST_TKI c ON b.ID_TKI = c.ID WHERE ".$condition." LIKE '%".$value."%' ".$condition1."");
		return $hasil;
	}

	public function update_approval_perjanjian($param, $id_perjanjian, $data){
		// $nomor_surat = FALSE, $catatan = FALSE
		if ($param == 'SUBMIT') {
			/*$query = "UPDATE JUSTIFIKASI_PEKERJAAN SET SURAT_PERJANJIAN_APPROVAL = '3' WHERE ID_PERJANJIAN = '".$id_perjanjian."'";*/
			$this->db->set($data);
			$this->db->where('ID_PERJANJIAN', $id_perjanjian);
			return $this->db->update('JUSTIFIKASI_PEKERJAAN');
		} elseif ($param == 'APPROVE') {
			// $query = "UPDATE JUSTIFIKASI_PEKERJAAN SET SURAT_PERJANJIAN_APPROVAL = '1', APPROVED_BY_2 = '".$_SESSION['logged_in']['id_user']."', APPROVED_DATE_2 = CURRENT_TIMESTAMP() WHERE ID_PERJANJIAN = '".$id_perjanjian."'";
			$query1 = "UPDATE MST_SURAT_PERJANJIAN SET NOMOR_SURAT = CONCAT(NO, '/SPK', '".$data['NOMOR_SURAT']."') WHERE ID = '".$id_perjanjian."'";
			
			$data1 = array(
				'SURAT_PERJANJIAN_APPROVAL' => $data['SURAT_PERJANJIAN_APPROVAL'],
				'APPROVED_BY_2' => $data['APPROVED_BY_2'],
				'APPROVED_DATE_2' => $data['APPROVED_DATE_2']);

			$this->db->trans_start();
			$this->db->where('ID_PERJANJIAN', $id_perjanjian);
			$this->db->update('JUSTIFIKASI_PEKERJAAN', $data1);

			$this->db->query($query1);
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE) {
			    # Something went wrong.
				$this->db->trans_rollback();
				return FALSE;
			} 
			else {
			    # Everything is Perfect. 
			    # Committing data to the database.
				$this->db->trans_commit();
				return TRUE;
			}

		} elseif ($param == 'REJECT') {
			$data1 = array(
				'SURAT_PERJANJIAN_APPROVAL' => $data['SURAT_PERJANJIAN_APPROVAL'],
				'APPROVED_BY_2' => $data['APPROVED_BY_2'],
				'APPROVED_DATE_2' => $data['APPROVED_DATE_2']);
			$data2 = array(
				'CATATAN' => $data['CATATAN']);
			/*$query = "UPDATE JUSTIFIKASI_PEKERJAAN SET SURAT_PERJANJIAN_APPROVAL = '2', APPROVED_BY_2 = '".$_SESSION['logged_in']['id_user']."', APPROVED_DATE_2 = CURRENT_TIMESTAMP() WHERE ID_PERJANJIAN = '".$id_perjanjian."'";*/
			/*$query1 = "UPDATE MST_SURAT_PERJANJIAN SET CATATAN = '".$catatan."' WHERE ID = '".$id_perjanjian."'";*/
			/*$this->db->set($data1);
			$this->db->where('ID_PERJANJIAN', $id_perjanjian);
			$this->db->update('JUSTIFIKASI_PEKERJAAN');

			$this->db->set($data2);
			$this->db->where('ID', $id_perjanjian);
			$query2 = $this->db->update('MST_SURAT_PERJANJIAN');*/

			$this->db->trans_start();
			$this->db->where('ID_PERJANJIAN', $id_perjanjian);
			$this->db->update('JUSTIFIKASI_PEKERJAAN', $data1);

			$this->db->where('ID', $id_perjanjian);
			$this->db->update('MST_SURAT_PERJANJIAN', $data2);
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE) {
			    # Something went wrong.
				$this->db->trans_rollback();
				return FALSE;
			} 
			else {
			    # Everything is Perfect. 
			    # Committing data to the database.
				$this->db->trans_commit();
				return TRUE;
			}

			// $this->db->query($query1);
		}
		// $hasil = $this->db->query($query);
		// return $hasil;
	} 

	public function get_id_justifikasi($id_perjanjian){
		$hasil = $this->db->query("SELECT ID FROM JUSTIFIKASI_PEKERJAAN WHERE ID_PERJANJIAN = '".$id_perjanjian."'");
		return $hasil;
	}
}