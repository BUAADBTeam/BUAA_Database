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
		getRawPost();
		if(isset($_POST['action']) && $_POST['action'] == 'register') {
			// print_r($_POST);
			if($this->acessm->addUser($_POST, $token)) {
				
				if($this->mailerm->sendVerifyMail($_POST['username'], $_POST['email'], $token)) {
					echo json_encode(array('status' => 0));			
				}
				else {
					echo json_encode(array('status' => 12));
				}
			}
			else {
				echo json_encode(array('status' => 904));				
			}
		}
		else {
			echo json_encode(array('status' => 101));			
		}
	}

	public function verify()
	{
		if($this->acessm->verify($_GET['username'], $_GET['token']))
			echo "fuck";
	}

	public function test()
	{
		$this->mailerm->sendVerifyMail("user", "704788525@qq.com", "what");
	}
}
