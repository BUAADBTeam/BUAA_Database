<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testm extends Model {
	

	function __construct()
	{
		parent::__construct();
	}

	function checkStatus($info, $status)
	{
		try {

			$this->db->connect();
			$this->db->beginTransaction();
			$sql = "";
			$param = array();
			foreach ($info as $key=>$val) {
				if(is_string($key) && is_string($val)) {
					$sql .= " $key = :$key AND";
					$param[":$key"] = $val;
				}
			}
			$sql .= " status < 7";

			$sta = $this->db->select(array('status'), 'orders', $sql, $param, "S")['row'];
			$this->db->commit();
			$this->db->close();
			if(empty($sta) || $sta != $status)
				return False;
			return True;
		} catch(Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return False;
		}
	}

	private function updstatus($info = array(), $updInfo = array())
	{
		try {
			$this->db->connect();
			// if(!$this->checkInfo($info, True))
			// 	return False;
			$this->db->beginTransaction();
			$sql = "";
			$param = array();
			foreach ($info as $key=>$val) {
				if(is_string($key) && is_string($val)) {
					$sql .= " $key = :$key AND";
					$param[":$key"] = $val;
				}
			}
			$sql .= " status < 7";

			$updArray = array();
			foreach ($updInfo as $key => $value) {
				$updArray[$key] = ":$key";
				$param[":$key"] = $value;
			}
				

			$num = $this->db->update('orders', array_merge(array('status' => 'status + 1'), $updArray), $sql, $param);
			$this->db->commit();
			$this->db->close();
			return $num == 1 ? True : False;
		} catch(Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return False;
		}
	}

	function getDeliveryList($deleveryID, $includeFinished = False)
	{
		try {
			$this->db->connect();
			$this->db->beginTransaction();
			$list = $this->db->select(array('*'), 'orders', "deliveryid = :deliveryid AND (status = 4". ($includeFinished ? 'OR status = 5)' : ')'), array(':deliveryid' => $deliveryid), "S")['rows'];
			$this->db->commit();
			$this->db->close();
			return $list;
		} catch(Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return NULL;
		}
	}

	function deliveryAcceptOrder($info = array())
	{
		// if(empty($info['deliveryid']))
		// 	return False;
		// $id = $info['deliveryid']
		return $this->updStatus($info, array('deliverytime' => time()));
	}

}
