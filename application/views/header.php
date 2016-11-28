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
                    <li id="headerShop" style="display:none" onmouseover="dspl('#headerShop')" onmouseout="$('#headerShop .submenu').attr('style', 'display:none');">
                        <a href="<?php echo base_url();?>shop/manage">我的餐厅</a>
                        <ul class="submenu" style="display: none">
                            <li id="headerHome" style="display:block;"><a href="" data-toggle="modal" data-target="#mymodal-addcusine">新增菜品</a></li>
                        </ul>
                    </li>
                    <li id="headerOrder" style="display:none;" onmouseover="dspl('#headerOrder')" onmouseout="$('#headerOrder .submenu').attr('style', 'display:none');">
                        <a href="<?php echo base_url();?>order">我的订单</a>
                        <ul class="submenu" style="display: none">
                            <li id="headerHome" style="display:block;"><a href="#" onclick="updateOrder(0,7)">全部订单</a></li>
                            <li id="headerHome" style="display:block;"><a href="#" onclick="updateOrder(1,1)">等待付款</a></li>
                            <li id="headerHome" style="display:block;"><a href="#" onclick="updateOrder(2,3)">等待发货</a></li>
                            <li id="headerHome" style="display:block;"><a href="#" onclick="updateOrder(4,5)">等待收货</a></li>
                            <li id="headerHome" style="display:block;"><a href="#" onclick="updateOrder(6,6)">等待评价</a></li>
                        </ul>
                    </li>
                    <li id="headerSignIn"><a href="" data-toggle="modal" data-target="#mymodal-signin">登陆</a></li>
                    <li id="headerSignOut" style="display:none" onclick="PostLogout()"><a href="#">登出</a></li>
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
                    function dspl(root) {
                        if ($(root).attr('class') != 'active') {
                            return;
                        }
                        $(root + ' .submenu').attr('style', 'position: absolute;');
                        $(root + ' .submenu li').attr('style', 'display: block;position:relative');
                    }
                </script>
                <!-- script-for-nav -->
            </div>
            <div class="header-right1">
                <a href="" data-toggle="modal" data-target="#mymodal-avatar">
                    <img src="" class="img-circle" style="width:60px; height: 60px" href="" id="user_avatar"/>
                </a>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!-- header -->


<!-- Modal -->
<div class="modal fade" id="mymodal-signin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title lead">登录</h4>
            </div>
            <div class="modal-body">
                <form id="login_form" class="form-horizontal" role="form" method="post">
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
<div class="modal fade" id="mymodal-avatar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title lead">上传图片</h4>
            </div>
            <div class="modal-body" align="center">
                <div class="thumbnail">
                    <img src="" alt="Image Previewer" id="previewer">
                </div>
                <form id="upP_form" action="<?php echo base_url()?>register/registerPhoto" method="post" enctype="multipart/form-data">
                    <div class="alert alert-danger" role="alert" id="upPAlert" style="display:none;height:30px;padding:5px;">
                        <span class="glyphicon glyphicon-remove-sign"></span><span id="upPErrorMessage">&nbsp;上传失败，请重试 </span>
                    </div>
                    <input type="file" name="fileUp" id="filechooser" style="display: none;">
                    <input type="submit" id="fileUploadBtn" value="文件上传" style="display: none;"/>
                </form>
                <button class="btn btn-primary" onclick="{$('#filechooser').click()}">选择图片</button>
                <button class="btn btn-primary" onclick="updatePhoto()">上传图片</button>
                <script type="text/javascript">
                    var filechooser = document.getElementById('filechooser');
                    var previewer = document.getElementById('previewer');
                    filechooser.onchange = function() {
                        var files = this.files;
                        var file = files[0];
                        // 接受 jpeg, jpg, png 类型的图片
                        if (!/\/(?:jpeg|jpg|png|bmp|gif)/i.test(file.type)) return;
                        var reader = new FileReader();
                        reader.onload = function() {
                            var result = this.result;
                            previewer.src = result;
                        };
                        reader.readAsDataURL(file);
                    };
                    function upP(data) {
                        if (data.status == 0) {
                            window.location.reload();
                        }
                        else {
                            upPError(data);
                        }
                    }
                    function upPError(data) {
                        $('#upPAlert').attr('style','height:30px;padding:5px;');
                    }
                    function updatePhoto() {
                        $.ajax({
                            url: BASEURL+'register/registerPhoto',
                            type: 'POST',
                            cache: false,
                            data: new FormData($('#upP_form')[0]),
                            processData: false,
                            contentType: false,
                            dataType: 'JSON',
                            success: upP,
                            error: upPError
                        })
                        // ajax_send(BASEURL+'register/registerPhoto',0,upP,upPError);
                    }
                </script>
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
        alert("登陆失败，请重试");
    };
    function PostLogin() {
        urlInHeader = BASEURL + 'login/check';
        
        ajax_send(urlInHeader,{user:encodeURI($('#username').val()), pass:encodeURI($('#password').val()), action:encodeURI('login')},loginSuccess,loginError);
    };
    logoutSuccess = function(data) {
        if(data.status == 0) {
            // alert('logout');
            window.location.href=BASEURL;
            // window.location.reload();
        }
        else {
            alert('您还没有登录');
            window.location.href=BASEURL;
            // window.location.reload();
        }
    };
    function PostLogout() {
        urlInHeader = BASEURL + 'logout/index';
        ajax_send(urlInHeader,{action:encodeURI('logout')}, logoutSuccess, op_error);  
    }

    defaultIcon = BASEURL+'static/images/dfIcon.jpg';
    function getP(data) {
        if (data.status == 0) {
            $('#user_avatar').attr('src', BASEURL + data.src);
        }
        else {
            $('#user_avatar').attr('src', defaultIcon);
        }
    }
    function getPError(data) {
        $('#user_avatar').attr('src', defaultIcon);
    }
    if (isUser() || isShop() || isDelivery()) {
        $(function(){
            ajax_send(BASEURL+'welcome/getP',0,getP,getPError);
        });
    }
    else {
        $('.header-right1').attr('style', 'display:none');
    }

</script>
