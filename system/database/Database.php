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

		$con = new mysqli($this->hostname, $this->username, $this->password);
		if ($con->connect_error) {
			throw new RuntimeException("Couldn't connect" . mysql_error());
		}
		// mysql_select_db($this->database, $con);
		$con->select_db($this->database);
		// $query = mysql_query($sql);
		$query = $con -> query($sql);
		// mysql_close($con);
		$con->close();
		//TODO return ?
		return mysqli_num_rows($query);
	}
}