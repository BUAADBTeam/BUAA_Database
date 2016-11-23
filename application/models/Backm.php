<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backm extends Model {
	

	function __construct()
	{
		parent::__construct();
	}

	function addShop($info)
	{
		
	}

	function addDeliveryMen($info)
	{
		$neededInfo = array("deleveryid" => "", "phone" => "", "credit" => "", "status" => "");
		$value = array();
		foreach ($neededInfo as $key => $value) {
			if(empty($info[$key]))
				return False;
			$neededInfo[$key] = ":$key";
			$value[":$key"] = $info[$key];
		}
		try {
			$this->db->connect();
			$this->beginTrasaction();
			$this->db->insert("deliverymen", $neededInfo, $value);
			
		} catch (Exception $e) {
			$this->db->rollback();
			$this->db->close();
		}
		$this->db->commit();
		$this->db->close();
	}

	function addShop($info)
	{
		$neededInfo = array("shopid" => "", "phone" => "", "credit" => "", "address" => "", "status" => "");
		$value = array();
		foreach ($neededInfo as $key => $value) {
			if(empty($info[$key]))
				return False;
			$neededInfo[$key] = ":$key";
			$value[":$key"] = $info[$key];
		}
		try {
			$this->db->connect();
			$this->beginTrasaction();
			$this->db->insert("shops", $neededInfo, $value);
			
		} catch (Exception $e) {
			$this->db->rollback();
			$this->db->close();
		}
		$this->db->commit();
		$this->db->close();
	}
}
