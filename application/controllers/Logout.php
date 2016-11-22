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
		print_r($_POST);
         // if ($_POST['action'] == 'logout') echo 233;
		if(isset($_SESSION)) {
			$this->acessm->userIsLoggedIn();
			echo json_encode(array('status' => 0));
			return;
		}
		echo json_encode(array('status' => 1));

	}


	// public function logout()
	// {
	// 	$this->acessm->userIsLoggedIn();
	// }
}
