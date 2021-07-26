<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontrak_model extends CI_Model {

	public function insert_kontrak($data){
		$query = $this->db->insert('TB_KONTRAK', $data);
		return $query;
	}

	public function updateDokNull($id, $data){
		$this->db->trans_start();
			$this->db->where('ID', $id);
			$this->db->update('TB_KONTRAK', $data);
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
	}

	public function get_kontrak_detail($id){
		$hasil = $this->db->query("SELECT a.ID, a.NO, a.NO_KONTRAK, c.ID as 'ID_JUSTIFIKASI', c.KONTRAK_KERJA_APPROVAL, e.NIK as 'NIK_PIHAK2', e.NAMA as 'NAMA_PIHAK2', 
CONCAT(e.TEMPAT_LAHIR, ', ', DATE_FORMAT(e.TANGGAL_LAHIR, '%d %M %Y')) as 'LAHIR_PIHAK2', e.ALAMAT_LENGKAP AS 'ALAMAT_PIHAK2', 
a.ID_PERUSAHAAN, a.LAMA_KONTRAK, a.SATUAN_LAMA_KONTRAK, a.TANGGAL_MULAI, a.TANGGAL_SELESAI, DATE_FORMAT(a.TANGGAL_MULAI, '%d %M %Y') as 'TANGGAL_MULAI2', DATE_FORMAT(a.TANGGAL_SELESAI, '%d %M %Y') as 'TANGGAL_SELESAI2', a.WAKTU_KERJA, a.SATUAN_WAKTU_KERJA, a.JAM_PERHARI, 
a.JAM_PERMINGGU, a.ID_PEKERJAAN, b.PEKERJAAN, a.TGL_PEMBERIAN_GAJI, a.JUMLAH_GAPOK, FORMAT(a.JUMLAH_GAPOK, 0) as JUMLAH_GAPOKF, a.TUNJANGAN_KESEHATAN, FORMAT(a.TUNJANGAN_KESEHATAN, 0) as TUNJANGAN_KESEHATANF, a.TUNJANGAN_TRANSPORTASI, FORMAT(a.TUNJANGAN_TRANSPORTASI, 0) as TUNJANGAN_TRANSPORTASIF, a.UANG_KERAJINAN, FORMAT(a.UANG_KERAJINAN, 0) as UANG_KERAJINANF,
a.BIAYA_PENGOBATAN, FORMAT(a.BIAYA_PENGOBATAN, 0) as BIAYA_PENGOBATANF, a.CUTI_TAHUNAN, a.SYARAT_UNDURDIRI, a.WAKTU_UNDURDIRI, a.TGL_PENGESAHAN, DATE_FORMAT(a.TGL_PENGESAHAN, '%d %M %Y') as 'TGL_PENGESAHAN2', a.ID_DOKUMEN, a.PIHAK_PERTAMA, a.PIHAK_KEDUA, a.CATATAN,
h.ID as 'ID_PERUSAHAAN', h.NAMA_PERUSAHAAN as 'NAMA_PERUSAHAAN', h.ALAMAT as 'ALAMAT_PERUSAHAAN', i.JUMLAH_GAPOK as 'JUMLAH_GAPOK2', 
i.TUNJANGAN_KESEHATAN as 'TUNJANGAN_KESEHATAN2', i.TUNJANGAN_TRANSPORTASI as 'TUNJANGAN_TRANSPORTASI2', i.UANG_KERAJINAN as 'UANG_KERAJINAN2', 
i.BIAYA_PENGOBATAN as 'BIAYA_PENGOBATAN2', i.CUTI_TAHUNAN as 'CUTI_TAHUNAN2', i.LAMA_BEKERJA as 'LAMA_KONTRAK2', i.SATUAN_LAMA_BEKERJA as 
'SATUAN_LAMA_KONTRAK2', i.WAKTU_KERJA as 'WAKTU_KERJA2', i.SATUAN_WAKTU_KERJA as 'SATUAN_WAKTU_KERJA2', i.JAM_PERHARI as 'JAM_PERHARI2', 
i.JAM_PERMINGGU as 'JAM_PERMINGGU2' FROM TB_KONTRAK a LEFT JOIN TB_PEKERJAAN b ON a.ID_PEKERJAAN = b.ID LEFT JOIN JUSTIFIKASI_PEKERJAAN c 
ON a.ID = c.ID_KONTRAK LEFT JOIN MST_TKI e ON c.ID_TKI = e.ID LEFT JOIN TB_GROUP g ON e.ID_GROUP = 
g.ID LEFT JOIN MST_PERUSAHAAN h ON g.ID_PERUSAHAAN = h.ID LEFT JOIN TB_LOWONGAN i ON c.ID_LOWONGAN = i.ID WHERE a.ID = '".$id."'");
		return $hasil;
	}

	public function searchKontrak($param, $value){
		if ($param == 'NOMOR') {
			$condition = 'a.NO_KONTRAK';
		} elseif ($param == 'TANGGAL') {
			$condition = 'a.TGL_PENGESAHAN';
		} elseif ($param == 'MAID_CODE') {
			$condition = 'c.MAID_CODE';
		} elseif ($param == 'TKI') {
			$condition = 'c.NAMA';
		} elseif ($param == 'PIHAK1') {
			$condition = 'a.PIHAK_PERTAMA';
		}

		if ($_SESSION['logged_in']['role'] == '3') {
			$condition1 = "AND c.ID_GROUP = '".$_SESSION['logged_in']['group']."'";
		} else {
			$condition1 = '';
		}

		$hasil = $this->db->query("
			SELECT a.ID, a.NO_KONTRAK, c.MAID_CODE, c.NAMA, b.KONTRAK_KERJA_APPROVAL, (SELECT PEKERJAAN FROM TB_PEKERJAAN WHERE ID = a.ID_PEKERJAAN) as 'PEKERJAAN', a.ID_PEKERJAAN, a.PIHAK_PERTAMA, a.PIHAK_KEDUA, DATE_FORMAT(a.TGL_PENGESAHAN, '%d %M %Y') as 'TANGGAL_PENGESAHAN', b.ID as 'ID_JUSTIFIKASI' FROM TB_KONTRAK a JOIN JUSTIFIKASI_PEKERJAAN b ON a.ID = b.ID_KONTRAK JOIN MST_TKI c ON b.ID_TKI = c.ID WHERE ".$condition." LIKE '%".$value."%' ".$condition1."");
		return $hasil;
	}

	public function getAllKontrak(){
		if ($_SESSION['logged_in']['role'] == '3') {
			$condition1 = "WHERE AND c.ID_GROUP = '".$_SESSION['logged_in']['group']."'";
		} else {
			$condition1 = '';
		}

		$hasil = $this->db->query("
			SELECT a.ID, a.NO_KONTRAK, c.MAID_CODE, c.NAMA, b.KONTRAK_KERJA_APPROVAL, (SELECT PEKERJAAN FROM TB_PEKERJAAN WHERE ID = a.ID_PEKERJAAN) as 'PEKERJAAN', a.ID_PEKERJAAN, a.PIHAK_PERTAMA, a.PIHAK_KEDUA, DATE_FORMAT(a.TGL_PENGESAHAN, '%d %M %Y') as 'TANGGAL_PENGESAHAN', b.ID as 'ID_JUSTIFIKASI' FROM TB_KONTRAK a JOIN JUSTIFIKASI_PEKERJAAN b ON a.ID = b.ID_KONTRAK JOIN MST_TKI c ON b.ID_TKI = c.ID ".$condition1."");
		return $hasil;
	}

	public function generate_nomor_kontrak($id, $data){
		$this->db->set($data);
		$this->db->where('ID', $id);
		return $this->db->update('TB_KONTRAK');
	}

	public function update_approval_kontrak($param, $id_kontrak, $data){
		if ($param == 'SUBMIT') {
			/*$query = "UPDATE JUSTIFIKASI_PEKERJAAN SET KONTRAK_KERJA_APPROVAL = '3' WHERE ID_KONTRAK = '".$id_kontrak."'";*/

			$this->db->trans_start();
			$this->db->where('ID_KONTRAK', $id_kontrak);
			$this->db->update('JUSTIFIKASI_PEKERJAAN', $data);
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
		} elseif ($param == 'APPROVE') {
			/*$query = "UPDATE JUSTIFIKASI_PEKERJAAN SET KONTRAK_KERJA_APPROVAL = '1', APPROVED_BY_3 = '".$_SESSION['logged_in']['id_user']."', APPROVED_DATE_3 = CURRENT_TIMESTAMP() WHERE ID_KONTRAK = '".$id_kontrak."'";*/
			/*$query1 = "UPDATE TB_KONTRAK SET NO_KONTRAK = CONCAT(NO, '/SKK', '".$nomor_surat."') WHERE ID = '".$id_kontrak."'";
			$this->db->query($query1);*/

			$query1 = "UPDATE TB_KONTRAK SET NO_KONTRAK = CONCAT(NO, '/SKK', '".$data['NOMOR_SURAT']."') WHERE ID = '".$id_kontrak."'";
			
			$data1 = array(
				'KONTRAK_KERJA_APPROVAL' => $data['KONTRAK_KERJA_APPROVAL'],
				'APPROVED_BY_3' => $data['APPROVED_BY_3'],
				'APPROVED_DATE_3' => $data['APPROVED_DATE_3']);

			$this->db->trans_start();
			$this->db->where('ID_KONTRAK', $id_kontrak);
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
				'KONTRAK_KERJA_APPROVAL' => $data['KONTRAK_KERJA_APPROVAL'],
				'APPROVED_BY_3' => $data['APPROVED_BY_3'],
				'APPROVED_DATE_3' => $data['APPROVED_DATE_3']);
			$data2 = array(
				'CATATAN' => $data['CATATAN']);

			$this->db->trans_start();

			$this->db->where('ID_KONTRAK', $id_kontrak);
			$this->db->update('JUSTIFIKASI_PEKERJAAN', $data1);

			$this->db->where('ID', $id_kontrak);
			$this->db->update('TB_KONTRAK', $data2);

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

		}
	} 

	public function get_id_justifikasi($id_kontrak){
		$hasil = $this->db->query("SELECT ID FROM JUSTIFIKASI_PEKERJAAN WHERE ID_KONTRAK = '".$id_kontrak."'");
		return $hasil;
	}
}