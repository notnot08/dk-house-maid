<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Front_model');
		$this->load->model('Log_model');
	}

	public function index() {
		$array['about_us'] = $this->Front_model->getContent('ABOUT-US');
		$array['about_us_detail'] = $this->Front_model->getContent('ABOUT-US-DETAIL');
		
		$this->load->view('front/v_header');
		$this->load->view('front/v_main', $array);
		$this->load->view('front/v_footer');
	}

	public function karir($param = FALSE, $id = FALSE) {
		$this->load->view('front/v_header');
		if ($param == 'detail') {
			$array['det_karir'] = $this->Front_model->getDetKarir($id);
			$this->load->view('front/karir/v_detail_karir', $array);
		} else {
			$array['sum_karir'] = $this->Front_model->getSumKarir();
			$array['karir'] = $this->Front_model->getTopKarir();
			$this->load->view('front/karir/v_all_karir', $array);
		}
		$this->load->view('front/v_footer');
	}

	public function pengumuman($param = FALSE, $id = FALSE) {
		$this->load->view('front/v_header');
		if ($param == 'detail') {
			$array['det_pengumuman'] = $this->Front_model->getDetPengumuman($id);
			$this->load->view('front/pengumuman/v_detail_pengumuman', $array);
		} else {
			$array['sum_pengumuman'] = $this->Front_model->getSumPengumuman();
			$array['pengumuman'] = $this->Front_model->getTopPengumuman();
			$this->load->view('front/pengumuman/v_all_pengumuman', $array);
		}
		$this->load->view('front/v_footer');
	}

	public function berita($param = FALSE, $id = FALSE) {
		$this->load->view('front/v_header');
		if ($param == 'detail') {
			$array['det_berita'] = $this->Front_model->getDetBerita($id);
			$this->load->view('front/berita/v_detail_berita', $array);
		} else {
			$array['sum_berita'] = $this->Front_model->getSumBerita();
			$array['berita'] = $this->Front_model->getTopBerita();
			$this->load->view('front/berita/v_all_berita', $array);
		}
		$this->load->view('front/v_footer');
	}
}