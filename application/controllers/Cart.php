<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('orderm');
		$this->load->model('couponm');
	}

	public function index()
	{
		print_r($this->orderm->submitOrder(array('userid' => 1, 'shopid' => 1, 'address' => 'here')) ? 'good' : 'bad');
	}

	public function coupon()
	{
		print_r($this->couponm->addCoupons(1, array('3' => '2', '2' => '3')));
	}
}
