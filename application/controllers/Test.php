<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('testm');
		$this->load->model('mailerm');
		$this->load->model('acessm');
		$this->load->model('orderm');
	}

	public function index()
	{
		$res = $this->orderm->getSpecificOrders(43, userMode);
		print_r($res);
	}
	public function post()
	{
		print_r($_POST);
	}
}
