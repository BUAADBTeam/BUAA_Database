<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testm extends Model {
	

	function __construct()
	{
		parent::__construct();
	}

	function checkStatus($info, $status)
	{

		$this->db->connect();

		$sql = "";
		$param = array();
		foreach ($info as $key=>$val) {
			// if($key != 'address')
			$sql .= " $key = :$key AND";
			$param[":$key"] = $val;
		}
		$sql .= " status < 7";

		$sta = $this->db->select(array('status'), 'orders', $sql, $param)['row'];
		if(empty($sta) || $sta != $status)
			return False;
		return True;
	}

	private function updstatus($info = array(), $updInfo = array())
	{
		$this->db->connect();
		// if(!$this->checkInfo($info, True))
		// 	return False;
		
		$sql = "";
		$param = array();
		foreach ($info as $key=>$val) {
			// if($key != 'address')
			$sql .= " $key = :$key AND";
			$param[":$key"] = $val;
		}
		$sql .= " status < 7";

		$updArray = array();
		foreach ($updInfo as $key => $value) {
			$updArray[$key] = ":$key";
			$param[":$key"] = $value;
		}
			

		$num = $this->db->update('orders', array_merge(array('status' => 'status + 1'), $updArray), $sql, $param);
		$this->db->close();
		return $num == 1 ? True : False;
	}

	function getDeliveryList($deleveryID, $includeFinished = False)
	{
		$this->db->connect();
		$list = $this->db->select(array('*'), 'orders', "deliveryid = :deliveryid AND (status = 4". ($includeFinished ? 'OR status = 5)' : ')'), array(':deliveryid' => $deliveryid))['rows'];
		return $list;
	}

	function deliveryAcceptOrder($info = array())
	{
		// if(empty($info['deliveryid']))
		// 	return False;
		// $id = $info['deliveryid']
		return $this->updStatus($info, array('deliverytime' => time()));
	}

}
