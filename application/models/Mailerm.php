<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailerm extends Model {

	function __construct()
	{
		parent::__construct();
	}

	function sendVerifyMail($name, $email, $token)
	{
		require(BASEPATH."mail/class.phpmailer.php"); //这个是一个smtp的php文档，网上可以下载得到
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
		$mail->AddAddress("$address", "a");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
		//$mail->AddReplyTo("", "");

		//$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
		// $mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
		// $mail->SMTPDebug = true;
		$mail->Subject = "点击以继续"; //邮件标题
		$mail->Body = "http://10.138.114.217/dataBase/register/verify&username=$name&token=$token"; //邮件内容，上面设置HTML，则可以是HTML

		if(!$mail->Send())
		{
		    echo "邮件发送失败. <p>";
		    echo "错误原因: " . $mail->ErrorInfo;
		    exit;
		}

	}
	
}

