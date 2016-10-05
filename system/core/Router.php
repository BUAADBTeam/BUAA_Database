<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Router {

	function __construct($url)
	{
		$seg = explode('/', trim($url, '/'));
		if (empty($seg)) {
			$seg[] = 'Welcome';
		}
		$cont = ucfirst($seg[0]);
		if (!class_exists($cont)) {
			if (file_exists(APPPATH.'controllers/'.$cont.'.php')) {
				require_once APPPATH.'controllers/'.$cont.'.php';
				if (class_exists($cont, FALSE) && is_subclass_of($cont, 'Controller')) {
					$this->target_cont = new $cont();
					$seg = array_slice($seg, 1);
				}
			}
		}
		if (!isset($this->target_cont)) {
			require_once APPPATH.'controllers/Welcome.php';
			$this->target_cont = new Welcome();
		}

		if (empty($seg)) {
			$seg[] = 'index';
		}
		if (method_exists($this->target_cont, $seg[0])) {
			$this->target_func = $seg[0];
			$seg = isset($seg[1]) ? array_slice($seg, 1) : array();
		}
		else {
			$this->target_func = 'index';
		}
		$this->param = $seg;
	}

	function work()
	{
		call_user_func_array(array($this->target_cont, $this->target_func), $this->param);
	}
}