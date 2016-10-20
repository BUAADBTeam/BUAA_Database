<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cartm extends Model {

	function __construct()
	{
		parent::__construct();
	}

	function getCart($userid)
	{
		
		try {
			$sql = "SELECT * FROM orderitems
					  WHERE orderid in (SELECT orderid FROM orders 
	                  WHERE userid = :userid AND status < 2)"; 
					  
			$pdo = $this->db->connect();
	        $sth = $pdo->prepare($sql);
	        $sth->bindValue(':userid', $userid);
	        $sth->execute();
	        $cart = array();
	        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
	        	$cart[] = $row;
	        }

	        $pdo = null;
	        return $cart;
	    } catch(PDOException $e) {
	    	$pdo = null;
	    	return null;
	    }
	}

	function addFood($userid, $itemid, $amount)
	{
		if(! is_numeric($amount) || !($amount + 0 > 0))
			return False;
		try {
			$pdo = $this->db->connect();

			$sql = "SELECT price 
	        		FROM products
	        		WHERE id = $itemid";
	        $sth = $pdo->prepare($sql);
	        $sth->execute();

			if($result = $sth->fetch(PDO::FETCH_ASSOC))
            	$price = $result['price'];	        
            else 
            	return False;

            $price *= $amount;

			$sql = "SELECT orderid FROM orders 
                  WHERE userid = :userid AND status < 2"; 
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':userid', $userid);
            $sth->execute();
            if($result = $sth->fetch(PDO::FETCH_ASSOC))
            	$orderid = $result['orderid'];
            else
            	return False;

            $sql = "SELECT COUNT(*) 
            		FROM orderitems
            		WHERE userid = :userid  AND orderid = :orderid AND itemid = :itemid"; 
            $sth = $pdo->prepare($sql);
	        $sth->bindValue(':userid', $userid);
	        $sth->bindValue(':orderid', $orderid);
	        $sth->bindValue(':itemid', $itemid);
	        $sth->execute();
	        $result = $sth->fetch();
	        // var_dump($result);
	        if($result[0] > 0) {
	        	$sql = "UPDATE orderitems
	        			SET amount = amount + $amount
            			WHERE userid = :userid  AND orderid = :orderid AND itemid = :itemid";

	            $sth = $pdo->prepare($sql);
		        $sth->bindValue(':userid', $userid);
		        $sth->bindValue(':orderid', $orderid);
		        $sth->bindValue(':itemid', $itemid);
		        $sth->execute();
	        }
	        else {
				$sql = "INSERT INTO orderitems(userid, orderid, itemid, amount) 
						  VALUES(:userid, :orderid, :itemid, :amount)"; 	
		        $sth = $pdo->prepare($sql);
		        $sth->bindValue(':userid', $userid);
		        $sth->bindValue(':orderid', $orderid);
		        $sth->bindValue(':itemid', $itemid);
		        $sth->bindValue(':amount', $amount);
		        $sth->execute();
		    }
		    
	        
            $sql = "UPDATE orders
            		SET total = total + $price
            		WHERE orderid = $orderid";
            $pdo->exec($sql);

	        $pdo = null;
	    } catch(PDOException $e) {
	    	return False;
	    }

	    return True;
	}

	function delFood($userid, $itemid, $amount)
	{
		if(!is_numeric($amount) || !($amount + 0 > 0)) 
			return False;
		$amount = $amount + 0;
		try {
					  
			$pdo = $this->db->connect();

			$sql = "SELECT price 
	        		FROM products
	        		WHERE id = $itemid";
	        $sth = $pdo->prepare($sql);
	        $sth->execute();

			if($result = $sth->fetch(PDO::FETCH_ASSOC))
            	$price = $result['price'];	        
            else 
            	return False;
            $price *= $amount;

			$sql = "SELECT orderid FROM orders 
                  WHERE userid = :userid AND status < 2"; 
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':userid', $userid);
            $sth->execute();
            if($result = $sth->fetch(PDO::FETCH_ASSOC))
            	$orderid = $result['orderid'];
            else
            	return False;

	        $sql = "SELECT amount 
	        		FROM orderitems
					WHERE orderid = $orderid AND itemid = :itemid"; 
	        $sth = $pdo->prepare($sql);
	        $sth->bindValue(':itemid', $itemid);
	        $sth->execute();
	        $result = $sth->fetch();
	        
	        if($result[0] > $amount) {
	        	$sql = "UPDATE orderitems
	        			SET amount = amount - $amount
						WHERE orderid = $orderid AND itemid = :itemid"; 
				$sth = $pdo->prepare($sql);
	        	$sth->bindValue(':itemid', $itemid);
	        	$sth->execute();
	        }
	        else if($result[0] == $amount){

	        	$sql = "DELETE FROM orderitems
						WHERE orderid = $orderid AND itemid = :itemid"; 
				$sth = $pdo->prepare($sql);
	        	$sth->bindValue(':itemid', $itemid);
	        	$sth->execute();
	        }
	        else
	        	return False;

	        $sql = "UPDATE orders
            		SET total = total - $price
            		WHERE orderid = $orderid";
            $pdo->exec($sql);
	        $pdo = null;
	    } catch(PDOException $e) {
	    	return False;
	    }

	    return True;
	}
}
