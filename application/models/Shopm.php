<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopm extends Model {
	
	var $cuisine = 'cuisine';
	var $shop = 'shop';

	public function __construct()
	{
		parent::__construct();
	}

	public function add($sid)
	{
		try {
			$this->db->connect();
			$this->db->insert($this->$cuisine, array('name' => ':name', 'pic' => ':pic', 'price' => ':price', 'sid' => ':sid', 'st' => ':st'), 
												array(':name' => $_POST['name'], ':pic' => '', ':price' => $_POST['price'], ':sid' => $sid, ':st' => $_POST['st']));
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->close();
			return null;
		}
	}

	public function del($sid, $cid)
	{
		try {
			$this->db->connect();
			$this->db->delete($this->$cuisine, "sid = :sid and cid = :cid", array(':sid' => $sid, ':cid' => $cid));
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->close();
			return null;
		}
	}

	public function put($sid, $cid)
	{
		try {
			$this->db->connect();
			$this->db->update($this->$cuisine, array('st' => '1'), "sid = :sid and cid = :cid", array(':sid' => $sid, ':cid' => $cid));
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->close();
			return null;
		}
	}

	public function off($sid, $cid)
	{
		try {
			$this->db->connect();
			$this->db->update($this->$cuisine, array('st' => '0'), "sid = :sid and cid = :cid", array(':sid' => $sid, ':cid' => $cid));
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->close();
			return null;
		}
	}

	public function getCuisineList()
	{
		$id = getId();
		if ($type == 'shop') {
			$this->shopm->getCuisineList($id);
		}
	}

	public function getRecommandList()
	{
		// $this->shopm->getRecommandList();
		$res = array();
		for ($i = 0; $i < 16; $i++) {
			$res[] = array('id' => rand(1, 4), 'name' => '美食街', 'pic' => '', 'addr' => '233');
		}
		// print_r($res);
		return $res;
	}
}