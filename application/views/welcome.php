<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
  $('#headerHome').attr('class', 'active');
  $('#headerRegister').attr('style', '');
</script>
<!-- latis -->  
<div class="latis">
  <div class="container">
    <h1>每日精选</h1><p><br /></p>
    <div class="col-md-4 latis-left">
      <h3>Maecenas ornare enim</h3>
      <img src="static/images/4.jpg" class="img-responsive" alt="">
      <div class="special-info grid_1 simpleCart_shelfItem">
        <p>Cum sociis natodiculus mus.rhoncus egestas ac sit </p>
        <div class="cur">
          <div class="cur-left">
            <div class="item_add"><span class="item_price"><a class="morebtn hvr-rectangle-in" href="#">Add to cart</a></span></div>
          </div>
          <div class="cur-right">
            <div class="item_add"><span class="item_price"><h6>only $45.00</h6></span></div>
          </div>
            <div class="clearfix"> </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 latis-left">
      <h3>Dis parturient montes</h3>
      <img src="static/images/1.jpg" class="img-responsive" alt="">
      <div class="special-info grid_1 simpleCart_shelfItem">
        <p>Cum sociis natodiculus mus.rhoncus egestas ac sit </p>
        <div class="cur">
          <div class="cur-left">
            <div class="item_add"><span class="item_price"><a class="morebtn hvr-rectangle-in" href="#">Add to cart</a></span></div>
          </div>
          <div class="cur-right">
            <div class="item_add"><span class="item_price"><h6>only $55.00</h6></span></div>
          </div>
            <div class="clearfix"> </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 latis-left">
      <h3>Curabitur congue blandit</h3>
      <img src="static/images/3.jpg" class="img-responsive" alt="">
      <div class="special-info grid_1 simpleCart_shelfItem">
        <p>Cum sociis natodiculus mus.rhoncus egestas ac sit </p>
        <div class="cur">
          <div class="cur-left">
            <div class="item_add"><span class="item_price"><a class="morebtn hvr-rectangle-in" href="#">Add to cart</a></span></div>
          </div>
          <div class="cur-right">
            <div class="item_add"><span class="item_price"><h6>only $65.00</h6></span></div>
          </div>
            <div class="clearfix"> </div>
        </div>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
<!-- latis -->
<!-- latis -->  
<div class="latis">
  <div class="container">
    <h1>店铺推荐</h1><p><br /></p>
    <div class="col-md-4 latis-left">
      <h3>Maecenas ornare enim</h3>
      <img src="static/images/4.jpg" class="img-responsive" alt="">
      <div class="special-info grid_1 simpleCart_shelfItem">
        <p>Cum sociis natodiculus mus.rhoncus egestas ac sit </p>
      </div>
      <div class="cur">
          <div class="cur-left">
            <a class="morebtn hvr-rectangle-in" href="shop/s/0">进店逛逛</a></span>
          </div>
          <div class="cur-right">
            <div class="item_add"><span class="item_price"><h6>******</h6></span></div>
          </div>
          <div class="clearfix"> </div>
        </div>
    </div>
    <div class="col-md-4 latis-left">
      <h3>Dis parturient montes</h3>
      <img src="static/images/1.jpg" class="img-responsive" alt="">
      <div class="special-info grid_1 simpleCart_shelfItem">
        <p>Cum sociis natodiculus mus.rhoncus egestas ac sit </p>
      </div>
    </div>
    <div class="col-md-4 latis-left">
      <h3>Curabitur congue blandit</h3>
      <img src="static/images/3.jpg" class="img-responsive" alt="">
      <div class="special-info grid_1 simpleCart_shelfItem">
        <p>Cum sociis natodiculus mus.rhoncus egestas ac sit </p>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
<!-- latis -->  
<script type="text/javascript">
  f1 = function(data) {
    if (data.status != 0) {
      return;
    }
    for (var i = 0; i < data.count; i += 4) {
      $('#shops').append("<div class=\"row\" id=row"+i+"></div>");
      for (var j = 0; j < 4 && i + j < data.count; j++) {
        $('#row'+i).append(wrap_shop(data.data[i + j]));
      }
    }
  };
  f2 = function(data) {
    alert("Something amazing happened! Please try again later.");
  }
  url = BASEURL+'shop/r/';//+pageNum.toString();
  $(function(){
    ajax_send(url,0,f1,f2);
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
          <div class="alert alert-danger" role="alert" id="loginAlert" style="display:none;height:30px;padding:5px;">
                        <span class="glyphicon glyphicon-remove-sign"></span><span id="errorMessage">&nbsp; 用户名或密码错误!</span>
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
                    <div class="form-group">
                        <label for="InputAddress" class="col-md-2 control-label">地址</label>
                        <div class="input-group col-md-9">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-eye-close"></span></span>
                            <input type="text" class="form-control" id="registerAddress" placeholder="请输入您的地址" name="address" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="InputPhone" class="col-md-2 control-label">电话号码</label>
                        <div class="input-group col-md-9">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-eye-close"></span></span>
                            <input type="text" class="form-control" id="registerPhone" placeholder="请输入您的电话号码" name="phone" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="InputEmail" class="col-md-2 control-label">邮箱</label>
                        <div class="input-group col-md-9">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-eye-close"></span></span>
                            <input type="text" class="form-control" id="registerEmail" placeholder="请输入您的邮箱" name="email" value="">
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
    registerSuccess = function(data) {
        if(data.status==0){
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
        alert(data.status);
    };
    registerError = function(data) {
        alert("Something amazing happened! Please try again later.");
    };
    function PostRegister() {
        url = BASEURL + 'register/registerUser';
        
        ajax_send(url,{username:encodeURI($('#registerUsername').val()), password:hex_md5(encodeURI($('#registerPassword').val())), role:encodeURI('1'), address:encodeURI($('#registerAddress').val()), email:encodeURI($('#registerEmail').val()), action:encodeURI('register')},registerSuccess,registerError);
    };
    // alert(hex_md5('asd'));
</script>