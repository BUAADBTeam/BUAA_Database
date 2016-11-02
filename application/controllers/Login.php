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
		// if($this->acessm->databaseContainsUser($_POST['username'], $_POST['password'])) {
		if($this->acessm->userIsLoggedIn()) {
			$this->load->view('welcome', array('username' => $_POST['user']));
		}
		else {
			$this->load->view('login');	
		}
	}
}
