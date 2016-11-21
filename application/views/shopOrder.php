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
		<div class="order-top" id="order0" orderid="0">
			<li class="im-g"><a href="#"><img src="<?php echo base_url()?>static/images/1p.jpg" class="img-responsive" alt=""></a></li>
			<li class="data"><h3>test name</h3>
				<p>BUAA</p>
				<P>不加辣不加辣不加辣不加辣不加辣不加辣不加辣不加辣不加辣不加辣不加辣不加辣</P>
			</li>
			<li class="bt-nn">
				<button type="button" class="btn btn-success" onclick="showOrder(0)">详情</button>
			</li>
			<div class="clearfix"></div>
		</div>
  </div>
</div>

<script type="text/javascript"></script>>

<script type="text/javascript">
  loadf1 = function(data) {
    if (data.status != 0) {
      return;
    }
    $('#orderContainer').empty();
    for (var i = 0; i < data.count; i++) {
      $('#orderContainer').append(wrap_cuisine_manage(data.data[i + j]));
    }
  };
  $(function(){
  	ajax_send(BASEURL + 'shop/getActiveOrder',0,loadf1,load_error);
  });
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
              <button type="button" id="login_submit" onclick="sendCart()" class="btn btn-primary btn-lg btn-block lead"><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;确认付款</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
