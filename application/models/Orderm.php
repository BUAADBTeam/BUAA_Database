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

	function getSpecificOrder($userid, $status)
	{
		$this->db->connect();
		return $this->db->select('*', 'orders', "userid = :userid AND status = :status", array(':userid' => $userid, ':status' => $status))['rows'];
	}


	function addFood($userid, $itemid, $amount)
	{
		if (! is_numeric($amount) || !($amount + 0 > 0) || !(is_numeric($itemid) && is_numeric($userid))) {
			$this->db->close();
			return False;
		}
		
		$this->db->connect();
		$this->db->beginTransaction();
		try {
			// $sql = "SELECT price 
	  //       		FROM products
	  //       		WHERE id = $itemid";
	  //       $sth = $pdo->prepare($sql);
	  //       $sth->execute();
			$result = $this->db->select(array('price'), 'products', "id = $itemid", "S")['row'];
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
            $result = $this->db->select(array('orderid'), 'orders', "userid = :userid AND status < 2", array(':userid' => $userid), "S")->row;
            if (count($result) > 0)
            	$orderid = $result['orderid'];
            else {
            	$this->db->commit();
            	$this->db->close();
            	return False;
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
		        	$this->db->rollback()
		        	$this->db->close();
		        	return False;
		        }
	        }
	        else {
				
		        $this->db->insert('orderitems', 
		        	array('userid' => ':userid', 'orderid' => ':orderid', 'itemid' => ':itemid', 'amount' => $amount, 'status' => '0'), 
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
	        		FROM products
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
            	array(':userid' => $userid), "S")->row;
            if (!empty($result))
            	$orderid = $result['orderid'];
            else {
            	$this->db->commit();
            	$this->db->close();
            	return False;
            }


			$result = $this->db->select(array('amount'), 'orderitems',
				"orderid = $orderid AND itemid = :itemid",
				array(':itemid' => $itemid), "S")->row;	        
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

	private function updStatus($info = array(), $updInfo = array())
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

		$updArray = array();
		foreach ($updInfo as $key => $value) {
			$updArray[$key] = ":$key";
			$param[":$key"] = $value;
		}
			

		$num = $this->db->update('orders', array_merge(array('status' => 'status + 1'), $updArray), $sql, $param);
		$this->db->close();
		return $num == 1 ? True : False;
	}

	function submitOrder($info = array())
	{
		if(!$this->checkInfo($info))
			return False;
		
		$this->db->connect();
		$this->beginTransaction();
		try {
			// $add = isset($info['address']) ? $;
			!isset($info['address']) or ($add = $info['address']);
			unset($info['address']);
			if(empty($add)) {
				$add = $this->db->select(array('address'), 'users', "userid = :userid", array(':userid' => $info['userid']), "S")['row']['address'];
				if(empty($add)) {
					$this->db->commit();
					$this->db->close();
					return False;
				}
			}
			$money = $this->db->select(array('total'), 'orders', "userid = :userid AND shopid = :shopid AND status = 0", array(':userid' => $info['userid'], ':shopid' => $info['shopid']), "S")['row']['total'];
			if(!isset($money)) {
				$this->db->rollback();
				$this->db->close();	
			}
			$money = $money - ((new Couponm())->calMoney($info['shopid'], $money));

			$res = $this->updStatus($info, array('address' => $add, 'total' => $money));
			if(!$res) {
				$this->db->rollback();
				$this->db->close();	
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
			$res = $this->updStatus($info);
			if(!$res)
				$this->db->rollback();
			else
				$this->db->commit();
			$this->db->close();
			return $res;
		} catch(Exception $e) {
			$this->db->rollback();
			$this->db->close()
			return False;
		}
	}

	function shopAcceptOrder($info = array())
	{
		
		$this->db->connect();
		$this->db->beginTransaction();
		try {
			$res = $this->updStatus($info);
			if(!$res)
				$this->db->rollback();
			else
				$this->db->commit();
			$this->db->close();
			return $res;
		} catch(Exception $e) {
			$this->db->rollback();
			$this->db->close()
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
			$id = $this->db->select(array('deliveryid'), 'deliverymen', "status = 0 ORDER BY credit DESC", array(), "S")['row'];
			if(empty($id)) {
				$this->db->commit();
				$this->db->close();
				return False;
			}

			$res = $this->updStatus($info, array('deliveryid' => $id));
			if(!$res)
				$this->db->rollback();
			else
				$this->db->commit();
			$this->db->close();
			return $res;
		} catch(Exception $e) {
			$this->db->rollback();
			$this->db->close()
			return False;
		}
	}

	
	function CompleteOrder($info = array())
	{
	
		$this->db->connect();
		$this->db->beginTransaction();
		try {
			$res = $this->updStatus($info, array('finishtime' => time()));
			if(!$res)
				$this->db->rollback();
			else
				$this->db->commit();
			$this->db->close();
			return $res;
		} catch(Exception $e) {
			$this->db->rollback();
			$this->db->close()
			return False;
		}
	}
}
