<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require Couponm.php

class Orderm extends Model {

	function __construct()
	{
		parent::__construct();
		
	}

	function getCart($userid)
	{
		
		
		$this->db->connect();
		$this->db->beginTransaction();
		try {
	        $result = $this->db->select(array('*'), 'orderitems', 
	        	"orderid in (SELECT orderid FROM orders 
	                  WHERE userid = :userid AND status < 2)", array(':userid' => $userid), "S");
	        $cart = $result['rows'];
	        $this->db->commit();
	        $this->db->close();
	        return $cart;
	    } catch(Exception $e) {
	    	$this->db->rollback();
	    	$this->db->close();
	    	return null;
	    }
	}

	function getSpecificOrders($id, $mode = userMode)
	{
		if(!in_array($mode, array(userMode, shopMode))) {
			return null;
		}
		$this->db->connect();
		$this->db->beginTransaction();
		$result = array();
		$res = array();
		if($mode == userMode) {
			try {
				$res = $this->db->select(array('orderid', 'total', 'userid', 'status'), 'orders', "userid = :userid", array(':userid' => $id), "S")['rows'];
				foreach ($res as $key => $value) {
					$value['items'] = $this->db->select(array('*'), 'orderitems', 'orderid = :orderid', array(':orderid' => $value['orderid']), "S")['rows'];
				}
				$result['list'] = $res;
				$res = $this->db->select(array('*'), 'users', 'userid = :userid', array(':userid' => $id), "S")['row'];
				$result['user'] = $res;
			} catch(Exception $e) {
				$this->db->rollback();
				$this->db->close();
				return False;
			}
		}
		else if($mode == shopMode) {
			try {
				$res = $this->db->select(array('orderid', 'total', 'userid', 'status'), 'orders', "shopid = :shopid", array(':shopid' => $id), "S")['rows'];
				foreach ($res as $key => $value) {
					$value['items'] = $this->db->select(array('*'), 'orderitems', 'orderid = :orderid', array(':orderid' => $value['orderid']), "S")['rows'];
				}
				$result['list'] = $res;
				$res = $this->db->select(array('*'), 'shop', 'id = :shopid', array(':shopid' => $id), "S")['row'];
				$result['shop'] = $res;
			} catch(Exception $e) {
				$this->db->rollback();
				$this->db->close();
				return False;
			}
		}
		return $result;
	}



	function addFood($userid, $itemid, $amount, $shopid)
	{
		if (! is_numeric($amount) || !($amount + 0 > 0) || !(is_numeric($itemid) && is_numeric($userid))) {
			$this->db->close();
			return False;
		}
		
		$this->db->connect();
		$this->db->beginTransaction();
		try {
			// $sql = "SELECT price 
	  //       		FROM cuisine
	  //       		WHERE id = $itemid";
	  //       $sth = $pdo->prepare($sql);
	  //       $sth->execute();

			$result = $this->db->select(array('price'), 'cuisine', "id = $itemid", array(), "S")['row'];

			if (!empty($result))
            	$price = $result['price'];	        
            else {
            	$this->db->rollback();
            	$this->db->close();
            	return False;
            }

            $price *= $amount;

			// $sql = "SELECT orderid FROM orders 
   //                WHERE userid = :userid AND status < 2"; 
            // // $sth = $pdo->prepare($sql);
            // $sth->bindParam(':userid', $userid);
            // $sth->execute();
            $result = $this->db->select(array('orderid'), 'orders', "userid = :userid AND status = 0", array(':userid' => $userid), "S")['row'];
            if (count($result) > 0)
            	$orderid = $result['orderid'];
            else {
            	$orderid = $this->db->insert('orders', array('userid' => ':userid', 'shopid' => ':shopid', 'status' => '0', 'total' => '0'), array(':userid' => $userid, ':shopid' => $shopid));

            }
             // $sql = "SELECT COUNT(*) 
            // -- 		FROM orderitems
            // -- 		WHERE userid = :userid  AND orderid = :orderid AND itemid = :itemid"; 
         //    $sth = $pdo->prepare($sql);
	        // $sth->bindParam(':userid', $userid);
	        // $sth->bindParam(':orderid', $orderid);
	        // $sth->bindParam(':itemid', $itemid);
	        // $sth->execute();
	        // $result = $sth->fetch();
	        // var_dump($result);
	        $result = $this->db->select(array('COUNT(*)'), 'orderitems', 
	        	"userid = :userid  AND orderid = :orderid AND itemid = :itemid",
	        	array(':userid' => $userid, ':orderid' => $orderid, ':itemid' => $itemid), "S")['row'];
	        if ($result[0] > 0) {
		        $num = $this->db->update('orderitems', array('amount' => "amount + $amount"), 
		        	"userid = :userid  AND orderid = :orderid AND itemid = :itemid",
		        	array(':userid' => $userid, ':orderid' => $orderid, ':itemid' => $itemid));
		        if($num == 0) {
		        	$this->db->rollback();
		        	$this->db->close();
		        	return False;
		        }
	        }
	        else {
				
		        $this->db->insert('orderitems', 
		        	array('userid' => ':userid', 'orderid' => ':orderid', 'itemid' => ':itemid', 'amount' => $amount), 
		        		array(':userid' => $userid,
		        			':orderid' => $orderid,
		        			':itemid' => $itemid));
		    }
		    
	        
            $sql = "UPDATE orders
            		SET total = total + $price
            		WHERE orderid = $orderid";
            $num = $this->db->exec($sql);
            if($num == 0) {
            	$this->db->rollback();
	        	$this->db->close();	
	        	return False;
            }
            $this->db->commit();
	        $this->db->close();
	    } catch(Exception $e) {
	    	$this->db->rollback();
	    	$this->db->close();
	    	return False;
	    }

	    return True;
	}

