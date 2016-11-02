<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('deliverym');
		// $this->load->model('couponm');
		$this->load->model('acessm');
	}

	public function index()
	{
		// print_r($this->orderm->submitOrder(array('userid' => 1, 'shopid' => 1, 'address' => 'here')) ? 'good' : 'bad');
		if($this->acessm->userIsLoggedIn() && $this->acessm->userHasRole(3)) {
			
			print_r($this->deliverym->getDeliveryList($_SESSION['userid']));
		}
	}

	public function acceptOrder()
	{
		if($this->acessm->userIsLoggedIn() && $this->acessm->userHasRole(3)) {
			if(isset($_POST['action'] && $_POST['action'] == 'deliveyAcceptOrder')) {
				// 
				if(isset($_POST['userid']) && isset($_POST['shopid'])) {
					$this->deliverym->deliveryAcceptOrder(array('userid' => $_POST['userid'], 'shopid' => $_POST['shopid'], 'deliveryid' => $_SESSION['userid']));
				}
			}
			
			
		}
	}
	
	public function getOrderList()
	{
		if($this->acessm->userIsLoggedIn() && $this->acessm->userHasRole(3)) {
			
			print_r($this->deliverym->getDeliveryList($_SESSION['userid'], True));
		}
	}
}
