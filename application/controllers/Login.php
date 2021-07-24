<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->model('Log_model');
	}

	public function index() {
		if(isset($_SESSION['logged_in']['username'])){
			if ($_SESSION['logged_in']['login'] == 'LOGGED' && $_SESSION['logged_in']['aktivasi'] == '0') {
				redirect('Login/aktivasi');
			} elseif ($_SESSION['logged_in']['login'] == 'LOGGED' && $_SESSION['logged_in']['aktivasi'] == '1') {
				redirect(base_url('Main'));
			}
		} else {
			$this->load->view('login/v_login');
		}
	}

	public function do_login(){
		$username = $this->input->post('username');
		
		$data = array(
			'USERNAME' => $username,
			'PASSWORD' => md5($this->input->post('password')));

		$cek = $this->Login_model->check_user($data)->num_rows();

		if ($cek > 0) {
			$pengguna = $this->Login_model->get_user_info($username);
			$row1 = $pengguna->row_array();

			if ($row1['STATUS'] == '0') {
				$this->session->set_flashdata('login_failed', '<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> Akun tidak aktif, kontak administrator untuk mengaktifkan akun
					</div>');
				redirect('Login');
			} else {
				if ($row1['JENIS'] == '0') {
					$jenis_lengkap = 'SUPER ADMIN';
				} elseif ($row1['JENIS'] == '1') {
					$jenis_lengkap = 'ADMIN';
				} elseif ($row1['JENIS'] == '2') {
					$jenis_lengkap = 'MANAGER';
				} elseif ($row1['JENIS'] == '3') {
					$jenis_lengkap = 'PENYALUR';
				}

				$data_session = array(
					'id_user' => $row1['ID'],
					'username' => $row1['USERNAME'],
					'nama' => $row1['NAMA'],
					'role' => $row1['JENIS'],
					'role_lengkap' => $jenis_lengkap,
					'group' => $row1['ID_GROUP'],
					'aktivasi' => $row1['AKTIVASI'],
					'login' => 'LOGGED');
				$this->session->set_userdata('logged_in', $data_session);
				$data_log = array(
					'ID_USER' => $_SESSION['logged_in']['id_user'],
					'JENIS' => '1',
					'CATATAN' => 'SUKSES');
				$this->Log_model->insert_log($data_log);
				if ($row1['AKTIVASI'] == '0') {
					redirect('Login/aktivasi');
				} else {
					redirect('Main');
				}
			}
		} 
		else
		{
			$this->session->set_flashdata('login_failed', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon fas fa-ban"></i> Username atau Password salah
				</div>');
			redirect('Login');

		}

	}

	public function aktivasi($param = FALSE){
		if(!isset($_SESSION['logged_in']['username'])){
			redirect('Login');
		} elseif ($_SESSION['logged_in']['aktivasi'] == '1') {
			redirect('Main');
		} else {
			$this->load->view('login/v_aktivasi');
		}
	}

	public function do_reset(){
		$id_user = $_SESSION['logged_in']['id_user'];
		$password1 = md5($this->input->post('resetpass'));
		$password2 = md5($this->input->post('resetpass2'));
		if ($password1 == $password2) {
			$_SESSION['logged_in']['aktivasi'] = '1';
			$data = array(
				'PASSWORD' => $password2,
				'AKTIVASI' => '1');
			$result = $this->Login_model->reset_password($id_user, $data);
			if ($result == TRUE) {
				$this->session->set_flashdata('dashboard', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-check"></i> Sukses reset password
					</div>');
				$data_log = array(
					'ID_USER' => $id_user,
					'JENIS' => '4',
					'AKSI' => 'UPDATE',
					'CATATAN' => 'SUKSES');
				$this->Log_model->insert_log($data_log);
				redirect('Main');
			} else {
				$this->session->set_flashdata('dashboard', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fas fa-ban"></i> Gagal reset password
					</div>');
				$data_log = array(
					'ID_USER' => $id_user,
					'JENIS' => '4',
					'CATATAN' => 'GAGAL');
				$this->Log_model->insert_log($data_log);
				redirect('Main');
			}
		} else {
			$this->session->set_flashdata('login_failed', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon fas fa-ban"></i> Password tidak sama, silahkan ulangi lagi
				</div>');
			redirect('Login/aktivasi');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('Login'));
	}
	
}