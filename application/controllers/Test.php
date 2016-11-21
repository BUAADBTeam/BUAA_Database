<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('testm');
		$this->load->model('mailerm');
		$this->load->model('acessm');
	}

	public function index()
	{
		if($this->acessm->userHasRole(3)) {
		$host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
		print_r($host);
		}
	}
	public function post()
	{
		print_r($_POST);
	}
}
