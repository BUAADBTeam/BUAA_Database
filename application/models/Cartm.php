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
	        $cart = $result->rows;
	        $this->db->close();
	        return $cart;
	    } catch(PDOException $e) {
	    	$this->db->close();
	    	return null;
	    }
	}

	function addFood($userid, $itemid, $amount)
	{
		if(! is_numeric($amount) || !($amount + 0 > 0)) {
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
			$result = $this->db->select(array('price'), 'products', "id = $itemid")->row;
			if(!empty($result))
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
            if(count($result) > 0)
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
	        	array(':userid' => $userid, ':orderid' => $orderid, ':itemid' => $itemid))->row;
	        if($result[0] > 0) {
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
		        	array('userid' => ':userid', 'orderid' => ':orderid', 'itemid' => ':itemid', 'amount' => $amount), 
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
		if(!is_numeric($amount) || !($amount + 0 > 0)) {
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
	        $result = $this->db->execute($mode = 'SELECT')->row;
	        // var_dump($result);
	        // // die();
			if(!empty($result))
            	$price = $result['price'];	        
            else {
            	$this->db->close();
            	return False;
            }
            $price *= $amount;

			// $sql = "SELECT orderid FROM orders 
   //                WHERE userid = :userid AND status < 2"; 
            // $sth = $pdo->prepare($sql);
            // $sth->bindParam(':userid', $userid);
            // $sth->execute();
            $result = $this->db->select(array('orderid'), 'orders', 
            	"userid = :userid AND status < 2",
            	array(':userid' => $userid))->row;
            if(!empty($result))
            	$orderid = $result['orderid'];
            else {
            	$this->db->close();
            	return False;
            }

	    //     $sql = "SELECT amount 
	    //     		FROM orderitems
					// WHERE orderid = $orderid AND itemid = :itemid"; 
	    //     $sth = $pdo->prepare($sql);
	    //     $sth->bindParam(':itemid', $itemid);
	    //     $sth->execute();
	    //     $result = $sth->fetch();
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
	        else if($result[0] == $amount){

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
}