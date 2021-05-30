<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class T extends CI_Controller {
	public function __construct() {
			parent:: __construct();
			$this->load->model('CRUD_global');
			$this->updateBookPerDay();
	}

	public function index(){
		if ($this->session->userdata("logged_in") == true){
			if ($_SESSION['rl']=='administrator') {
				$this->session->set_flashdata('err','Anda bukan petugas.');
				redirect('admin');
			}elseif ($_SESSION['rl']=='lo') {
				$data['reservation']=$this->CRUD_global->queryRunning("SELECT reservation.*,college_student.fullname FROM reservation,college_student WHERE status!='OUT' GROUP BY reservation_code");
				$this->load->view('t/vp_konfirmasi',$data);
			}elseif ($_SESSION['rl']=='cs') {
				$this->session->set_flashdata('err','Anda bukan petugas.');
				redirect('sg');
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
		$books=$this->CRUD_global->read('reservation',array('check_in' => $day),1);
		foreach ($books as $row) {
			$this->CRUD_global->update('books',array('borrowed_by' => NULL),$row->book_id);
		}
		$this->CRUD_global->update('reservation',array('status' => 'OUT'),$day,'check_in');
	}

	public function konfirmasi($reservationCode,$msg){
		$this->sessionTimedOut();
		$this->updateBookPerDay();
		if ($msg=='in') {
			$this->CRUD_global->update('reservation',array('status' => 'IN'),$reservationCode,'reservation_code');
		}elseif ($msg=='out') {
			$books=$this->CRUD_global->read('reservation',array('reservation_code' => $reservationCode),1);
			foreach ($books as $row) {
				$this->CRUD_global->update('books',array('borrowed_by' => NULL),$row->book_id);
			}
			$this->CRUD_global->update('reservation',array('status' => 'OUT'),$reservationCode,'reservation_code');
		}
		$this->session->set_flashdata('succ','Reservasi telah dikonfirmasi.');
		redirect("t");
	}

	public function books(){
		$this->sessionTimedOut();
		$data['dataBooks'] = $this->CRUD_global->queryRunning('SELECT books.*,college_student.fullname FROM books LEFT JOIN college_student ON borrowed_by=college_student.id');
		$this->load->view('t/vt_projects',$data);
	}

	public function addBookConfirm(){
		$this->sessionTimedOut();
		$data = array(
			'barcode' => $this->input->post('barcode'),
			'title' => $this->input->post('title'),
			'author' => $this->input->post('author'),
			'publisher' => $this->input->post('publisher'),
			'genre' => $this->input->post('genre'),
			'year_released' => $this->input->post('year')
		);
		$this->CRUD_global->create('books',$data);
		$this->session->set_flashdata('succ','Buku telah ditambahkan.');
		redirect("t/books");
	}

	public function editBookConfirm($BookId){
		$this->sessionTimedOut();

		if ($this->input->post('bcOld')==$this->input->post('barcode')) {
			$bcNew=$this->input->post('bcOld');
		}else{
			$bcNew=$this->input->post('barcode');
			$cekBC=$this->CRUD_global->read('books',array('barcode' => $this->input->post('barcode')));
			if ($cekBC) {
				$this->session->set_flashdata('err','Barcode sudah dipakai.');
				redirect("t/books");
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
		$this->CRUD_global->update('books',$data,$BookId);
		$this->session->set_flashdata('succ','Buku telah disunting.');
		redirect("t/books");
	}

	public function removeBookConfirm($DeleteId){
		$this->sessionTimedOut();
		$this->CRUD_global->delete('books',$DeleteId);
		$this->session->set_flashdata('succ','Buku telah dihapus.');
		redirect("t/books");
	}
}
