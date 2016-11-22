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
  function dspl() {
    //alert($('#headerOrder'));
    $('.submenu').attr('style', 'position: absolute;');
    $('.submenu li').attr('style', 'display: block;position:relative');
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
    ajax_send(BASEURL+'order/shopAcceptOrder', {orderid:oid, userid:uid, shopid:sid}, op_get_res, op_error);
  }
  function deliveyAcceptOrder(oid, uid, sid) {
    ajax_send(BASEURL+'order/deliveyAcceptOrder', {orderid:oid, userid:uid, shopid:sid}, op_get_res, op_error);
  }
  function userGetOrder(oid, uid, sid) {
    ajax_send(BASEURL+'order/userGetOrder', {orderid:oid, userid:uid, shopid:sid}, op_get_res, op_error);
  }
  function userComment(oid, uid, sid) {
    ajax_send(BASEURL+'order/userComment', {orderid:oid, userid:uid, shopid:sid}, op_get_res, op_error);
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
