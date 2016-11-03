<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('acessm');
		$this->load->model('mailerm');
	}

	public function index()
	{
		$this->load->view('register');	
	}

	public function checkUser()
	{
		return isset($_POST['username']) ? $this->acessm->checkInfo($_POST['username'], 'user') : False;
	}

	public function checkEmail()
	{
		return isset($_POST['email']) ? $this->acessm->checkInfo($_POST['email']) : False;
	}

	public function registerUser()
	{
		$token = '';
		if(isset($_POST['action']) && $_POST['action'] == 'register') {
			if($this->acessm->addUser($_POST, $token)) {
				print_r($token);
				$this->mailerm->sendVerifyMail($_POST['username'], $_POST['email'], $token);
			}
		}
	}

	public function verify()
	{
		if($this->acessm->verify($_GET['username'], $_GET['token']))
			echo "fuck";
	}
}
