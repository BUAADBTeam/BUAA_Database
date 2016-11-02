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
		
		try {
			$this->db->connect();
			// $sql = "SELECT * FROM orderitems
			// 		  WHERE orderid in (SELECT orderid FROM orders 
	  //                 WHERE userid = :userid AND status < 2)"; 
					  
			// $pdo = $this->db->connect();
	        // $sth = $pdo->prepare($sql);
	        // $sth->bindParam(':userid', $userid);
	        // $sth->execute();
	        $result = $this->db->select(array('*'), 'orderitems', 
	        	"orderid in (SELECT orderid FROM orders 
	                  WHERE userid = :userid AND status < 2)", array(':userid' => $userid));
	        $cart = $result['rows'];
	        $this->db->close();
	        return $cart;
	    } catch(PDOException $e) {
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
		if (! is_numeric($amount) || !($amount + 0 > 0)) {
			$this->db->close();
			return False;
		}
		try {
			$this->db->connect();

			// $sql = "SELECT price 
	  //       		FROM products
	  //       		WHERE id = $itemid";
	  //       $sth = $pdo->prepare($sql);
	  //       $sth->execute();
			$result = $this->db->select(array('price'), 'products', "id = $itemid")['row'];
			if (!empty($result))
            	$price = $result['price'];	        
            else {
            	$this->db->close();
            	return False;
            }

            $price *= $amount;

			// $sql = "SELECT orderid FROM orders 
   //                WHERE userid = :userid AND status < 2"; 
            // // $sth = $pdo->prepare($sql);
            // $sth->bindParam(':userid', $userid);
            // $sth->execute();
            $result = $this->db->select(array('orderid'), 'orders', "userid = :userid AND status < 2", array(':userid' => $userid))->row;
            if (count($result) > 0)
            	$orderid = $result['orderid'];
            else {
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
	        	array(':userid' => $userid, ':orderid' => $orderid, ':itemid' => $itemid))['row'];
	        if ($result[0] > 0) {
	        	// $sql = "UPDATE orderitems
	        			// SET amount = amount + $amount
            // 			WHERE userid = :userid  AND orderid = :orderid AND itemid = :itemid";

	         //    $sth = $pdo->prepare($sql);
		        // $sth->bindParam(':userid', $userid);
		        // $sth->bindParam(':orderid', $orderid);
		        // $sth->bindParam(':itemid', $itemid);
		        // $sth->execute();
		        $this->db->update('orderitems', array('amount' => "amount + $amount"), 
		        	"userid = :userid  AND orderid = :orderid AND itemid = :itemid",
		        	array(':userid' => $userid, ':orderid' => $orderid, ':itemid' => $itemid));
	        }
	        else {
				// $sql = "INSERT INTO orderitems(userid, orderid, itemid, amount) 
						  // -- VALUES(:userid, :orderid, :itemid, :amount)"; 	
		        // $sth = $pdo->prepare($sql);
		        // $sth->bindParam(':userid', $userid);
		        // $sth->bindParam(':orderid', $orderid);
		        // $sth->bindParam(':itemid', $itemid);
		        // $sth->bindParam(':amount', $amount);
		        // $sth->execute();
		        $this->db->insert('orderitems', 
		        	array('userid' => ':userid', 'orderid' => ':orderid', 'itemid' => ':itemid', 'amount' => $amount, 'status' => '0'), 
		        		array(':userid' => $userid,
		        			':orderid' => $orderid,
		        			':itemid' => $itemid));
		    }
		    
	        
            $sql = "UPDATE orders
            		SET total = total + $price
            		WHERE orderid = $orderid";
            $this->db->exec($sql);

	        $this->db->close();
	    } catch(PDOException $e) {
	    	$this->db->close();
	    	return False;
	    }

	    return True;
	}

	function delFood($userid, $itemid, $amount)
	{
		if (!is_numeric($amount) || !($amount + 0 > 0)) {
			$this->db->close();
			return False;
		}
		$amount = $amount + 0;
		try {
					  
			$this->db->connect();

			$sql = "SELECT price 
	        		FROM products
	        		WHERE id = $itemid";
	        $this->db->prepare($sql);
	        $result = $this->db->execute($mode = 'SELECT')['row'];
	        // var_dump($result);
	        // // die();
			if(!empty($result))
            	$price = $result['price'];	        
            else {
            	$this->db->close();
            	return False;
            }
            $price *= $amount;

            $result = $this->db->select(array('orderid'), 'orders', 
            	"userid = :userid AND status < 2",
            	array(':userid' => $userid))->row;
            if (!empty($result))
            	$orderid = $result['orderid'];
            else {
            	$this->db->close();
            	return False;
            }


			$result = $this->db->select(array('amount'), 'orderitems',
				"orderid = $orderid AND itemid = :itemid",
				array(':itemid' => $itemid))->row;	        
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
	        	$this->db->close();
	        	return False;
	        }

	        $sql = "UPDATE orders
            		SET total = total - $price
            		WHERE orderid = $orderid";
            $this->db->exec($sql);
	        $this->db->close();
	    } catch(PDOException $e) {
	    	$this->db->close();
	    	return False;
	    }

	    return True;
	}

	function checkStatus($info, $status)
	{
		if(!$this->checkInfo($info))
			return False;

		$this->db->connect();

		$sql = "";
		$param = array();
		foreach ($info as $key=>$val) {
			// if($key != 'address')
			$sql .= " $key = :$key AND";
			$param[":$key"] = $val;
		}
		$sql .= " status < 7";
		$sta = $this->db->select(array('status'), 'orders', $sql, $param);
		if(empty($sta['row']) || $sta['num_rows'] > 1 || $sta['row']['status'] != $status)
			return False;
		return True;
	}

	private function checkInfo($info = array(), $checkaddress = False)
	{
		if(is_array($info)) {
			if(isset($info['userid']) && isset($info['shopid'])) {
				if((count($info) == 2 && !$checkaddress) || (count($info) && !isset($info['address']) && $checkaddress))
					return True;
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
		$this->db->connect();
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
		// $add = isset($info['address']) ? $;
		!isset($info['address']) or ($add = $info['address']);
		unset($info['address']);
		if(empty($add)) {
			$add = $this->db->select(array('address'), 'users', "userid = :userid", array(':userid' => $info['userid']))['row']['address'];
			if(empty($add)) {
				return False;
			}
		}
		$money = $this->db->select(array('total'), 'orders', "userid = :userid AND shopid = :shopid AND status = 0", array(':userid' => $info['userid'], ':shopid' => $info['shopid']))['row']['total'];
		$money = $money - ((new Couponm())->calMoney($info['shopid'], $money));
		// $sql = "";
		// $param = array();
		// foreach ($info as $key=>$val) {
		// 	if($key != 'address')
		// 		$sql .= " $key = :$key AND";
		// 	$param[":$key"] = $val;
		// }
		// $sql .= " status < 2";
		
		// $num = $this->db->update('orders', array('address' => ':address', 'status' => 1), $sql, $param);
		return $this->updStatus($info, array('address' => $add, 'total' => $money));
	}

	

	function payOrder($info = array())
	{
		return $this->updStatus($info);
	}

	function shopAcceptOrder($info = array())
	{
		return $this->updStatus($info);
	}

	function allocDelivery($info = array())
	{
		if(!$this->checkInfo($info))
			return False;
		$this->db->connect();
		$id = $this->db->select(array('deliveryid'), 'deliverymen', "status = 0 ORDER BY credit DESC", array())['row'];
		if(empty($id))
			return False;

		return $this->updStatus($info, array('deliveryid' => $id));
	}

	
	function CompleteOrder($info = array())
	{
		return $this->updStatus($info, array('finishtime' => time()));
	}
}
