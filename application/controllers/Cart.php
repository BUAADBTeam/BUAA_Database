<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('orderm');
	}

	public function index()
	{
		print_r($this->orderm->completeOrder(array('userid' => 1, 'shopid' => 1, 'address' => 'here')) ? 'good' : 'bad');
	}
}
