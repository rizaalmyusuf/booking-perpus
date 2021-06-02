vp_book<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {
	public function __construct() {
			parent:: __construct();
			$this->load->model('BP_model');
			$this->updateBookPerDay();
	}

	public function index(){
		if ($this->session->userdata("logged_in") == true){
			if ($_SESSION['rl']=='administrator') {
				$this->session->set_flashdata('err','Anda bukan petugas.');
				redirect('admin');
			}elseif ($_SESSION['rl']=='lo') {
				$data['reservation']=$this->BP_model->queryRunning("SELECT reservation.*,college_student.fullname FROM reservation,college_student WHERE status!='OUT' AND cs_id=college_student.id GROUP BY reservation_code");
				$this->load->view('petugas/vp_konfirmasi',$data);
			}elseif ($_SESSION['rl']=='cs') {
				$this->session->set_flashdata('err','Anda bukan petugas.');
				redirect('mahasiswa');
			}else {
				$this->session->set_flashdata('err','Role tidak diketahui, coba lagi!');
				redirect('login/logout');
			}
		} else {
			$this->sessionTimedOut();
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
		$books=$this->BP_model->queryRunning("SELECT * FROM reservation WHERE check_in<='$day' AND status!='OUT'");
		foreach ($books as $row) {
			$this->BP_model->update('books',array('borrowed_by' => NULL),$row->book_id);
		}
		$this->BP_model->queryRunning("UPDATE reservation SET status='OUT' WHERE check_in<='$day' AND status!='OUT'",1,1);
	}

	public function konfirmasi($reservationCode,$msg){
		$this->sessionTimedOut();
		$this->updateBookPerDay();
		if ($msg=='in') {
			$this->BP_model->update('reservation',array('status' => 'IN'),$reservationCode,'reservation_code');
		}elseif ($msg=='out') {
			$books=$this->BP_model->read('reservation',array('reservation_code' => $reservationCode),1);
			foreach ($books as $row) {
				$this->BP_model->update('books',array('borrowed_by' => NULL),$row->book_id);
			}
			$this->BP_model->update('reservation',array('status' => 'OUT'),$reservationCode,'reservation_code');
		}
		$this->session->set_flashdata('succ','Reservasi telah dikonfirmasi.');
		redirect("petugas");
	}

	public function books(){
		$this->sessionTimedOut();
		$data['dataBooks'] = $this->BP_model->queryRunning('SELECT books.*,college_student.fullname FROM books LEFT JOIN college_student ON borrowed_by=college_student.id');
		$this->load->view('petugas/vp_book',$data);
	}

	public function addBookConfirm(){
		$this->sessionTimedOut();
		$cekBC=$this->BP_model->read('books',array('barcode' => $this->input->post('barcode')));
		if ($cekBC) {
			$this->session->set_flashdata('err','Barcode sudah dipakai.');
		}else{
			$data = array(
				'barcode' => $this->input->post('barcode'),
				'title' => $this->input->post('title'),
				'author' => $this->input->post('author'),
				'publisher' => $this->input->post('publisher'),
				'genre' => $this->input->post('genre'),
				'year_released' => $this->input->post('year')
			);
			$this->BP_model->create('books',$data);
			$this->session->set_flashdata('succ','Buku telah ditambahkan.');
		}
		redirect("petugas/books");
	}

	public function editBookConfirm($BookId){
		$this->sessionTimedOut();

		if ($this->input->post('bcOld')==$this->input->post('barcode')) {
			$bcNew=$this->input->post('bcOld');
		}else{
			$bcNew=$this->input->post('barcode');
			$cekBC=$this->BP_model->read('books',array('barcode' => $this->input->post('barcode')));
			if ($cekBC) {
				$this->session->set_flashdata('err','Barcode sudah dipakai.');
				redirect("petugas/books");
			}
		}

		$data = array(
			'barcode' => $bcNew,
			'title' => $this->input->post('title'),
			'author' => $this->input->post('author'),
			'publisher' => $this->input->post('publisher'),
			'genre' => $this->input->post('genre'),
			'year_released' => $this->input->post('year')
		);
		$this->BP_model->update('books',$data,$BookId);
		$this->session->set_flashdata('succ','Buku telah disunting.');
		redirect("petugas/books");
	}

	public function removeBookConfirm($DeleteId){
		$this->sessionTimedOut();
		$this->BP_model->delete('books',$DeleteId);
		$this->session->set_flashdata('succ','Buku telah dihapus.');
		redirect("petugas/books");
	}
}
