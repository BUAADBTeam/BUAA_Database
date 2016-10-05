<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('testm');
	}

	public function index()
	{
		$this->testm->action();
	}
}
