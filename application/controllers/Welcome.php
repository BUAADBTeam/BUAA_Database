<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('acessm');
	}
	public function index()
	{
		// $a = array();
		// echo "$this->load";
		isset($_SESSION) or session_start();
		$this->load->view('welcome', isset($_SESSION['user']) ? array('username' => $_SESSION['user']) : array());
	}

	public function getP()
	{
		if (!$this->acessm->userIsLoggedIn()) {
			echo json_encode(array('status' => -1));
			return;
		}
		$id = $_SESSION['userid'];
		$res['src'] = $this->acessm->getPhoto($id);
		$res['status'] = 0;
		echo json_encode($res);
	}
}
