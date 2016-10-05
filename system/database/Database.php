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

	function query($sql)
	{

		$con = mysql_connect($this->hostname, $this->username, $this->password);
		if (!$con) {
			throw new RuntimeException("Couldn't connect" . mysql_error());
		}
		mysql_select_db($this->database, $con);
		$query = mysql_query($sql);
		mysql_close($con);
		//TODO return ?
		return mysql_num_rows($query);
	}
}