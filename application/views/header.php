<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$act = array('welcome' => False, 'login' => false, 'register' => False);
$act[empty($_GET) ? 'welcome' : array_keys($_GET)[0]] = True;
?>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<title>BUAA DB</title>

	<script type="text/javascript">BASEURL='<?php echo base_url();?>';</script>
<!-- Bootstrap -->
	<link href="<?php echo base_url()?>static/css/bootstrap.min.css" rel="stylesheet">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script type="text/javascript" src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script type="text/javascript" src="<?php echo base_url()?>static/js/common.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>static/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="menu">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" <?php !$act['welcome'] or print('class="active"')?>><a href="<?php echo base_url()?>">Home</a></li>
			<li role="presentation" <?php !$act['login'] or print('class="active"')?>><a href="login">Login</a></li>
			<li role="presentation" <?php !$act['register'] or print('class="active"')?>><a href="register">Registe</a></li>
		</ul>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
