<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">shopId='<?php echo $para['id']?>'</script>
<!-- banner -->
<!-- <div class="banner">
  
</div> -->
<!-- banner --> 
<div class="orders">
  <div class="container" id="orderContainer">
  </div>
</div>

<script type="text/javascript">
  loadf = function(data) {
    if (data.status != 0) {
      return;
    }
    $('#orderContainer').empty();
    for (var i = 0; i < data.count; i++) {
      $('#orderContainer').append(wrap_order(data.order[i]));
    }
  };
  $(function(){
  	ajax_send(BASEURL + 'shop/getActiveOrder',0,loadf,load_error);
  });
  function showOrder(id)
  {
  	$('#mymodal-order .modal-body').html($('#orderDetail'+id).html());
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
