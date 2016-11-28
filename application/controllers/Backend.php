<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends Controller {

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

	

}
