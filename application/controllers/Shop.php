<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('shopm');
		$this->load->model('acessm');
		define('_shop', 2);
		// $_SESSION['userid'] = 0;
		$this->load->model('uploadm');
	}

	public function index()
	{
		$this->load->view('showShopList');
	}

	public function add()
	{
		// $sid = getId();
		// if ($type == 'shop') {
		// 	if ($this->shopm->add($sid)) {
		// 		return TRUE;
		// 	}
		// }
		// return FALSE;
		if($this->acessm->userIsLoggedIn() && $this->acessm->userHasRole(shopId)) {
			$filename = '';
			if($this->uploadm->upload("static\src\\", $filename)) {
				$neededInfo = array('name' => '', 'price' => '', 'info' => '', 'st' => '');
				foreach ($neededInfo as $key => $value) {
					// if(!isset($_POST[$key])) {
					// 	echo json_encode(array('status' => '1'));
					// 	return FALSE;
					// }
					if(isset($_POST[$key]))
						$neededInfo[$key] = $_POST[$key];
				}
				$neededInfo['st'] = 0;
				$neededInfo['pic'] = $filename;
				if($this->shopm->add($_SESSION['userid'], $neededInfo) == FALSE) {
					//echo json_encode(array('status' => 1));
				}
				else {
					//echo json_encode(array('status' => 0));	
				}
			}
			else {
				//echo json_encode(array('status' => 2));
			}
		}
		$this->load->view('manage', array('id'=> $_SESSION['userid']));
	}

	public function del($cid)
	{
		if($this->acessm->userIsLoggedIn() && $this->acessm->userHasRole(_shop)) {
			$sid = $_SESSION['userid'];
			if ($this->shopm->del($sid, $cid)) {
				echo json_encode(array('status' => 0));
				return;
			}
		}
		echo json_encode(array('status' => 1));
		return;
	}

	public function put($cid)
	{
		if($this->acessm->userIsLoggedIn() && $this->acessm->userHasRole(_shop)) {
			$sid = $_SESSION['userid'];
			if ($this->shopm->put($sid, $cid)) {
				echo json_encode(array('status' => 0));
				return;
			}
		}
		echo json_encode(array('status' => 1));
		return;
	}

	public function off($cid)
	{
		if($this->acessm->userIsLoggedIn() && $this->acessm->userHasRole(_shop)) {
			$sid = $_SESSION['userid'];
			if ($this->shopm->off($sid, $cid)) {
				echo json_encode(array('status' => 0));
				return;
			}
		}
		echo json_encode(array('status' => 1));
	}

	public function s($id = 0)
	{
		$this->load->view("showOneShop", array("id" => $id));
	}

	public function c($id = 0, $All = FALSE)
	{
		$res['data'] = $this->shopm->getCuisineList($id, $All);
		$res['status'] = 0;
		$res['count'] = sizeof($res['data']);
		echo json_encode($res);
	}

	public function manage()
	{
		if($this->acessm->userIsLoggedIn() && $this->acessm->userHasRole(_shop)) {
			$this->load->view("manage", array('id'=> $_SESSION['userid'])); //yic-get_shop_id;
		}
		else {
			echo 'No Access right';
		}
	}

	public function r($page = 0)
	{
		$res = $this->shopm->getRecommandList();
		$res['status'] = 0;
		$res['cuisineCount'] = sizeof($res['cuisine']);
		$res['shopCount'] = sizeof($res['shop']);
		echo json_encode($res);
	}

	public function getShop()
	{
		$res['data'] = $this->shopm->getShopList();
		$res['status'] = 0;
		$res['count'] = sizeof($res['data']);
		echo json_encode($res);
	}

}
