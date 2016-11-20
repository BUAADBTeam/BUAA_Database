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
		if (!isset($_POST['name']) || !isset($_POST['price'])) {
			return FALSE;
		}
		try {
			$this->db->connect();
			$column = array('name' => ':name', 'pic' => ':pic', 'price' => ':price', 'sid' => ':sid', 'st' => ':st');
			$params = array(':name' => $_POST['name'], ':pic' => '', ':price' => $_POST['price'], ':sid' => $sid, ':st' => isset($_POST['st']) ? $_POST['st'] : 1);
			if ($this->db->insert($this->$cuisine, $column, $params) == FALSE) {
				return FALSE;
			}						
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->close();
			return FALSE;
		}
	}

	public function del($sid)
	{
		try {
			$cid = $_POST['id'];
			$this->db->connect();
			$this->db->delete($this->$cuisine, "sid = :sid and cid = :cid", array(':sid' => $sid, ':cid' => $cid));
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->close();
			return FALSE;
		}
	}

	public function put($sid)
	{
		try {
			$cid = $_POST['id'];
			$this->db->connect();
			$this->db->update($this->$cuisine, array('st' => '1'), "sid = :sid and cid = :cid", array(':sid' => $sid, ':cid' => $cid));
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->close();
			return FALSE;
		}
	}

	public function off($sid)
	{
		try {
			$cid = $_POST['id'];
			$this->db->connect();
			$this->db->update($this->$cuisine, array('st' => '0'), "sid = :sid and cid = :cid", array(':sid' => $sid, ':cid' => $cid));
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->close();
			return FALSE;
		}
	}

	public function getCuisineList($sid = 0)
	{
		$res = array();
		$res[] = array('name' => 'Maecenas ornare enim', 'pic' => 'static/images/1.jpg', 'price' => '45.00', 'desc' => 'Cum sociis natodiculus mus.rhoncus egestas ac sit', 'id' => '1');
		$res[] = array('name' => 'Dis parturient montes', 'pic' => 'static/images/3.jpg', 'price' => '55.00', 'desc' => 'Cum sociis natodiculus mus.rhoncus egestas ac sit', 'id' => '2');
		$res[] = array('name' => 'Curabitur congue blandit', 'pic' => 'static/images/3.jpg', 'price' => '65.00', 'desc' => 'Cum sociis natodiculus mus.rhoncus egestas ac sit', 'id' => '3');
		$res[] = array('name' => 'Maecenas ornare enim', 'pic' => 'static/images/1.jpg', 'price' => '45.00', 'desc' => 'Cum sociis natodiculus mus.rhoncus egestas ac sit', 'id' => '1');
		$res[] = array('name' => 'Dis parturient montes', 'pic' => 'static/images/3.jpg', 'price' => '55.00', 'desc' => 'Cum sociis natodiculus mus.rhoncus egestas ac sit', 'id' => '2');
		$res[] = array('name' => 'Curabitur congue blandit', 'pic' => 'static/images/3.jpg', 'price' => '65.00', 'desc' => 'Cum sociis natodiculus mus.rhoncus egestas ac sit', 'id' => '3');
		$res[] = array('name' => 'Maecenas ornare enim', 'pic' => 'static/images/1.jpg', 'price' => '45.00', 'desc' => 'Cum sociis natodiculus mus.rhoncus egestas ac sit', 'id' => '1');
		$res[] = array('name' => 'Dis parturient montes', 'pic' => 'static/images/3.jpg', 'price' => '55.00', 'desc' => 'Cum sociis natodiculus mus.rhoncus egestas ac sit', 'id' => '2');
		$res[] = array('name' => 'Curabitur congue blandit', 'pic' => 'static/images/3.jpg', 'price' => '65.00', 'desc' => 'Cum sociis natodiculus mus.rhoncus egestas ac sit', 'id' => '3');
		return $res;
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