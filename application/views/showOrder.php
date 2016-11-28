<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
  $('#headerOrder').attr('class', 'active');
</script>
<!-- banner -->
<!-- <div class="banner">
  
</div> -->
<!-- banner --> 
<div class="orders">
  <div class="container" id="orderContainer">
  </div>
</div>

<script type="text/javascript">
  var orders;
  load_order = function(data) {
    if (data.status != 0) {
      return;
    }
    orders = data;
    updateOrder(0, 6);
  };
  url = BASEURL+'order/getOrder';
  $(function(){
    ajax_send(url,0,load_order,load_error);
  });
  function showOrder(id)
  {
    $('#mymodal-order .modal-body').html($('#orderDetail'+id).html());
    $('#mymodal-order .modal-footer').html($('#orderBtn'+id).html());
  }
  function updateOrder(l, r)
  {
    $('#orderContainer').empty();
    for (var i = 0; i < orders.count; i++) {
      if (orders.order.list[i].status >= l && orders.order.list[i].status <= r)
        $('#orderContainer').append(wrap_order(orders.order.list[i], orders.order.user));
    }
  }
  function op_get_res(data) {
    if (data.status == 0) {
      window.location.reload();
    }
    else {
      op_error(data);
    }
  }

  function qrcode(oid, uid, sid) {
    $('#mymodal-order .modal-body').html('<div align="center"><img src="http://qr.liantu.com/api.php?&w=200&text=http://baidu.com" /></div>');
    $('#mymodal-order .modal-footer button').attr('onclick', 'userPaid('+oid+', '+uid+', '+sid+')');
  }
  function userPaid(oid, uid, sid) {
    
    ajax_send(BASEURL+'order/userPaid', {orderid:oid, userid:uid, shopid:sid}, op_get_res, op_error);
  }
  function shopAcceptOrder(oid, uid, sid) {
    ajax_send(BASEURL+'order/shopAcceptOrder', {orderid:oid, userid:uid, shopid:sid}, function(data){if (data.status != 0) op_error(data);}, op_error);
  }
  function allocOrder(oid, uid, sid) {
    ajax_send(BASEURL+'order/allocOrder', {orderid:oid, userid:uid, shopid:sid}, 
      function op_get_res(data) {
        if (data.status == 0) {
          window.location.reload();
        }
        else {
          alert("暂无空闲快递员，请稍后重试");
        }
      }, 
      op_error);
  }
  function deliveryAcceptOrder(oid, uid, sid) {
    ajax_send(BASEURL+'order/deliveryAcceptOrder', {orderid:oid, userid:uid, shopid:sid}, op_get_res, op_error);
  }
  function userGetOrder(oid, uid, sid) {
    ajax_send(BASEURL+'order/userGetOrder', {orderid:oid, userid:uid, shopid:sid}, op_get_res, op_error);
  }
  var shopCred = 5, delvCred = 5;
  function userComment(oid, uid, sid) {
    ajax_send(BASEURL+'order/userComment', {orderid:oid, userid:uid, shopid:sid, credit:{shop:shopCred, delivery:delvCred}}, op_get_res, op_error);
  }
  function setShopComment(x) {
    shopCred=x;
    for (i = 1; i <= x; i++) {
      $('.starShop'+i).attr('class', 'starShop'+i+' glyphicon glyphicon-star');
    }
    for (i = x + 1; i <= 5; i++) {
      $('.starShop'+i).attr('class', 'starShop'+i+' glyphicon glyphicon-star-empty');
    }
  }
  function setDevlComment(x) {
    delvCred
    for (i = 1; i <= x; i++) {
      $('.starDevl'+i).attr('class', 'starDevl'+i+' glyphicon glyphicon-star');
    }
    for (i = x + 1; i <= 5; i++) {
      $('.starDevl'+i).attr('class', 'starDevl'+i+' glyphicon glyphicon-star-empty');
    }
    // $('#starDevls'+x).html('<span id="starDevl'+x+'" class="glyphicon glyphicon-star-empty" style="color:red"></span>');
    // $('#starDevls'+x).html('');
  }
</script>
<div class="modal fade" id="mymodal-order">

    <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title lead">订单</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
              <button type="button" id="login_submit" onclick="sendCart()" class="btn btn-primary btn-lg btn-block lead"><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;确认发货</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
