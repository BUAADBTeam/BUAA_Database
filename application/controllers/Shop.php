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
		$id = getId();
		if ($type == 'shop') {
			$this->shopm->add($id);
		}
	}

	public function del()
	{
		$id = getId();
		if ($type == 'shop') {
			$this->shopm->del($id);
		}
	}

	public function put()
	{
		$id = getId();
		if ($type == 'shop') {
			$this->shopm->put($id);
		}
	}

	public function off()
	{
		$id = getId();
		if ($type == 'shop') {
			$this->shopm->off($id);
		}
	}

	public function s($id)
	{
		echo 'Under construct...';
	}

	public function r($page = 0)
	{
		$res['data'] = $this->shopm->getRecommandList();
		$res['status'] = 0;
		$res['count'] = sizeof($res['data']);
		echo json_encode($res);
	}
}
