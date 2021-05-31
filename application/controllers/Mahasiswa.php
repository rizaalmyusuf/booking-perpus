<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	public function __construct() {
			parent:: __construct();
			$this->load->model('BP_model');
			$this->updateBookPerDay();
	}

	public function index(){
		if ($this->session->userdata("logged_in") == true){
			if ($_SESSION['rl']=='administrator') {
				$this->session->set_flashdata('err','Anda bukan mahasiswa.');
				redirect('admin');
			}elseif ($_SESSION['rl']=='lo') {
				$this->session->set_flashdata('err','Anda bukan mahasiswa.');
				redirect('petugas');
			}elseif ($_SESSION['rl']=='cs') {
				$data['books']=$this->BP_model->queryRunning("SELECT * FROM books");
				$data['reservation']=$this->BP_model->queryRunning("SELECT reservation.*,college_student.fullname FROM (reservation LEFT JOIN college_student ON reservation.cs_id=college_student.id) WHERE status!='OUT' GROUP BY reservation_code");
				$data['reservation_info']=$this->BP_model->queryRunning("SELECT reservation.reservation_code,reservation.check_in,college_student.fullname FROM reservation,college_student WHERE reservation.status='PENDING' AND reservation.cs_id=".$_SESSION['id']." GROUP BY reservation.reservation_code ORDER BY reservation.check_in",0);
				if ($data['reservation_info']) {
					$data['reserved_books']=$this->BP_model->queryRunning("SELECT books.*,reservation.reservation_code,reservation.check_in,reservation.book_id FROM reservation,books WHERE book_id=books.id AND status='PENDING' AND books.borrowed_by=".$_SESSION['id']." AND reservation_code='".$data['reservation_info']->reservation_code."'");
				}else {
					$data['reserved_books']=NULL;
				}
				$this->load->view('mahasiswa/vm_main',$data);
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

	public function updateBookPerDay(){
		date_default_timezone_set('Asia/Jakarta');
		$day=date('Y-m-d',strtotime('yesterday'));
		$books=$this->BP_model->read('reservation',array('check_in' => $day),1);
		foreach ($books as $row) {
			$this->BP_model->update('books',array('borrowed_by' => NULL),$row->book_id);
		}
		$this->BP_model->update('reservation',array('status' => 'OUT'),$day,'check_in');
	}

	public function createReservationConfirm($studentId) {
		$this->sessionTimedOut();
		if ($this->input->post('date')<date('Y-m-d') || $this->input->post('date')>date('Y-m-d',strtotime('+1 week'))) {
			$this->session->set_flashdata('err','Diluar batas tanggal yang disediakan!');
			redirect('mahasiswa');
		}elseif ($this->BP_model->read('reservation',array('check_in' => $this->input->post('date'), 'cs_id' => $_SESSION['id'], 'status' => 'PENDING'))) {
			$this->session->set_flashdata('err','Anda sudah melakukan reservasi di hari tersebut.');
			redirect('mahasiswa');
		}elseif ($this->BP_model->queryRunning("SELECT * FROM reservation WHERE check_in='".$this->input->post('date')."' AND status!='OUT'")->result_id->num_rows>=50) {
			$this->session->set_flashdata('err','Reservasi sudah penuh, coba dilain hari!');
			redirect('mahasiswa');
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
			$this->BP_model->create('reservation',$data);
			$this->BP_model->update('books',array('borrowed_by' => $_SESSION['id']),$this->input->post('book1'));
			if ($this->input->post('book2')) {
				$data['book_id']=$this->input->post('book2');
				$this->BP_model->create('reservation',$data);
				$this->BP_model->update('books',array('borrowed_by' => $_SESSION['id']),$this->input->post('book2'));
			}
			if ($this->input->post('book3')) {
				$data['book_id']=$this->input->post('book3');
				$this->BP_model->create('reservation',$data);
				$this->BP_model->update('books',array('borrowed_by' => $_SESSION['id']),$this->input->post('book3'));
			}
		}
		$this->session->set_flashdata('succ','Reservasi telah dibuat.');
		$this->session->set_flashdata('warn','Jangan lupa untuk datang tepat waktu! Reservasi akan terhapus otomatis jika pada hari itu anda tidak datang.');
		redirect('mahasiswa');
	}
}
