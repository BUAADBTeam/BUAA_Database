<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('shopm');
	}

	public function index()
	{
		header("Location:".base_url());
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

	public function del()
	{
		$sid = getId();
		if ($type == 'shop') {
			if ($this->shopm->del($sid)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	public function put()
	{
		$sid = getId();
		if ($type == 'shop') {
			if ($this->shopm->put($sid)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	public function off()
	{
		$sid = getId();
		if ($type == 'shop') {
			if ($this->shopm->off($sid)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	public function s($id)
	{
		$res['data'] = $this->shopm->getCuisineList();
		$res['status'] = 0;
		$res['count'] = sizeof($res['data']);
		echo json_encode($res);
	}

	public function r($page = 0)
	{
		$res['data'] = $this->shopm->getRecommandList();
		$res['status'] = 0;
		$res['count'] = sizeof($res['data']);
		echo json_encode($res);
	}
}
