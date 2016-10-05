<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model
{
	public $db;
	function __construct()
	{
		$this->db =& load_class('Database', 'database');
	}
}