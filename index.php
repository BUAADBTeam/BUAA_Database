<?php
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);

$system_path = 'system';
$application_folder = 'application';
$view_folder = '';
//system -> BASEPATH
if (($tmp = realpath($system_path)) !== FALSE) {
	$system_path = $tmp.'/';
}
else {
	$system_path = rtrim($system_path).'/';
}
if (!is_dir($system_path)) {
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
	exit(3);
}
define('BASEPATH', str_replace('\\', '/', $system_path));

//application -> APPPATH
if (is_dir($application_folder)) {
	$application_folder = realpath($application_folder);
	define('APPPATH', str_replace('\\', '/', $application_folder.'/'));
}
else {
	if (!is_dir(BASEPATH.$application_folder.'/')) {
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
		exit(3);
	}
	define('APPPATH', str_replace('\\', '/', BASEPATH.$application_folder.'/'));
}

//view -> VIEWPATH
if (empty($view_folder)) {
	$view_folder = 'views';
}
if (is_dir($view_folder)) {
	$view_folder = realpath($view_folder).'/';
	define('VIEWPATH', $view_folder);
}
else {
	// echo APPPATH;
	if (!is_dir(APPPATH.$view_folder.'/')) {
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME)."<br />";
	}
	define('VIEWPATH', APPPATH.$view_folder.'/');
}

require APPPATH.'config/config.php';
$url = empty($_GET) ? '' : array_keys($_GET)[0];

require_once BASEPATH.'core/core.php';