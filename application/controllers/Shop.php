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

	public function s()
	{
		$id = getId();
		if ($type == 'shop') {
			$this->shopm->getCuisineList($id);
		}
	}

	public function r()
	{
		$this->shopm->getRecommandList();
	}
}
