<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('testm');
		$this->load->model('acessm');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function check()
	{
		if($this->acessm->databaseContainsUser($_POST['username'], $_POST['password'])) {
			$this->load->view('welcome', array('username' => $_POST['username']));
		}
		else {
			$this->load->view('login');	
		}
	}
}
