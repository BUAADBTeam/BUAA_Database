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

	public function userGetActiveOrder()
	{
		$res = array('order' => array());
		$res['order'] = getSpecificOrders($_SESSION['userid'], userMode);
		$res['count'] = sizeof($res['order']);
		$res['status'] = 0;
		echo json_encode($res);
	}

	public function shopGetActiveOrder()
	{
		$res = array('order' => array());
		$res['order'] = getSpecificOrders($_SESSION['userid'], shopMode);
		$res['count'] = sizeof($res['order']);
		$res['status'] = 0;
		echo json_encode($res);
	}
	public function deliveryGetActiveOrder()
	{
		$res = array('order' => array());
		$res['order'] = getSpecificOrders($_SESSION['userid'], deliveryMode);
		$res['count'] = sizeof($res['order']);
		$res['status'] = 0;
		echo json_encode($res);
	}

	public function shopAcceptOrder()
	{
		if($this->acessm->userIsLoggedIn() 
			&& $this->acessm->userHasRole(shopId)) {
			if(isset($_POST['userid']) && isset($_POST['orderid'])
				&& is_numeric($_POST['userid']) && is_numeric($_POST['orderid'])) {
				$info = array('userid' => $_POST['userid'], 'orderid' => $_POST['orderid']);
				if($this->orderm->shopAcceptOrder($info)) {

				}
				else {

				}
			}
		}
	}

	public function deliveryAcceptOrder()
	{
		
	}
}
