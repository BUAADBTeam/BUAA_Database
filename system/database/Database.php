<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Database {
 
 public $SqlBug = ''; // 记录mysql调试语句，可以查看完整的执行的mysql语句
 private $pdo = null; // pdo连接
 private $statement = null;
 
 public function __construct($port = "3306") {
 	if (!file_exists(APPPATH.'config/database.php')) {
			throw new RuntimeException('Unable to locate the database config');
		}
	include APPPATH.'config/database.php';
	foreach ($dbconfig as $key => $value) {
		$this->$key = $value;
	}
    try {
      $this->pdo = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
    } catch(PDOException $e) {
        trigger_error('Error: Could not make a database link ( ' . $e->getMessage() . '). Error Code : ' . $e->getCode() . ' <br />');
    }

    $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $this->pdo->exec('SET NAMES "utf8"');
    $this->pdo->exec('SET CHARACTER SET "utf8"');
    $this->pdo->exec('SET CHARACTER_SET_CONNECTION= "utf8"');
    // $this->pdo->exec("SET SQL_MODE = ''");
 
 }
 
 public function prepare($sql) {
    $this->statement = $this->pdo->prepare($sql);
    $this -> SqlBug .= "\n". '<!--DebugSql: ' . $sql . '-->' . "\n";
 }
 
 public function bindParam($parameter, $variable, $data_type = PDO::PARAM_STR, $length = 0) {
   if ($length) {
     $this->statement->bindParam($parameter, $variable, $data_type, $length);
   } else {
     $this->statement->bindParam($parameter, $variable, $data_type);
   }
 }
 
 public function execute() {
   try {
     if ($this->statement && $this->statement->execute()) {
       $data = array();
 
       while ($row = $this->statement->fetch(PDO::FETCH_ASSOC)) {
         $data[] = $row;
       }
 
     $result = new stdClass();
     $result->row = (isset($data[0])) ? $data[0] : array();
     $result->rows = $data;
     $result->num_rows = $this->statement->rowCount();
     }
   } catch(PDOException $e) {
     trigger_error('Error: ' . $e->getMessage() . ' Error Code : ' . $e->getCode());
   }
 }
 
 public function query($sql, $params = array(), $type = 'SELECT') {
 	print_r($params);
   $this->statement = $this->pdo->prepare($sql);
   $result = false;
   $this -> SqlBug .= "\n". '<!--DebugSql: ' . $sql . '-->' . "\n";

   try {
     if ($this->statement && $this->statement->execute($params)) {
	   $data = array();
	   while ($type == 'SELECT' && $row = $this->statement->fetch(\PDO::FETCH_ASSOC)) {
	     $data[] = $row;
	   }
	   $result = new \stdClass();
	   $result->row = (isset($data[0]) ? $data[0] : array());
	   $result->rows = $data;
	   $result->num_rows = $this->statement->rowCount();
     }
 } catch (PDOException $e) {
   trigger_error('Error: ' . $e->getMessage() . ' Error Code : ' . $e->getCode() . ' <br />' . $sql);
   exit();
 }
 
   if ($result) {
     return $result;
     } else {
       $result = new stdClass();
       $result->row = array();
       $result->rows = array();
       $result->num_rows = 0;
       return $result;
    }
 }
 
 public function executeUpdate($sql) {
   return $this->pdo->exec($sql);
 }
 
 /**
 * 获得所有查询条件的值
 */
 public function fetchAll($sql, $params = array()) {
   $rows = $this->query($sql, $params)->rows;
   return !empty($rows) ? $rows : false;
 }
 
 /**
 * 获得单行记录的值
 */
 public function fetchAssoc($sql, $params = array()) {
   $row = $this->query($sql, $params)->row;
   return !empty($row) ? $row : false;
 }
 
 /**
 * 获得单个字段的值
 */
 public function fetchColumn($sql, $params = array()) {
   $data = $this->query($sql, $params)->row;
   if(is_array($data)) {
   foreach ($data as $value) {
     return $value;
   }
 }
 return false;
 }
 
 /**
 * 返回statement记录集的行数
 */
 public function rowCount($sql, $params = array()) {
   return $this->query($sql, $params)->num_rows;
 }
 
 /**
 * 插入数据
 * @param string $table 表名
 * @param Array $data 数据
 * @return int InsertId 新增ID
 */
 public function insert($table, $data, $params = array()) {
 
   if (!is_array($data) || count($data) == 0) {
     return 0;
   }
   $field_arr = array();
   $value_arr = array();
   foreach ($data as $key=>$val) {
     $field_arr[] = "$key ";
     $value_arr[] = "$val ";
   }
   $sql = "INSERT INTO " . $table . "(" . implode(',', $field_arr);
   $sql .= (") ". "VALUES(". implode(',', $value_arr). ")");
   $this -> query($sql, $params, $type = 1);
   return $this->getLastId();
 }
 
 /**
 * 更新数据
 * @param string $table 表名
 * @param Array $data 数据
 * @param string $where 更新条件
 * @return int 影响数
 */
 public function update($table, $data, $where = '', $params = array()) {
   if(empty($where)) {
     return 0;
   }
   if (!is_array($data) || count($data) == 0) {
     return 0;
   }
   $field_arr = array();
   foreach ($data as $key=>$val) {
     $field_arr[] = " `$key` = $val ";
   }
   $sql = "UPDATE " . $table . " SET " . implode(',', $field_arr) . " WHERE " . $where;
   return $this->query($sql, $params, $type = 1)->num_rows;
 }
 
 /**
 * 获得影响集合中
 */
 public function delete($table, $where = "", $params = array()) {
   if(empty($where)) {
     return 0;
   }
   $sql = "DELETE FROM " . $table . " WHERE " . $where;
   return $this->query($sql, $params, $type = 1)->num_rows;
 }
 
 /**
 * 获得影响集合中
 */
 public function countAffected() {
   if ($this->statement) {
     return $this->statement->rowCount();
   } else {
     return 0;
   }
 }
 
 /*
 * 获得插入id
 */
 public function getLastId() {
   return $this->pdo->lastInsertId();
 }
 
 public function escape($value) {
   $search = array("\\", "\0", "\n", "\r", "\x1a", "'", '"');
   $replace = array("\\\\", "\\0", "\\n", "\\r", "\Z", "\'", '\"');
   return str_replace($search, $replace, $value);
 }
 
 /**
 * 返回错误信息也包括错误号
 */
 public function errorInfo() {
   return $this->statement->errorInfo();
 }
 
 /**
 * 返回错误号
 */
 public function errorCode() {
   return $this->statement->errorCode();
 }
 
 public function __destruct() {
   $this->pdo = null;
 }
}
