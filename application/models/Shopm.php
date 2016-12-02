<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopm extends Model {
	
	var $cuisine = 'cuisine';
	var $shop = 'exshop';

	public function __construct()
	{
		parent::__construct();
	}

	public function add($sid, $info)
	{
		if (!isset($info['name']) || !isset($info['price'])) {
			return FALSE;
		}
		if(!is_string($info['name']) || !is_numeric($info['price']) || $info['price'] < 0) {
			return FALSE;
		}
		if(isset($info['st']) && ($info['st'] !== 0 && $info['st'] !== 1)) {
			return FALSE;
		}
		if(isset($info['info']) && (!is_string($info['info'])))
			return False;
		try {
			$this->db->connect();
			$this->db->beginTransaction();
			$column = array('name' => ':name', 'pic' => ':pic', 'price' => ':price', 'sid' => ':sid', 'st' => ':st', 'info' => ':info');
			$params = array(':name' => $info['name'], ':pic' => $info['pic'], ':price' => $info['price'], ':sid' => $sid, ':st' => isset($info['st']) ? $info['st'] : 1, ':info' => $info['info']);
			try {
				$this->db->insert($this->cuisine, $column, $params);
			} catch (Exception $e) {
				$this->db->rollback;
				$this->db->close();
				return FALSE;
			}
			$this->db->commit();
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return FALSE;
		}
	}

	public function del($sid, $cid)
	{
		try {
			$this->db->connect();
			$this->db->beginTransaction();
			$this->db->delete($this->cuisine, "sid = :sid and id = :cid", array(':sid' => $sid, ':cid' => $cid));
			$this->db->commit();
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return FALSE;
		}
	}

	public function put($sid, $cid)
	{
		try {
			$this->db->connect();
			$this->db->beginTransaction();
			$this->db->update($this->cuisine, array('st' => '0'), "sid = :sid and id = :cid", array(':sid' => $sid, ':cid' => $cid));
			$this->db->commit();
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return FALSE;
		}
	}

	public function off($sid, $cid)
	{
		try {
			$this->db->connect();
			$this->db->beginTransaction();
			$this->db->update($this->cuisine, array('st' => '1'), "sid = :sid and id = :cid", array(':sid' => $sid, ':cid' => $cid));
			$this->db->commit();
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return FALSE;
		}
	}

	public function getCuisineList($sid = 0, $All = FALSE)
	{
		$this->db->connect();
		$this->db->beginTransaction();
		$res = $this->db->select(array('*'), $this->cuisine, 'sid = :sid' . ($All ? '' : ' and st=0'), array(':sid' => $sid), 'S');
		$this->db->commit();
		$this->db->close();
		if ($res == 0) {
			return null;
		}
		return $res['rows'];
	}

	public function getRecommandList()
	{
		$res = array('cuisine' => array(), 'shop' => array());
		$this->db->connect();
		$this->db->beginTransaction();
		$res['cuisine'] = $this->db->select(array('name', 'pic', 'info', 'sid', 'price'), $this->cuisine, '1 limit 0, 3', array(), 'S')['rows'];
		$res['shop'] = $this->db->select(array('name', 'photo', 'intro', 'addr', 'id'), $this->shop, '1', array(), 'S limit 0, 3')['rows'];
		$this->db->commit();
		$this->db->close();
		// for ($i = 0; $i < 16; $i++) {
		// 	$res[] = array('id' => rand(1, 4), 'name' => '美食街', 'pic' => '', 'addr' => '233');
		// }
		// print_r($res);
		return $res;
	}

	public function changePhoto($userid, $filename)
	{
		$this->db->connect();
		$this->db->beginTransaction();
		try { 
			$num = $this->db->update('shop', array('pic' => ':pic'), "id = :id", array(':pic' => $filename, ':id' => $userid));
			if($num != 1)
				return FALSE;
		} catch (Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return False;
		}
		$this->db->commit();
		$this->db->close();
		return True;
  	}
  	public function getShopList()
  	{
  		$this->db->connect();
		$this->db->beginTransaction();
		$res = $this->db->select(array('*'), $this->shop, '1', array(), 'S')['rows'];
		$this->db->commit();
		$this->db->close();
		return $res;
  	}
}