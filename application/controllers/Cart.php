<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('cartm');
	}

	public function index()
	{
		print_r($this->cartm->delFood("1", "2", "2") ? 0 : 1);
	}
}
