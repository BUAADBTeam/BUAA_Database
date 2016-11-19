<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('testm');
		$this->load->model('mailerm');
	}

	public function index()
	{
		print_r(base_url());
	}
}
