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
		getRawPost();
		 if(isset($_POST['username']) ? $this->acessm->checkInfo($_POST, 'user') : False) {
		 	echo json_encode(array('status' => validName));
		 }
		 else {

		 	echo json_encode(array('status' => invalidName));
		 }
	}

	public function checkEmail()
	{
		getRawPost();
		if(isset($_POST['email']) ? $this->acessm->checkInfo($_POST, 'email') : False) {
			echo json_encode(array('status' => validEmail));
		}
		else {
			echo json_encode(array('status' => invalidEmail));
		}
	}

	public function registerUser()
	{
		$token = '';
		getRawPost();
		if(isset($_POST['action']) && $_POST['action'] == 'register') {
			// print_r($_POST);
			if($this->acessm->addUser($_POST, $token)) {
				
				if($this->mailerm->sendVerifyMail($_POST['username'], $_POST['email'], $token)) {
					echo json_encode(array('status' => scRegistered));			
				}
				else {
					echo json_encode(array('status' => failedEmail));
				}
			}
			else {
				// print_r($_POST);
				echo json_encode(array('status' => errorInfo));				
			}
		}
		else {
			echo json_encode(array('status' => incompleteInfo));			
		}
	}

	public function verify()
	{
		print_r($_GET);
		if($this->acessm->verify($_GET['username'], $_GET['token']))
			echo "fuck";
	}

	public function test()
	{
		$this->mailerm->sendVerifyMail("user", "704788525@qq.com", "what");
	}
}
