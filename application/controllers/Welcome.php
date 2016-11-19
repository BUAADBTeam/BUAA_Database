<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Controller {

	public function index()
	{
		// $a = array();
		// echo "$this->load";
		isset($_SESSION) or session_start();
		$this->load->view('index', isset($_SESSION['user']) ? array('username' => $_SESSION['user']) : array());
	}
}
