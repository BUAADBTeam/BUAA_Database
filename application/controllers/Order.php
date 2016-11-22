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
		$res['order'][] = array('items' => array(array('name' => '宫保鸡丁', 'id' => 14, 'pic' => 'static/images/3.jpg', 'price' => '45.00', 'num' => 1, ), array('name' => '鱼香茄子', 'id' => 15, 'pic' => 'static/images/1.jpg', 'price' => '45.00', 'num' => 2)), 'All' => '135.00', 'user' => array('name' => 'test', 'id' => 0, 'addr' => 'BUAA', 'pic' => 'static/images/1p.jpg', 'info' => '烫烫烫'), 'st' => 1, 'count' => 2, 'id' => 0);
		$res['count'] = sizeof($res['order']);
		$res['status'] = 0;
		echo json_encode($res);
	}

	public function shopGetActiveOrder()
	{
		$res = array('order' => array());
		$res['order'][] = array('items' => array(array('name' => '宫保鸡丁', 'id' => 14, 'pic' => 'static/images/3.jpg', 'price' => '45.00', 'num' => 1, ), array('name' => '鱼香茄子', 'id' => 15, 'pic' => 'static/images/1.jpg', 'price' => '45.00', 'num' => 2)), 'All' => '135.00', 'user' => array('name' => 'test', 'id' => 0, 'addr' => 'BUAA', 'pic' => 'static/images/1p.jpg', 'info' => '烫烫烫'), 'st' => 1, 'count' => 2, 'id' => 0);

		$res['order'][] = array('items' => array(array('name' => '宫保鸡丁', 'id' => 14, 'pic' => 'static/images/1.jpg', 'price' => '45.00', 'num' => 3), array('name' => '鱼香茄子', 'id' => 15, 'pic' => 'static/images/3.jpg', 'price' => '45.00', 'num' => 2)), 'All' => '225.00', 'user' => array('name' => 'test', 'id' => 0, 'addr' => 'BUAA', 'pic' => 'static/images/2p.jpg', 'info' => '烫烫烫'), 'st' => 8, 'count' => 2, 'id' => 1);
		$res['count'] = sizeof($res['order']);
		$res['status'] = 0;
		echo json_encode($res);
	}
	public function deliveryGetActiveOrder()
	{
		$res = array('order' => array());
		$res['order'][] = array('items' => array(array('name' => '宫保鸡丁', 'id' => 14, 'pic' => 'static/images/1.jpg', 'price' => '45.00', 'num' => 3), array('name' => '鱼香茄子', 'id' => 15, 'pic' => 'static/images/3.jpg', 'price' => '45.00', 'num' => 2)), 'All' => '225.00', 'user' => array('name' => 'test', 'id' => 0, 'addr' => 'BUAA', 'pic' => 'static/images/2p.jpg', 'info' => '烫烫烫'), 'st' => 8, 'count' => 2, 'id' => 1);
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
