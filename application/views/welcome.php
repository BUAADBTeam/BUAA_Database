<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
  $('#headerHome').attr('class', 'active');
  if (!isUser() && !isShop() && !isDelivery())$('#headerRegister').attr('style', '');
</script>
<!-- latis -->  
<div class="latis">
  <div class="container" id="cuisineContainer">
    <h1>每日精选</h1><p><br /></p>
  </div>
</div>
<!-- latis -->
<!-- latis -->  
<div class="latis">
  <div class="container" id="shopContainer">
    <h1>店铺推荐</h1><p><br /></p>
  </div>
</div>
<!-- latis -->  
<script type="text/javascript">
  f1 = function(data) {
    if (data.status != 0) {
      return;
    }
    for (var i = 0; i < data.cuisineCount; i += 3) {
      for (var j = 0; j < 3 && i + j < data.cuisineCount; j++) {
        $('#cuisineContainer').append(wrap_cuisine_welcome(data.cuisine[i + j]));
      }
      $('#cuisineContainer').append('<div class="clearfix"> </div>');
    }
    for (var i = 0; i < data.shopCount; i += 3) {
      for (var j = 0; j < 3 && i + j < data.shopCount; j++) {
        $('#shopContainer').append(wrap_shop_welcome(data.shop[i + j]));
      }
      $('#shopContainer').append('<div class="clearfix"> </div>');
    }
  };
  url = BASEURL+'shop/r/';//+pageNum.toString();
  $(function(){
    ajax_send(url,0,f1,load_error);
  }); 
