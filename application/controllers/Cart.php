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
		print_r($this->cartm->db->update('orders', array('status' => ':status'), "userid = :userid", array(':status' => '1', ':userid' => '1')));
	}
}
