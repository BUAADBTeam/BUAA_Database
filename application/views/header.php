<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$act = array('welcome' => False, 'login' => false, 'register' => False);
$act[empty($_GET) ? 'welcome' : array_keys($_GET)[0]] = True;
?>
<html lang="zh-cn">
<head>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Cooker</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="stylesheet" href="<?php echo base_url()?>static/css/style.css?v=2">
  <link rel="stylesheet" href="//cdn.bootcss.com/jcarousel/0.3.4/jquery.jcarousel.js">

  <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
  <script src="<?php echo base_url()?>static/js/libs/modernizr-1.7.min.js"></script>
  
</head>

