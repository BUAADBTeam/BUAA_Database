<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mailerm extends Model {
	function __construct()
	{
		parent::__construct();
		require(BASEPATH."mail/class.phpmailer.php");
	}
	function sendVerifyMail($name, $email, $token)
	{
		$mail = new PHPMailer(); //建立邮件发送类
		$mail->CharSet = "UTF-8";
		$address = $email;
		$mail->IsSMTP(); // 使用SMTP方式发送
		$mail->Host = "smtp.126.com"; // 您的企业邮局域名
		$mail->SMTPAuth = true; // 启用SMTP验证功能
		$mail->Username = "bh704788525@126.com"; // 邮局用户名(请填写完整的email地址)
		$mail->Password = "bh621096"; // 邮局密码
		$mail->Port=25;
		$mail->From = "bh704788525@126.com"; //邮件发送者email地址
		$mail->FromName = "点击以继续";
		$mail->AddAddress("$address", "a");
		$mail->Subject = "点击以继续"; //邮件标题
		$host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? 
			$_SERVER['HTTP_X_FORWARDED_HOST'] : 
			(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
		$mail->Body = base_url()."register/verify&username=$name&token=$token"; //邮件内容，上面设置HTML，则可以是HTML
		$mail->Send();
		$filename = 'file.txt';
		file_put_contents($filename, $mail->Body);
		return true;
	}
	
}
