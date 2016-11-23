<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
  shopId='<?php echo $para['id']?>';
  $('#headerShop').attr('class', 'active');
</script>
<!-- banner -->
<!-- <div class="banner">
  
</div> -->
<!-- banner --> 
<div class="latis">
  <div class="container" id="cuisineContainer">
  </div>
</div>


<div class="modal fade" id="mymodal-addcusine">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title lead">新增菜品</h4>
      </div>
      <div class="modal-body">
        <form id="login_form" class="form-horizontal" role="form" method="post" action="register">
          <input type="hidden" name="_token" value="R5gsW4ojTAXtGfwlp4lfX9X64y9uP2n2ceyTZ76d">
          <div class="alert alert-danger" role="alert" id="addcsAlert" style="display:none;height:30px;padding:5px;">
            <span class="glyphicon glyphicon-remove-sign" id = "regiErrIcon"></span><span id="registerErrorMessage">&nbsp; 信息不合规范</span>
          </div>

          <div class="form-group">
            <label for="InputCname" class="col-md-2 control-label">菜名</label>
            <div class="input-group col-md-9">
              <input type="text" class="form-control" id="cname" name="name">
            </div>
          </div>
          <div class="form-group">
            <label for="InputCpic" class="col-md-2 control-label">图片</label>
            <div class="input-group col-md-9">
              <div class="thumbnail">
                  <img src="" alt="点击上传图片" id="Cpreviewer" onclick="{$('#Cpicchooser').click();}">
              </div>
              <input type="file" name="fileUp" id="Cpicchooser" style="display:none;">
              <script type="text/javascript">
                  var Cfilechooser = document.getElementById('Cpicchooser');
                  var Cpreviewer = document.getElementById('Cpreviewer');
                  Cfilechooser.onchange = function() {
                      var file = this.files[0];
                      if (!/\/(?:jpeg|jpg|png|bmp)/i.test(file.type)) return;
                      var reader = new FileReader();
                      reader.onload = function() {
                          var result = this.result;
                          Cpreviewer.src = result;
                      };
                      reader.readAsDataURL(file);
                  };
              </script>
            </div>
          </div>
          <div class="form-group">
            <label for="InputCinfo" class="col-md-2 control-label">简介</label>
            <div class="input-group col-md-9">
              <input type="text" class="form-control" id="cinfo" name="info">
            </div>
          </div>
          <div class="form-group" id="reAddress">
            <label for="InputCprice" class="col-md-2 control-label">价格</label>
            <div class="input-group col-md-9">
              <input type="text" class="form-control" id="cprice" name="price">
            </div>
          </div>
          <div class="form-group" id="reAddress">
            <label for="InputCst" class="col-md-2 control-label">马上销售</label>
            <div class="input-group col-md-9">
              <input type="text" class="form-control" id="cst" name="st">
            </div>
          </div>
          <input type="submit" id="AddCBtn" value="文件上传" style="display: none;"/>
          <div class="modal-footer">
            <button type="button" id="login_submit" onclick="$('#AddCBtn').click()" class="btn btn-primary btn-lg btn-block lead"><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;&nbsp;添加 &nbsp; </button>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
  loadf1 = function(data) {
    if (data.status != 0) {
      return;
    }
    $('#cuisineContainer').empty();
    for (var i = 0; i < data.count; i += 3) {
      if (i) {
        $('#cuisineContainer').append("<div class=\"col-md-12\"><p><br /></p></div>");
      }
      for (var j = 0; j < 3 && i + j < data.count; j++) {
        $('#cuisineContainer').append(wrap_cuisine_manage(data.data[i + j]));
      }
    }
  };
  function getCuisine() {
    url = BASEURL + 'shop/c/'+ shopId +'/true';
    ajax_send(url,0,loadf1,load_error);
  };
  putf1 = function(data) {
    if (data.status != 0) {
      op_error();
      return;
    }
    $('#cuisine' + cid + ' .putbtn').attr('style', 'display:none');
    $('#cuisine' + cid + ' .offbtn').attr('style', '');
  };
  offf1 = function(data) {
    if (data.status != 0) {
      alert(data.status);
      op_error();
      return;
    }
    $('#cuisine' + cid + ' .putbtn').attr('style', '');
    $('#cuisine' + cid + ' .offbtn').attr('style', 'display:none');
  };
  delf1 = function(data) {
    if (data.status != 0) {
      op_error();
      return;
    }
    getCuisine();
  };
  function put(id) {
    url = BASEURL + 'shop/put/' + id;
    cid = id;
    ajax_send(url,0,putf1,op_error);
  }
  function off(id) {
    url = BASEURL + 'shop/off/' + id;
    cid = id;
    ajax_send(url,0,offf1,op_error);
  }
  function del(id) {
    url = BASEURL + 'shop/del/' + id;
    ajax_send(url,0,delf1,op_error);
  }
  function add() {
    url = BASEURL + 'shop/add';

  }
  cid = -1;
  getCuisine();
</script>