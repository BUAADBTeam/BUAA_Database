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
    updataOrder(0);
    $('#orderContainer').empty();
    for (var i = 0; i < data.count; i++) {
      $('#orderContainer').append(wrap_order(data.order.list[i], data.order.user));
    }
  };
  url = BASEURL+'order/getOrder';
  $(function(){
    ajax_send(url,0,load_order,load_error);
  });
  function showOrder(id)
  {
    $('#mymodal-order .modal-body').html($('#orderDetail'+id).html());
  }
  function updataOrder(lev)
  {
    $('#orderContainer').empty();
    for (var i = 0; i < orders.count; i++) {
      if (lev == -1 ? true : lev == 0 ? orders.order.list[i].st < 7 : orders.order.list[i].st == lev)
        $('#orderContainer').append(wrap_order(data.order.list[i], data.order.user));
    }
  }
  function dspl() {
      //alert($('#headerOrder'));
      $('.submenu').attr('style', 'position: absolute;');
      $('.submenu li').attr('style', 'display: block;position:relative');
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
