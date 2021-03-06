<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Database {
	
	public $SqlBug = ''; // 记录mysql调试语句，可以查看完整的执行的mysql语句
	private $pdo = null; // pdo连接
	private $statement = null;
	private $is_connected = false;
	private $username = "";
	private $password = "";

	public function __construct() {
		if (!file_exists(APPPATH.'config/database.php')) {
			throw new RuntimeException('Unable to locate the database config');
		}
		include APPPATH.'config/database.php';
		foreach ($dbconfig as $key => $value) {
			$this->$key = $value;
		}
		$this->username = $this->user_pass['username'][4];	
		$this->password = $this->user_pass['password'][4];
			// $this->pdo->exec("SET SQL_MODE = ''");
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

	public function selectRole($role = 4)
	{
		if(!is_numeric($role) || $role > 4 || $role < 0)
			return false;
		$this->username = $this->user_pass['username'][$role];
		$this->password = $this->user_pass['password'][$role];
		return true;
	}

	public function connect() {
		if($this->is_connected)
			return ;
		try {
			$this->pdo = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
		} catch(PDOException $e) {
			trigger_error('Error: Could not make a database link ( ' . $e->getMessage() . '). Error Code : ' . $e->getCode() . ' <br />');
		}

		$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$this->pdo->exec('SET NAMES "utf8"');
		$this->pdo->exec('SET CHARACTER SET "utf8"');
		$this->pdo->exec('SET CHARACTER_SET_CONNECTION= "utf8"');
		$this->is_connected = true;
	}

	public function beginTransaction() {
		$this->pdo->beginTransaction();
	}

	public function rollback() {
		$this->pdo->rollback();
	}

	public function commit() {
		// if($this->is_connected)
		$this->pdo->commit();
	}

	public function prepare($sql) {
		$this->statement = $this->pdo->prepare($sql);
		// $this -> SqlBug .= "\n". '<!--DebugSql: ' . $sql . '-->' . "\n";
	}
	
	public function bindParam($parameter, $variable) {
		
		$this->statement->bindParam($parameter, $variable);
		
	}
	
	public function execute($mode = '', $params = array()) {
		try {
			if ($this->statement && $this->statement->execute($params)) {
				$data = array();

				while (!empty($mode) && $row = $this->statement->fetch()) {
					$data[] = $row;
				}
				$result = array();
				$result['row'] = (isset($data[0])) ? $data[0] : array();
				$result['rows'] = $data;
				$result['num_rows'] = $this->statement->rowCount();
			}
		} 
		catch(PDOException $e) {
				// print_r($mode);
				return array('row' => array(), 'rows' => array(), 'num_rows' => 0);
			}

		if ($result) {
			return $result;
		}
		else {
			return array('row' => array(), 'rows' => array(), 'num_rows' => 0);
		}
	}
	
	public function query($sql, $params = array(), $type = 'SELECT') {
		$this->statement = $this->pdo->prepare($sql);
		$result = false;
		$this -> SqlBug .= "\n". '<!--DebugSql: ' . $sql . '-->' . "\n";
		// print_r($params);
		try {
			if ($this->statement && $this->statement->execute($params)) {
				$data = array();
				while ($type === 'SELECT' && $row = $this->statement->fetch()) {
					$data[] = $row;
				}
				$result = array();
				$result['row'] = (isset($data[0]) ? $data[0] : array());
				$result['rows'] = $data;
				$result['num_rows'] = $this->statement->rowCount();
			}
		} catch (PDOException $e) {
			print($e->getMessage());
			return array('row' => array(), 'rows' => array(), 'num_rows' => 0);
		}

		if ($result) {
			return $result;
		} 
		else {
			return array('row' => array(), 'rows' => array(), 'num_rows' => 0);
		}
	}
	
	public function exec($sql) {
		return $this->pdo->exec($sql);
	}

	public function select($data, $table, $where , $params = array(), $Lock = NULL) {
		if(empty($where) || !is_string($where)) {
				throw new Exception('emptyWhere');
		}
		if (!is_array($data) || count($data) == 0) {
				throw new Exception('noColomnFound');
		}
		if($Lock === "S") {
			$Lock = " LOCK IN SHARE MODE";
		}
		elseif ($Lock === "X") {
			$Lock = " FOR UPDATE";
		}
		else
			$Lock = "";
		$field_arr = array();
		foreach ($data as $key=>$val) {
				!$this->validType($val) or $field_arr[] = "$val";
		}
		$sql = "SELECT " .implode(', ', $field_arr) .' FROM ' .$table ." WHERE " . ($where . $Lock);
		// echo "$sql"."<br>\n";
		return $this->query($sql, $params);
	}


	public function insert($table, $column, $params = array()) {
		if (!is_array($column) || count($column) == 0) {
			throw new Exception(noColomnFound);
		}
		$field_arr = array();
		$value_arr = array();
		foreach ($column as $key=>$val) {
			if($this->validType($key) && $this->validType($val)) {
				$field_arr[] = "$key ";
				$value_arr[] = "$val ";
			}
		}
		$sql = "INSERT INTO " . $table . "(" . implode(',', $field_arr);
		$sql .= (") ". "VALUES(". implode(',', $value_arr). ")");
		if ($this -> query($sql, $params, $type = 1)['num_rows'] == 0) {
			throw new Exception("Fail to insert", 1);
		}
		return $this->pdo->lastInsertId();
	}
	
	
	public function update($table, $column, $where = '', $params = array()) {
		if(empty($where) || !is_string($where)) {
			throw new Exception(emptyWhere);
		}
		if (!is_array($column) || count($column) == 0) {
			throw new Exception(noColomnFound);
		}
		$field_arr = array();
		foreach ($column as $key=>$val) {
			if($this->validType($key) && $this->validType($val)) {
				$field_arr[] = " $key = $val ";
			}
		}
		$sql = "UPDATE " . $table . " SET " . implode(',', $field_arr) . " WHERE " . $where;
		// print($sql);
		// print_r($params);
		return $this->query($sql, $params, $type = 1)['num_rows'];
	}
	
	/**
	* 获得影响集合中
	*/
	public function delete($table, $where = "", $params = array()) {
		if(empty($where) || !is_string($where)) {
			throw new Exception(emptyWhere);
		}
		$sql = "DELETE FROM " . $table . " WHERE " . $where;
		return $this->query($sql, $params, $type = 1)['num_rows'];
	}
	
	public function close() {
		$this->pdo = null;
		$this->is_connected = false;
	}
	
}
