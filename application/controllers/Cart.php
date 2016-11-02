<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('orderm');
		$this->load->model('couponm');
		$this->load->model('acessm');
	}

	public function index()
	{
		// print_r($this->orderm->submitOrder(array('userid' => 1, 'shopid' => 1, 'address' => 'here')) ? 'good' : 'bad');
		if($this->acessm->userIsLoggedIn() && $this->acessm->userHasRole(1)) {
			$cart = $this->orderm->getCart($_SESSION['userid']);
			print_r($cart);
		}
	}

	public function coupon()
	{
		print_r($this->couponm->addCoupons(1, array('3' => '2', '2' => '3')));
	}

	public function submitOrder()
	{
		if($this->acessm->userIsLoggedIn() && $this->acessm->userHasRole(1) && isset($_POST['action']) && $_POST['action'] == 'submitOrder') {
			$this->orderm->submitOrder(array('address' => isset($_POST['address'] ? $_POST['address'] : '', 
				'userid' => $_SESSION['userid'],
				'shopid' => $_POST['shopid'])));
		}	
	}


}
