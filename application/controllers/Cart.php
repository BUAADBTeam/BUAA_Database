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
		$res['status'] = -1;
		$orderId = -1;
		if($this->acessm->userIsLoggedIn() && $this->acessm->userHasRole(1) && isset($_POST['action']) && $_POST['action'] == 'submitOrder') {
			if(isset($_POST['data']) && isset($_POST['sid']) 
				&& is_numeric($_POST['sid']) && is_array($_POST['data'])) {
				$neededInfo = array('id', 'num');
				$info = array();
				
				foreach ($_POST['data'] as $key => $value) {
					if(isset($value['id']) && isset($value['num']) 
						&& is_numeric($value['id']) && is_numeric($value['num'])) {
						// $info[] = array($value['id'], $value['num']);
						$this->orderm->addFood($_SESSION['userid'], $value['id'], $value['num'], $_POST['sid'], $orderId);

					}
					
				}
			}
			if($orderId == -1) {
				echo json_encode($res);
				return;
			}
			$this->acessm->db->selectRole(1);
			$info = array('userid' => $_SESSION['userid'],
				'shopid' => $_POST['sid'], 'orderid' => $orderId);

			// if($this->orderm->checkStatus($info, 0)) {
			// print_r($_POST);
			$coupons = $this->couponm->calMoney($_POST['sid']);
			// print_r($coupons);
			if ($this->orderm->submitOrder(array_merge($info, isset($_POST['address']) ? array($_POST['address']) : array()), $coupons)) {
				$res['status'] = 0;
			}
			// }
			echo json_encode($res);
		}	
		else
			echo "string";
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
