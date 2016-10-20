<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Database
{
	function __construct()
	{
		if (!file_exists(APPPATH.'config/database.php')) {
			throw new RuntimeException('Unable to locate the database config');
		}
		include APPPATH.'config/database.php';
		foreach ($dbconfig as $key => $value) {
			$this->$key = $value;
		}
	}


	function connect()
	{
	
		$pdo = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec('SET NAMES "utf8"');
	
		return $pdo;
	}


}
