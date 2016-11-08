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
		$this->acessm->userIsLoggedIn();
	}


	public function logout()
	{
		$this->acessm->userIsLoggedIn();
	}
}
