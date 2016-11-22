<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopm extends Model {
	
	var $cuisine = 'cuisine';
	var $shop = 'shop';

	public function __construct()
	{
		parent::__construct();
	}

	public function add($sid, $filename)
	{
/*INSERT INTO `db`.`cuisine` (`id`, `sid`, `name`, `pic`, `price`, `info`, `st`) VALUES 
(NULL, '0', 'Maecenas ornare enim', 'static/images/1.jpg', '45.00', 'Cum sociis natodiculus mus.rhoncus egestas ac sit', '0'), 
(NULL, '0', 'Dis parturient montes', 'static/images/3.jpg', '55.00', 'Cum sociis natodiculus mus.rhoncus egestas ac sit', '0'),
(NULL, '0', 'Curabitur congue blandit', 'static/images/4.jpg', '65.00', 'Cum sociis natodiculus mus.rhoncus egestas ac sit', '0'),
(NULL, '0', 'Maecenas ornare enim', 'static/images/1.jpg', '45.00', 'Cum sociis natodiculus mus.rhoncus egestas ac sit', '0'), 
(NULL, '0', 'Dis parturient montes', 'static/images/3.jpg', '55.00', 'Cum sociis natodiculus mus.rhoncus egestas ac sit', '0'),
(NULL, '0', 'Curabitur congue blandit', 'static/images/4.jpg', '65.00', 'Cum sociis natodiculus mus.rhoncus egestas ac sit', '0'),
(NULL, '0', 'Maecenas ornare enim', 'static/images/1.jpg', '45.00', 'Cum sociis natodiculus mus.rhoncus egestas ac sit', '0'), 
(NULL, '0', 'Dis parturient montes', 'static/images/3.jpg', '55.00', 'Cum sociis natodiculus mus.rhoncus egestas ac sit', '0'),
(NULL, '0', 'Dis parturient montes', 'static/images/3.jpg', '55.00', 'Cum sociis natodiculus mus.rhoncus egestas ac sit', '1'),
(NULL, '0', 'Curabitur congue blandit', 'static/images/4.jpg', '65.00', 'Cum sociis natodiculus mus.rhoncus egestas ac sit', '0');*/
		if (!isset($_POST['name']) || !isset($_POST['price'])) {
			return FALSE;
		}
		if(!is_string($_POST['name']) || !is_numeric($_POST['price'])) {
			return FALSE;
		}
		if(isset($_POST['st']) && ($_POST['st'] != 0 && $_POST['st'] != 1)) {
			return FALSE;
		}
		try {
			$this->db->connect();
			$this->db->beginTransaction();
			$column = array('name' => ':name', 'pic' => ':pic', 'price' => ':price', 'sid' => ':sid', 'st' => ':st');
			$params = array(':name' => $_POST['name'], ':pic' => $filename, ':price' => $_POST['price'], ':sid' => $sid, ':st' => isset($_POST['st']) ? $_POST['st'] : 1);
			if ($this->db->insert($this->cuisine, $column, $params) == FALSE) {
				$this->db->rollback();
				$this->db->close();
				return FALSE;
			}
			$this->db->commit();
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return FALSE;
		}
	}

	public function del($sid, $cid)
	{
		try {
			$this->db->connect();
			$this->db->beginTransaction();
			$this->db->delete($this->cuisine, "sid = :sid and id = :cid", array(':sid' => $sid, ':cid' => $cid));
			$this->db->commit();
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return FALSE;
		}
	}

	public function put($sid, $cid)
	{
		try {
			$this->db->connect();
			$this->db->beginTransaction();
			$this->db->update($this->cuisine, array('st' => '0'), "sid = :sid and id = :cid", array(':sid' => $sid, ':cid' => $cid));
			$this->db->commit();
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return FALSE;
		}
	}

	public function off($sid, $cid)
	{
		try {
			$this->db->connect();
			$this->db->beginTransaction();
			$this->db->update($this->cuisine, array('st' => '1'), "sid = :sid and id = :cid", array(':sid' => $sid, ':cid' => $cid));
			$this->db->commit();
			$this->db->close();
			return TRUE;

		} catch (Exception $e) {
			$this->db->rollback();
			$this->db->close();
			return FALSE;
		}
	}

	public function getCuisineList($sid = 0, $All = FALSE)
	{
		$this->db->connect();
		$this->db->beginTransaction();
		$res = $this->db->select(array('*'), $this->cuisine, 'sid = :sid' . ($All ? '' : ' and st=0'), array(':sid' => $sid), 'S');
		$this->db->commit();
		$this->db->close();
		if ($res == 0) {
			return null;
		}
		return $res['rows'];
	}

	public function getRecommandList()
	{
		// $this->shopm->getRecommandList();
		$res = array();
		for ($i = 0; $i < 16; $i++) {
			$res[] = array('id' => rand(1, 4), 'name' => '美食街', 'pic' => '', 'addr' => '233');
		}
		// print_r($res);
		return $res;
	}

	public function changePhoto($userid, $filename)
	{
      $this->db->connect();
      $this->db->beginTransaction();
      try { 
        $num = $this->db->update('shop', array('pic' => ':pic'), "id = :id", array(':pic' => $filename, ':id' => $userid));
        if($num != 1)
          return FALSE;
      } catch (Exception $e) {
        $this->db->rollback();
        $this->db->close();
        return False;
      }
      $this->db->commit();
      $this->db->close();
      return True;
  }
}