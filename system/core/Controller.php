<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller {

	public static $instance;

	public function __construct()
	{
		self::$instance =& $this;
		$this->load =& load_class('Loader', 'core');

	}

	public static function &get_instance()
	{
		return self::$instance;
	}

}