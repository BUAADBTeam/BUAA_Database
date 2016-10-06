<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testm extends Model {
	public $test = 'test';

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		print_r($this);
	}
	function action()
	{
		echo 'db_result:';
		print_r($this->db->query('select * from category'));
	}

}