</script>
<div class="modal fade" id="mymodal-register">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title lead">注册</h4>
            </div>
            <div class="modal-body">
                <form id="login_form" class="form-horizontal" role="form" method="post" action="register">
                    <input type="hidden" name="_token" value="R5gsW4ojTAXtGfwlp4lfX9X64y9uP2n2ceyTZ76d">
          <div class="alert alert-danger" role="alert" id="registerAlert" style="display:none;height:30px;padding:5px;">
                        <span class="glyphicon glyphicon-remove-sign" id = "regiErrIcon"></span><span id="registerErrorMessage">&nbsp; 用户名或密码错误!</span>
                    </div>
                    <div class="form-group">
                        <label for="InputAccount" class="col-md-2 control-label">用户名</label>
                        <div class="input-group col-md-9">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" class="form-control" id="registerUsername" placeholder="请输入您的用户名/邮箱" name="username" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword" class="col-md-2 control-label">密码</label>
                        <div class="input-group col-md-9">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-eye-close"></span></span>
                            <input type="password" class="form-control" id="registerPassword" placeholder="请输入您的密码" name="password" value="">
                        </div>
                    </div>
                    <div class="form-group" id="reAddress">
                        <label for="InputAddress" class="col-md-2 control-label">地址</label>
                        <div class="input-group col-md-9">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-road"></span></span>
                            <input type="text" class="form-control" id="registerAddress" placeholder="请输入您的地址" name="address" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="InputPhone" class="col-md-2 control-label">电话号码</label>
                        <div class="input-group col-md-9">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-signal"></span></span>
                            <input type="text" class="form-control" id="registerPhone" placeholder="请输入您的电话号码" name="phone" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="InputEmail" class="col-md-2 control-label">邮箱</label>
                        <div class="input-group col-md-9">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="text" class="form-control" id="registerEmail" placeholder="请输入您的邮箱" name="email" value="" >
                        </div>
                    </div>

                    <div class="form-group">
                          <div >
                        <label for="InputEmail" class="col-md-2 control-label">身份</label>
                          <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group btn-group">
                              <button type="button" class="btn btn-default" onclick="selectRole(0)">用户</button>
                            </div>
                            <div class="btn-group btn-group">
                              <button type="button" class="btn btn-default" onclick="selectRole(1)">商家</button>
                            </div>
                            <div class="btn-group btn-group">
                              <button type="button" class="btn btn-default" onclick="selectRole(2)">快递员 </button>
                            </div>
                          </div>
                        </div>
                    </div>
                    

                    <div class="modal-footer">
                        <button type="button" id="login_submit" onclick="PostRegister()" class="btn btn-primary btn-lg btn-block lead"><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;&nbsp;注册 &nbsp; </button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    var role = 0;
    var textbox = new Array('#registerUsername', '#registerPassword', '#registerPhone', '#registerEmail');
    var status = 0;
    // if(role == 0 || role == 2) {
    //   $('#reAddress').attr('style', 'display:none');
    // }
    function checkInfo()
    {
      var i;
      for(i = 0; i < textbox.length; i++) {
        if($(textbox[i]).val() == '') {
          return false;
        }
        if(role != 2 && $('#registerAddress').val() == '') {
          return false;
        }
        return true;
      }
    }
    registerSuccess = function(data) {
        if(data.status==<?php echo scRegistered; ?>){
          $('#registerAlert').attr('style','height:30px;padding:5px;');
          $('#registerErrorMessage').text("已经将验证邮件发送到您的邮箱");
          // window.location.reload();
          $('#regiErrIcon').attr('class', 'glyphicon glyphicon-ok');
          $('#registerAlert').attr('class', 'alert alert-success');
        }
        
        else{
            $('#registerAlert').attr('style','height:30px;padding:5px;');
            if(data.status==<?php echo failedEmail; ?>){
                $('#registerErrorMessage').text("验证邮件发送错误");
                status = 0;
            }
            else if(data.status==<?php echo errorInfo; ?>){
                $('#registerErrorMessage').text("用户名或密码错误");
                status = 0;
            }
            else if(data.status==<?php echo invalidName; ?>) {
                $('#registerErrorMessage').text("此用户名已被注册啦"); 
                status = 0;
            }
            else if(data.status==<?php echo invalidEmail; ?>) {
                $('#registerErrorMessage').text("此邮箱已被注册或者格式不正确"); 
                status = 0;
            }
            else{
                $('#registerErrorMessage').text("未知错误");
            }
            return ;
        }
        // alert(data.status);
    };
    registerError = function(data) {
        alert("注册失败，请重试");
        return ;
    };
    checkNameSuccess = function(data) {
      if(data.status == <?php echo validName; ?>) {
        $('#registerAlert').attr('style','display:none;height:30px;padding:5px;');
          ajax_send(BASEURL + 'register/checkEmail', 
          {email:encodeURI($('#registerEmail').val())}, 
          checkEmailSuccess, registerError);
        }
      else if(data.status==<?php echo invalidName; ?>) {
          $('#registerAlert').attr('style','height:30px;padding:5px;');

          $('#registerErrorMessage').text("此用户名已被注册啦"); 
          status = 0;
      }
      else{
          $('#registerErrorMessage').text("未知错误");
      }
    };
    checkEmailSuccess = function(data) {
      if(data.status == <?php echo validEmail; ?>) {
        $('#registerAlert').attr('style','display:none;height:30px;padding:5px;');
          ajax_send(BASEURL + 'register/registerUser',{username:encodeURI($('#registerUsername').val()), password:hex_md5(encodeURI($('#registerPassword').val() + 'buaadb')), role:encodeURI(role+1), address:encodeURI($('#registerAddress').val()), email:encodeURI($('#registerEmail').val()), phone:encodeURI($('#registerPhone').val()), action:encodeURI('register')},registerSuccess,registerError);
        }
      else if(data.status==<?php echo invalidEmail; ?>) {
        $('#registerAlert').attr('style','height:30px;padding:5px;');
          $('#registerErrorMessage').text("此邮箱已被注册或者不正确的邮箱格式"); 
          status = 0;
      }
      else {
          $('#registerErrorMessage').text("未知错误"); 
      }
    };
    function PostRegister() {
        url = BASEURL + 'register/registerUser';
        if(!checkInfo()) {
          alert("信息不完整");
          return ;
        }
        ajax_send(BASEURL + 'register/checkUser', 
          {username:encodeURI($('#registerUsername').val())}, 
          checkNameSuccess, registerError);
        
        // ajax_send(url,{username:encodeURI($('#registerUsername').val()), password:hex_md5(encodeURI($('#registerPassword').val())), role:encodeURI(role), address:encodeURI($('#registerAddress').val()), email:encodeURI($('#registerEmail').val()), phone:encodeURI($('#registerPhone').val()), action:encodeURI('register')},registerSuccess,registerError);
    };

    function selectRole(r) {
      if(r == 1) {
        role = 1;
        $('#reAddress').attr('style', '');
      }
      else if(r == 2) {
        role = 2;
        $('#reAddress').attr('style', 'display:none');
      }
      else {
        role = 0;
        $('#reAddress').attr('style', ''); 
      }
    }

    // alert(hex_md5('asd'));
</script>