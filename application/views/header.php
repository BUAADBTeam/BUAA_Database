<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>DB</title>
<head>
    <meta charset="utf-8">
    <link href="<?php echo base_url();?>static/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo base_url();?>static/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script> -->
    <script src="<?php echo base_url();?>static/js/jquery.min11.js"></script>
    <script src="<?php echo base_url();?>static/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>static/js/md5.js"></script>
    <script src="<?php echo base_url();?>static/js/jquery.min.js"></script>
    <!-- <script src="<?php echo base_url();?>static/js/simpleCart.min.js"> </script> -->
    <script src="<?php echo base_url();?>static/js/common.js"> </script>
    <script type="text/javascript">BASEURL='<?php echo base_url();?>';</script>
    <script type="text/javascript">ROLE=<?php echo getRole();?>;</script>

<body>
<body>
<!-- header -->
<div class="head-top"></div>
<div class="header">
    <div class="container">
        <div class="logo">
            <a href="index.html"><img src="<?php echo base_url();?>static/images/logo.png" class="img-responsive" alt=""></a>
        </div>
        <div class="header-left">
            <div class="head-nav">
                <span class="menu"> </span>
                <ul>
                    <li id="headerHome"><a href="<?php echo base_url();?>welcome">主页</a></li>
                    <li id="headerResturants"><a href="<?php echo base_url();?>shop">餐厅</a></li>
                    <li id="headerResturants" style="display:none"><a href="<?php echo base_url();?>shop"></a></li>
                    <li id="headerShop" style="display:none"><a href="<?php echo base_url();?>shop/manage">我的餐厅</a></li>
                    <li id="headerOrder" style="display:none;" onmouseover="dspl()" onmouseout="$('.submenu').attr('style', 'display:none');">
                        <a href="<?php echo base_url();?>order">我的订单</a>
                        <ul class="submenu" style="display: none">
                            <li id="headerHome" style="display:block;"><a href="<?php echo base_url();?>welcome">全部订单</a></li>
                            <li id="headerHome" style="display:block;"><a href="<?php echo base_url();?>welcome">等待发货</a></li>
                            <li id="headerHome" style="display:block;"><a href="<?php echo base_url();?>welcome">等待收货</a></li>
                            <li id="headerHome" style="display:block;"><a href="<?php echo base_url();?>welcome">等待评价</a></li>
                        </ul>
                        <script type="text/javascript">
                            function dspl() {
                                //alert($('#headerOrder'));
                                $('.submenu').attr('style', 'position: absolute;');
                            }

                        </script>
                    </li>
                    <li id="headerSignIn"><a href="" data-toggle="modal" data-target="#mymodal-signin">登陆</a></li>
                    <li id="headerSignOut" style="display:none"><a href="">登出</a></li>
                    <li id="headerRegister" style="display:none"><a href="" data-toggle="modal" data-target="#mymodal-register">注册</a></li>
                    <div class="clearfix"> </div>
                </ul>
                <!-- script-for-nav -->
                <script>
                    $( "span.menu" ).click(function() {
                      $( ".head-nav ul" ).slideToggle(300, function() {
                        // Animation complete.
                      });
                    });
                    if (isUser() || isShop() || isDelivery()) {
                        $('#headerSignIn').attr('style', 'display:none');
                        $('#headerOrder').attr('style', '');
                        $('#headerSignOut').attr('style', '');
                    }
                    if (isShop()) {
                        $('#headerShop').attr('style', '');
                    }
                </script>
                <!-- script-for-nav -->
            </div>
            <div class="header-right1">
                <div class="cart box_1">
                    
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!-- header -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">登陆</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="mymodal-signin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title lead">登录</h4>
            </div>
            <div class="modal-body">
                <form id="login_form" class="form-horizontal" role="form" method="post">
                    <input type="hidden" name="_token" value="R5gsW4ojTAXtGfwlp4lfX9X64y9uP2n2ceyTZ76d">
                    <div class="alert alert-danger" role="alert" id="loginAlert" style="display:none;height:30px;padding:5px;">
                        <span class="glyphicon glyphicon-remove-sign"></span><span id="loginErrorMessage">&nbsp; </span>
                    </div>
                    <div class="form-group">
                        <label for="InputAccount" class="col-md-2 control-label">用户名</label>
                        <div class="input-group col-md-9">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input id="username" class="form-control" id="InputAccount" placeholder="请输入您的用户名/邮箱" name="username" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword" class="col-md-2 control-label">密码</label>
                        <div class="input-group col-md-9">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-eye-close"></span></span>
                            <input id="password" type="password" class="form-control" id="InputPassword" placeholder="请输入您的密码" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-3" style="float:right"><a href="">忘记密码?</a></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="login_submit" onclick="PostLogin()" class="btn btn-primary btn-lg btn-block lead"><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;&nbsp;登录！&nbsp; </button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    loginSuccess = function(data) {
        if(data.status==1 || data.status==2 || data.status==3){
            $('#loginAlert').attr('style','display:none;height:30px;padding:5px;');
            window.location.reload();
        }
        else{
            $('#loginAlert').attr('style','height:30px;padding:5px;');
            if(data.status==904){
                $('#loginErrorMessage').text("账号或密码不能为空");
            }
            else if(data.status==101){
                $('#loginErrorMessage').text("用户名或密码错误");
            }
            else{
                $('#loginErrorMessage').text("未知错误");
            }
        }
    };
    loginError = function(data) {
        alert("Something amazing happened! Please try again later.");
    };
    function PostLogin() {
        url = BASEURL + 'login/check';
        if($('#username').val() == '' || $('#password').val() == '') {
            $('#loginAlert').attr('style','height:30px;padding:5px;');
            $('#loginErrorMessage').text("账号或密码不能为空");
            return ;
        }
        ajax_send(url,{user:encodeURI($('#username').val()), pass:encodeURI($('#password').val()), action:encodeURI('login')},loginSuccess,loginError);
    };
</script>
