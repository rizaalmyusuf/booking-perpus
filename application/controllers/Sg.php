<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sg extends CI_Controller {
	public function __construct() {
			parent:: __construct();
			$this->load->model('CRUD_global');
	}

	public function index(){
		if ($this->session->userdata("logged_in") == true){
			if ($_SESSION['rl']=='administrator') {
				$this->session->set_flashdata('err','Anda bukan mahasiswa.');
				redirect('admin');
			}elseif ($_SESSION['rl']=='lo') {
				$this->session->set_flashdata('err','Anda bukan mahasiswa.');
				redirect('t');
			}elseif ($_SESSION['rl']=='cs') {
				$data['books']=$this->CRUD_global->queryRunning("SELECT * FROM books");
				$data['reservation']=$this->CRUD_global->queryRunning("SELECT reservation.*,college_student.fullname FROM (reservation LEFT JOIN college_student ON reservation.cs_id=college_student.id) WHERE status!='OUT' GROUP BY reservation_code");
				$data['reservation_info']=$this->CRUD_global->queryRunning("SELECT reservation.reservation_code,reservation.check_in,college_student.fullname FROM reservation,college_student WHERE reservation.status='PENDING' AND reservation.cs_id=".$_SESSION['id']." GROUP BY reservation.reservation_code ORDER BY reservation.check_in",0);
				$data['reserved_books']=$this->CRUD_global->queryRunning("SELECT books.*,reservation.reservation_code,reservation.check_in,reservation.book_id FROM reservation,books WHERE book_id=books.id AND status='PENDING' AND books.borrowed_by=".$_SESSION['id']." AND reservation_code='".$data['reservation_info']->reservation_code."'");
				$this->load->view('sg/vsg_projects',$data);
			}else {
				$this->session->set_flashdata('err','Role tidak diketahui, coba lagi!');
				redirect('login/logout');
			}
		} else {
			$this->session->set_flashdata('err','Masuk terlebih dahulu!');
			redirect('login');
		}
	}

	public function sessionTimedOut(){
		if ($this->session->userdata("logged_in") == false){
			$this->session->set_flashdata('err','Masuk terlebih dahulu!');
			redirect('login');
		}
	}

	public function createReservationConfirm($studentId) {
		$this->sessionTimedOut();
		if ($this->input->post('date')<date('Y-m-d') || $this->input->post('date')>date('Y-m-d',strtotime('+1 week'))) {
			$this->session->set_flashdata('err','Diluar batas tanggal yang disediakan!');
			redirect('sg');
		}elseif ($this->CRUD_global->read('reservation',array('check_in' => $this->input->post('date'), 'cs_id' => $_SESSION['id'], 'status' => 'PENDING'))) {
			$this->session->set_flashdata('err','Anda sudah melakukan reservasi di hari tersebut.');
			redirect('sg');
		}elseif ($this->CRUD_global->queryRunning("SELECT * FROM reservation WHERE check_in='".$this->input->post('date')."' AND status!='OUT'")->result_id->num_rows>=50) {
			$this->session->set_flashdata('err','Reservasi sudah penuh, coba dilain hari!');
			redirect('sg');
		}
		else{
			date_default_timezone_set("Asia/Jakarta");
			$data = array(
				'reservation_code' => date('DymdHis'),
				'check_in' => $this->input->post('date'),
				'cs_id' => $studentId,
				'book_id' => $this->input->post('book1'),
				'timestamp' => date('Y-m-d'),
				'status' => 'PENDING'
			);
			$this->CRUD_global->create('reservation',$data);
			$this->CRUD_global->update('books',array('borrowed_by' => $_SESSION['id']),$this->input->post('book1'));
			if ($this->input->post('book2')) {
				$data['book_id']=$this->input->post('book2');
				$this->CRUD_global->create('reservation',$data);
				$this->CRUD_global->update('books',array('borrowed_by' => $_SESSION['id']),$this->input->post('book2'));
			}
			if ($this->input->post('book3')) {
				$data['book_id']=$this->input->post('book3');
				$this->CRUD_global->create('reservation',$data);
				$this->CRUD_global->update('books',array('borrowed_by' => $_SESSION['id']),$this->input->post('book3'));
			}
		}
		$this->session->set_flashdata('succ','Reservasi telah dibuat.');
		$this->session->set_flashdata('warn','Jangan lupa untuk datang tepat waktu! Reservasi akan terhapus otomatis jika pada hari itu anda tidak datang.');
		redirect('sg');
	}
}
