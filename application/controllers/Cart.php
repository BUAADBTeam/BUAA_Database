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
			$this->acessm->db->selecetRole(1);
			$cart = $this->orderm->getCart($_SESSION['userid']);
			print_r($cart);
		}
		$this->load->view('submitorder');
	}

	public function coupon()
	{
		print_r($this->couponm->addCoupons(1, array('3' => '2', '2' => '3')));
	}

	public function submit()
	{
		if($this->acessm->userIsLoggedIn() && $this->acessm->userHasRole(1) && isset($_POST['action']) && $_POST['action'] == 'submitOrder') {
			$this->acessm->db->selecetRole(1);
			$info = array('userid' => $_SESSION['userid'],
				'shopid' => $_POST['shopid']);

			if($this->orderm->checkStatus($info, 0)) {
			
				$coupons = $this->couponm->calMoney($_POST['shopid']);
				$this->orderm->submitOrder(array_merge($info, isset($_POST['address']) ? array($_POST['address']) : array()));
			}
		}	
	}

	public function paid()
	{
		if($this->acessm->userIsLoggedIn() && $this->acessm->userHasRole(1) && isset($_POST['action']) && $_POST['action'] == 'payOrder') {
			$this->acessm->db->selecetRole(1);
			$info = array('userid' => $_SESSION['userid'],
				'shopid' => $_POST['shopid']);
			if($this->orderm->checkStatus($info, 1)) {
				// echo "string";
				$this->orderm->payOrder($info);
			}
		}
	}


}
