<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GenerateID_model extends CI_Model {

	public function generateid(){
		/*$char = "0123456789";
	    $char = str_shuffle($char);
	    $length = 11;
	    for($i = 0, $rand = '', $l = strlen($char) - 1; $i < $length; $i ++) {
	        $rand .= $char{mt_rand(0, $l)};
	    }
	    return $rand;*/

	    $length = 11;
		$characters = '0123456789';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

	function generatebulantahun() {
		setlocale(LC_TIME, 'id_ID.utf8');
		$hariIni = new DateTime();

		$bulan = strftime('%m', $hariIni->getTimestamp());
		$number = $bulan;
		$tahun = strftime('%Y', $hariIni->getTimestamp());
	    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
	    $returnValue = '';
	    while ($number > 0) {
	        foreach ($map as $roman => $int) {
	            if($number >= $int) {
	                $number -= $int;
	                $returnValue .= $roman;
	                break;
	            }
	        }
	    }
	    $hasil = $returnValue.'/'.$tahun;
	    return $hasil;
	}

	public function get_negara_list(){
		$hasil = $this->db->query("SELECT NEGARA, CODE FROM TB_NEGARA ORDER BY NEGARA ASC");
		return $hasil;
	}
}