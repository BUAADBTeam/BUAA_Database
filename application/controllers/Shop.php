<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('shopm');
		$this->load->model('acessm');
		define('_shop', 2);
		$_SESSION['userid'] = 0;
	}

	public function index()
	{
		$this->load->view('showShopList');
	}

	public function add()
	{
		$sid = getId();
		if ($type == 'shop') {
			if ($this->shopm->add($sid)) {
				return TRUE;
			}
		}
		return FALSE;
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
		else {
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
		else {
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
		else {
			$sid = $_SESSION['userid'];
			if ($this->shopm->off($sid, $cid)) {
				echo json_encode(array('status' => 0));
				return TRUE;
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
			$this->load->view("manage", array('id'=> 0)); //yic-get_shop_id;
		}
		else {
			$this->load->view("manage", array('id'=> 0));
		}
	}

	public function r($page = 0)
	{
		$res['data'] = $this->shopm->getRecommandList();
		$res['status'] = 0;
		$res['count'] = sizeof($res['data']);
		echo json_encode($res);
	}
}
