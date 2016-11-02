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
		$this->load->view('login');	
	}

	public function check()
	{
		
		if($this->acessm->userIsLoggedIn()) {
			echo 'Logged In';
			if($this->acessm->userHasRole(1))
				$this->load->view('welcome', array('username' => $_SESSION['user']));
			else if($this->acessm->userHasRole(2)) {
				// echo 'Dear shopHos'
			}
		}
		else {
			$this->load->view('login');	
		}
	}
}
