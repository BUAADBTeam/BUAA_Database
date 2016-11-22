<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('acessm');
	}

	public function index()
	{
		if(isset($_SESSION)) {
			$this->acessm->userIsLoggedIn();
			echo json_encode(array('status' => 0));
		}
		echo json_encode(array('status' => 1));

	}


	// public function logout()
	// {
	// 	$this->acessm->userIsLoggedIn();
	// }
}
