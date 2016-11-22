<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function &load_class($class, $directory = '', $param = NULL)
{
	static $_classes = array();
	if (isset($_classes[$class])) {
		return $_classes[$class];
	}

	$exist = FALSE;
	foreach (array(BASEPATH, APPPATH) as $path) {
		// print_r($path.$directory.'/'.$class.'.php');
		if (file_exists($path.$directory.'/'.$class.'.php')) {
			if (!class_exists($class)) {
				require_once $path.$directory.'/'.$class.'.php';
			}
			$exist = TRUE;
			break;
		}
	}

	if (!$exist) {
		print_r($path.$directory.'/'.$class.'.php');
		throw new RuntimeException('Unable to locate the specified class: '.$class.'.php');
	}

	$_classes[$class] = $param ? new $class($param) : new $class();
	return $_classes[$class];
}

require_once BASEPATH.'core/Controller.php';

function get_instance()
{
	return Controller::get_instance();
}

function base_url()
{
	global $config;
	return $config['baseurl'];
}

function getRole()
{
	
	// print_r(get_instance());
	// if(!isset($_SESSION['role']) || !is_numeric($_SESSION['role']) || $_SESSION['role'] > 3 || $_SESSION['role'] < 0)
	// 	return 0;
	// return $_SESSION['role'];
	// return 1;
	$it = get_instance();
	$it->load->model('acessm');
	if (!$it->acessm->userIsLoggedIn()) {
		return 0;
	}
	if($it->acessm->userHasRole(userMode)) {
		return userMode;
	}
	else if($it->acessm->userHasRole(shopMode)) {
		return shopMode;
	}
	else if($it->acessm->userHasRole(deliveryMode)) {
		return deliveryMode;
	}
	return 0;
}
// function getRawPost()
// {
// 	foreach (preg_split('/&/', $GLOBALS['HTTP_RAW_POST_DATA']) as $value) {
// 		$d = preg_split('/=/', $value);
// 		$_POST[$d[0]] = urldecode($d[1]);
// 	}
// }
isset($_SESSION) or session_start();
require_once BASEPATH.'core/Router.php';
$router = new Router($url);
$router->work();