	function delFood($userid, $itemid, $amount)
	{
		if (!is_numeric($amount) || !($amount + 0 > 0) || !(is_numeric($itemid))) {
			// $this->db->close();
			return False;
		}
		$amount = $amount + 0;
		
					  
		$this->db->connect();
		$this->db->beginTransaction();
		try {
			$sql = "SELECT price 
	        		FROM cuisine
	        		WHERE id = $itemid LOCK IN SHARE MODE";
	        $this->db->prepare($sql);
	        $result = $this->db->execute($mode = 'SELECT')['row'];
	        // var_dump($result);
	        // // die();
			if(!empty($result))
            	$price = $result['price'];	        
            else {
            	$this->db->commit();
            	$this->db->close();
            	return False;
            }
            $price *= $amount;

            $result = $this->db->select(array('orderid'), 'orders', 
            	"userid = :userid AND status < 2",
            	array(':userid' => $userid), "S")['row'];
            if (!empty($result))
            	$orderid = $result['orderid'];
            else {
            	$this->db->commit();
            	$this->db->close();
            	return False;
            }


			$result = $this->db->select(array('amount'), 'orderitems',
				"orderid = $orderid AND itemid = :itemid",
				array(':itemid' => $itemid), "S")['row'];	        
	        if($result[0] > $amount) {
	        	$sql = "UPDATE orderitems
	        			SET amount = amount - $amount
						WHERE orderid = $orderid AND itemid = :itemid"; 
				$this->db->prepare($sql);
	        	$this->db->bindParam(':itemid', $itemid);
	        	$this->db->execute();
	        	// $this->db->update('orderitems', a)
	        }
	        else if ($result[0] == $amount) {

	        	$sql = "DELETE FROM orderitems
						WHERE orderid = $orderid AND itemid = :itemid"; 
				$this->db->prepare($sql);
	        	$this->db->bindParam(':itemid', $itemid);
	        	$this->db->execute();
	        }
	        else {
	        	$this->db->commit();
	        	$this->db->close();
	        	return False;
	        }

	        $sql = "UPDATE orders
            		SET total = total - $price
            		WHERE orderid = $orderid";
            $this->db->exec($sql);
            $this->db->commit();
	        $this->db->close();
	    } catch(Exception $e) {
	    	$this->db->rollback();
	    	$this->db->close();
	    	return False;
	    }

	    return True;
	}



	private function validType($val, $type = 7)
	{
		if(($type & 1) && is_bool($val)) 
			return true;
		if(($type & 2) && is_numeric($val))
			return true;
		if(($type & 4) && is_string($val))
			return true;
		return false;
	}

	private function checkInfo($info = array(), $checkaddress = False)
	{
		if(is_array($info)) {
			if(isset($info['userid']) && isset($info['shopid'])) {
				if((count($info) == 2 && !$checkaddress) || (count($info) && !isset($info['address']) && $checkaddress)) {
					foreach ($info as $key => $value) {
						if(!$this->validType($value))
							return False;
					}
					return True;
				}
			}
			// return True;
			// else 
			return False;
		}
		else {
			return False;
		}
	}

