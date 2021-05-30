<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
			parent:: __construct();
			$this->load->model('CRUD_global');
	}

	public function index(){
		if ($this->session->userdata('logged_in') == true){
			if($_SESSION['rl']=='administrator'){
				redirect('admin');
			}elseif ($_SESSION['rl']=='lo') {
				redirect('t');
			}elseif ($_SESSION['rl']=='cs') {
				redirect('sg');
			}else {
				$this->session->set_flashdata('err','Unknow role, please try again!');
				redirect('login/logout');
			}
		} else {
			$this->load->view('v_login');
		}
	}

	public function cek(){
		$un = $this->input->post('username');
		$pwdAdmin = md5('BookingPerpusAdministrator'.$this->input->post('password'));
		$pwdLO = md5('BookingPerpusLibraryOfficer'.$this->input->post('password'));
		$pwdCS = md5('BookingPerpusCollegeStudent'.$this->input->post('password'));
		$dataAdmin = $this->CRUD_global->read('admin', array('username' => $un));
		$dataLO = $this->CRUD_global->read('library_officer', array('username' => $un));
		$dataCS = $this->CRUD_global->read('college_student', array('username' => $un));
		$data="";

		if($dataAdmin){
			$data=$dataAdmin;
			$userdata = array(
        'id'	=> $data->id,
        'un' 	=> $data->username,
				'pwd'	=> $data->password,
				'fn'	=> $data->fullname,
				'rl'	=> 'administrator',
        'logged_in' => TRUE
			);
		} elseif ($dataLO) {
			$data=$dataLO;
			$userdata = array(
        'id'	=> $data->id,
        'un' 	=> $data->username,
				'pwd'	=> $data->password,
				'idn' => $data->id_number,
				'fn'	=> $data->fullname,
				'rl'	=> 'lo',
        'logged_in' => TRUE
			);
		}	elseif ($dataCS) {
			$data=$dataCS;
			$userdata = array(
        'id'	=> $data->id,
        'un' 	=> $data->username,
				'pwd'	=> $data->password,
				'idn' => $data->id_number,
				'fn'	=> $data->fullname,
				'rl'	=> 'cs',
        'logged_in' => TRUE
			);
		}

		if($data){
			if ($un==$data->username && ($pwdAdmin==$data->password || $pwdLO==$data->password || $pwdCS==$data->password)) {
				$this->session->set_userdata($userdata);
			} elseif ($un==$data->username && ($pwdAdmin==$data->password || $pwdLO!=$data->password || $pwdCS!=$data->password)) {
				$this->session->set_flashdata('err','Username and password didn\'t match, please try again!');
			}
		} else {
			$this->session->set_flashdata('err','Unknow user, please try again!');
		}
		redirect('login');
	}

	public function logout(){
		session_destroy();
		redirect('login');
	}
}
