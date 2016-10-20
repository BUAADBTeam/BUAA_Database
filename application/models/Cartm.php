<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cartm extends Model {

	function __construct()
	{
		parent::__construct();
	}

	function getCart($userid)
	{
		

		$sql = "SELECT * FROM orderitems
				  WHERE orderid in (SELECT orderid FROM orders 
                  WHERE userid = ". $userid. "AND status < 2;)"; 
				  
		$pdo = $this->db->connect();
        $sth = $pdo->prepare($sql);
        $sth->excute();
        $cart = array();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
        	$cart[] = $row;
        }

        $pdo = null;
        return $cart;
	}

	function addFood($userid, $itemid, $amount)
	{
		if(! is_numeric($amount) || !($amount + 0 > 0))
			return False;
		try {
			$pdo = $this->db->connect();
			$sql = "SELECT orderid FROM orders 
                  WHERE userid = :userid AND status < 2"; 
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':userid', $userid);
            $sth->excute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            $orderid = $result['orderid'];

			$sql = "INSERT INTO orderitems(userid, orderid, itemid, amount) 
					  VALUES(:userid, :orderid, :itemid, :amount)"; 
					  
			
	        $sth = $pdo->prepare($sql);
	        $sth->bindValue(':userid', $userid);
	        $sth->bindValue(':orderid', $orderid);
	        $sth->bindValue(':itemid', $itemid);
	        $sth->bindValue(':amount', $amount);
	        $sth->excute();

	        $sql = "SELECT price 
	        		FROM product
	        		WHERE id = $itemid";
	        $sth = $pdo->prepare($sql);
	        $sth->excute();
			$result = $sth->fetch(PDO::FETCH_ASSOC);
            $price = $result['price'];	        

            $price *= $amount;

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

		try {
					  
			$pdo = $this->db->connect();

			$sql = "SELECT orderid FROM orders 
                  WHERE userid = :userid AND status < 2"; 
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':userid', $userid);
            $sth->excute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            $orderid = $result['orderid'];

	        $sql = "SELECT amount 
	        		FROM orderitems
					WHERE orderid = $orderid AND itemid = :itemid"; 
	        $sth = $pdo->prepare($sql);
	        $sth->bindValue(':itemid', $itemid);
	        $sth->excute();
	        $result = $sth->fetch();

	        if($result[0] > $amount) {
	        	$sql = "UPDATE orderitems
	        			SET amount = amount - $amount
						WHERE orderid = $orderid AND itemid = :itemid"; 
				$sth = $pdo->prepare($sql);
	        	$sth->bindValue(':itemid', $itemid);
	        	$sth->excute();
	        }
	        else{
	        	$sql = "DELETE orderitems
						WHERE orderid = $orderid AND itemid = :itemid"; 
				$sth = $pdo->prepare($sql);
	        	$sth->bindValue(':itemid', $itemid);
	        	$sth->excute();
	        }
	        $pdo = null;
	    } catch(PDOException $e) {
	    	return False;
	    }

	    return True;
	}
}