	private function checkStatus($status, $sql, $param)
	{
		$res = $this->db->select(array('status'), 'orders', $sql, $param)['row'];
		print_r($sql);
		print_r($param);
		print_r($res);
		if(!empty($res) && $res['status'] == $status)
			return true;
		return false;
	}

	private function updStatus($beginStatus, $info = array(), $updInfo = array())
	{
		// $this->db->connect();
		if(!$this->checkInfo($info))
			return False;
		
		$sql = "";
		$param = array();
		foreach ($info as $key=>$val) {
			// if($key != 'address')
			$sql .= " $key = :$key AND";
			$param[":$key"] = $val;
		}
		$sql .= " status < 7";
		if(!$this->checkStatus($beginStatus, $sql, $param)) 
			return false;
		$updArray = array();
		foreach ($updInfo as $key => $value) {
			$updArray[$key] = ":$key";
			$param[":$key"] = $value;
		}
			

		$num = $this->db->update('orders', array_merge(array('status' => 'status + 1'), $updArray), $sql, $param);
		
		return $num == 1 ? True : False;
	}

	function submitOrder($info = array(), $coupons = array())
	{
		if(!$this->checkInfo($info))
			return False;
		
		$this->db->connect();
		$this->db->beginTransaction();
		$add = '';
		try {
			// $add = isset($info['address']) ? $;
			!isset($info['address']) or ($add = $info['address']);
			unset($info['address']);
			if(empty($add)) {
				$add = $this->db->select(array('address'), 'users', "userid = :userid", array(':userid' => $info['userid']), "S")['row'];
				if(empty($add)) {

					$this->db->commit();
					$this->db->close();
					return False;
				}
				$add = $add['address'];
			}
			$money = $this->db->select(array('total'), 'orders', "userid = :userid AND shopid = :shopid AND status = 0", array(':userid' => $info['userid'], ':shopid' => $info['shopid']), "S")['row'];
			// print_r($info);
			if(empty($money)) {
				$this->db->rollback();
				$this->db->close();	
				return False;
			}
			$money = $money['total'];
			// $this->load->model('couponm');
			$downmoney = 0;
			if(is_array($coupons)) {
				foreach ($coupons as $key => $value) {
					if($value['money'] <= $money) {
						$downmoney =  $value['downmoney'];
					}
				}
			}
			$money = $money - $downmoney;
			
			$res = $this->updStatus(orderCreated, $info, array('address' => $add), array('total' => $money));
			if(!$res) {
				$this->db->rollback();
				$this->db->close();	
				return false;
			}
			$this->db->commit();
			$this->db->close();
			return $res;
		} catch(Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return False;
		}
	}

	

	function payOrder($info = array())
	{
		
		$this->db->connect();
		$this->db->beginTransaction();
		try {
			$res = $this->updStatus(orderSubmitted, $info);
			if(!$res)
				$this->db->rollback();
			else
				$this->db->commit();
			$this->db->close();
			return $res;
		} catch(Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return False;
		}
	}

	function shopAcceptOrder($info = array())
	{
		
		$this->db->connect();
		$this->db->beginTransaction();
		try {
			$res = $this->updStatus(orderPaid, $info);
			if(!$res)
				$this->db->rollback();
			else
				$this->db->commit();
			$this->db->close();
			return $res;
		} catch(Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return False;
		}
	}

	function allocDelivery($info = array())
	{
		
		if(!$this->checkInfo($info))
			return False;
		$this->db->connect();
		$this->db->beginTransaction();
		try {
			$id = $this->db->select(array('deliveryid'), 'available_delivery', "", array(), "S")['row'];
			if(empty($id)) {
				$this->db->commit();
				$this->db->close();
				return False;
			}

			$res = $this->updStatus(orderAccepted, $info, array('deliveryid' => $id));
			if(!$res)
				$this->db->rollback();
			else
				$this->db->commit();
			$this->db->close();
			return $res;
		} catch(Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return False;
		}
	}

	
	function CompleteOrder($info = array())
	{
	
		$this->db->connect();
		$this->db->beginTransaction();
		try {
			$res = $this->updStatus(orderStartDelivery, $info, array('finishtime' => time()));
			if(!$res)
				$this->db->rollback();
			else
				$this->db->commit();
			$this->db->close();
			return $res;
		} catch(Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return False;
		}
	}
}
