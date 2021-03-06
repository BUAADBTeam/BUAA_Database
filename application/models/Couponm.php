<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Couponm extends Model {

	function __construct()
	{
		parent::__construct();
	}

	function calMoney($shopid, $money = NULL)
	{
		try {
			$this->db->connect();
			$this->db->beginTransaction();
			$coupons = $this->db->select(array('money', 'downmoney'), 'coupons', "shopid = :shopid ORDER BY money DESC", array(':shopid' => $shopid), "S")['rows'];
		} catch(Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return 0;
		}
		$this->db->commit();
		$this->db->close();
		if(count($coupons) > 0) {
			if(is_null($money)) {
				return $coupons;
			}
			foreach ($coupons as $key => $value) {
				if($value['money'] <= $money) {
					return $value['downmoney'];
				}
			}
		}
		return 0;
		
	}

	function addCoupons($shopid, $coupons = array())
	{
		try {
			$this->db->connect();
			$this->db->beginTransaction();
			if(empty($coupons))
				return False;
			$sql = "INSERT INTO coupons(shopid, money, downmoney)  
					VALUES (:shopid, :money, :downmoney)";
			$this->db->prepare($sql);
			foreach ($coupons as $money => $downmoney) {
				$num = $this->db->execute('', array(':shopid' => $shopid, ':money' => $money, ':downmoney' => $downmoney))['num_rows'];
			}
		} catch(Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return False;
		}
		$this->db->commit();
		$this->db->close();
		return True;

	}
	
}

