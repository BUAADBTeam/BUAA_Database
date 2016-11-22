<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('testm');
		$this->load->model('mailerm');
		$this->load->model('acessm');
		$this->load->model('orderm');
		$this->load->model('uploadm');
	}

	public function index()
	{
		// $res = $this->orderm->getSpecificOrders(43, userMode);
		// print_r($res);
		echo '    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
    <html xmlns="http://www.w3.org/1999/xhtml">  
    <head>  
        <title></title>  
    </head>  
    <body>  
        <form action="Register/registerPhoto" method="post" enctype="multipart/form-data">  
        选择要上传的图片：<input type="file" name="fileUp" />  
        <input type="submit" value="上传" />  
    </form>  
    </body>  
    </html>  ';
		echo "<img src='http://qr.liantu.com/api.php?&w=200&text=http://baidu.com'>";
	}
	public function post()
	{
		print_r($_POST);
	}
	public function role()
	{
		echo getRole();
	}

	public function upload()
	{
		$name;
		if($this->uploadm->upload("static\src\\", $name)) {
			echo "right".$name;
		}
		else {
			print(BASEPATH."files");
			echo "fuck";
		}
		// echo realpath('.');
	}
}
