<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('orderm');
		$this->load->model('acessm');
	}

	public function index()
	{
		$this->load->view('showOrder');
	}

	public function getOrder()
	{
		if (!$this->acessm->userIsLoggedIn()) {
			echo json_encode(array('status' => -1));
		}
		$res = array('order' => array());
		for ($i = 1; $i <= 3; $i++) {
			if ($this->acessm->userHasRole($i)) {
				$res['order'] = $this->orderm->getSpecificOrders($_SESSION['userid'], $i);
			}
		}
		print_r($res['order']);
		$res['count'] = count($res['order']['list']);
		$res['status'] = 0;
		echo json_encode($res);
	}

	public function shopAcceptOrder()
	{
		if($this->acessm->userIsLoggedIn() 
			&& $this->acessm->userHasRole(shopId)) {
			if(isset($_POST['userid']) && isset($_POST['shopid']) && isset($_POST['orderid']) && is_numeric($_POST['orderid']) && is_numeric($_POST['userid']) && is_numeric($_POST['shopid'])) {
				$info = array('userid' => $_POST['userid'], 'orderid' => $_POST['orderid'], 'shopid' => $_POST['shopid']);
				if($this->orderm->shopAcceptOrder($info) 
					) {
					echo json_encode(array('status' => 0));
				}
				else {
					echo json_encode(array('status' => 1));
				}
			}
		}
	}

	public function deliveryAcceptOrder()
	{
		if($this->acessm->userIsLoggedIn() 
			&& $this->acessm->userHasRole(deliveryId)) {
			if(isset($_POST['userid']) && isset($_POST['orderid']) && isset($_POST['shopid']) && is_numeric($_POST['orderid']) && is_numeric($_POST['userid']) && is_numeric($_POST['shopid'])) {
				$info = array('userid' => $_POST['userid'], 'orderid' => $_POST['orderid'], 'shopid' => $_POST['shopid']);
				if($this->orderm->deliveryAcceptOrder($info)
					&& $this->orderm->allocDelivery($info)) {
					echo json_encode(array('status' => 0));
				}
				else {
					echo json_encode(array('status' => 1));
				}
			}
		}
		else {
			echo json_encode(array('status' => 1));
		}
	}

	public function userPaid()
	{
		if($this->acessm->userIsLoggedIn() 
			&& $this->acessm->userHasRole(userId)) {
			if(isset($_POST['userid']) && isset($_POST['shopid']) && isset($_POST['orderid']) && is_numeric($_POST['shopid']) && is_numeric($_POST['userid']) && is_numeric($_POST['orderid'])) {
				$info = array('userid' => $_POST['userid'], 'orderid' => $_POST['orderid'], 'shopid' => $_POST['shopid']);
				if($this->orderm->payOrder($info)) {
					echo json_encode(array('status' => 0));
				}
				else {
					echo json_encode(array('status' => 1));
				}
			}
		}
		else {
			echo json_encode(array('status' => 1));
		}
	}

	function userGetOrder()
	{
		if($this->acessm->userIsLoggedIn() 
			&& $this->acessm->userHasRole(userId)) {
			if(isset($_POST['userid']) && isset($_POST['orderid']) && isset($_POST['shopid']) && is_numeric($_POST['orderid']) && is_numeric($_POST['userid']) && is_numeric($_POST['shopid'])) {
				$info = array('userid' => $_POST['userid'], 'orderid' => $_POST['orderid'], 'shopid' => $_POST['shopid']);
				if($this->orderm->completeOrder($info)) {
					echo json_encode(array('status' => 0));
				}
				else {
					echo json_encode(array('status' => 1));
				}
			}
		}
		else {
			echo json_encode(array('status' => 1));
		}
	}



}
