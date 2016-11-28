<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('acessm');
	}

	public function index()
	{
		print_r($_GET);
		$this->load->view('login');	
	}

	public function check()
	{
		if($this->acessm->userIsLoggedIn()) {
			if($this->acessm->userHasRole(1)) {
				// echo "string";
				//$this->load->view('welcome', array('username' => $_SESSION['user']));
				echo json_encode(array('status' => 1));
			}
			else if($this->acessm->userHasRole(2)) {
				// echo 'Dear shopHos'
				echo json_encode(array('status' => 2));
			}
			else if($this->acessm->userHasRole(3)) {
				echo json_encode(array('status' => 3));
			}
		}
		else {
			//$this->load->view('login');
			echo json_encode(array('status' => 101));	
		}
		// echo json_encode(array("status" => $_POST['user'] == 'root' ? 0 : 101));
	}


}
