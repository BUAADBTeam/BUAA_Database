<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">shopId='<?php echo $para['id']?>'</script>
<!-- banner -->
<!-- <div class="banner">
  
</div> -->
<!-- banner --> 

<div data-spy="affix" data-offset-top="60" data-offset-bottom="60">
  <div style="position: relative;left: 30px;top: 450px;">
    <span class="glyphicon glyphicon-shopping-cart" style="font-size: 20px"></span>￥<text id="sumPrice">0</text>
    <div><button type="button" class="offbtn btn btn-primary" data-toggle="modal" data-target="#mymodal-order" onclick="acount()">马上结账</button></div>
  </div>
</div>
<div class="latis">
  <div class="container" id="cuisineContainer">
    
    <div class="clearfix"> </div>
  </div>
</div>

<script type="text/javascript">
  f1 = function(data) {
    if (data.status != 0) {
      return;
    }
    for (var i = 0; i < data.count; i += 3) {
      if (i) {
        $('#cuisineContainer').append("<div class=\"col-md-12\"><p><br /></p></div>");
      }
      
      for (var j = 0; j < 3 && i + j < data.count; j++) {
        $('#cuisineContainer').append(wrap_cuisine(data.data[i + j]));
      }
    }
  };
  f2 = function(data) {
    alert("Something amazing happened! Please try again later.");
  };
  url = BASEURL+'shop/c/' + shopId;
  $(function(){
    ajax_send(url,0,f1,f2);
  });
  function sub(id) {
    x = parseInt($('#cuisine'+id).attr('num'));
    if (x > 0) {
      $('#cuisineNum'+id).html(x-1);
      $('#cuisine'+id).attr('num', x-1);
      if (x == 1) {
        $('#subbtn'+id).attr('class', 'offbtn btn btn-success disabled');
      }
      $('#sumPrice').html((parseFloat($('#sumPrice').html()) - parseFloat($('#cuisine'+id).attr('price'))).toFixed(2));
    }
  }
  function add(id) {
    x = parseInt($('#cuisine'+id).attr('num'));
    parseInt($('#cuisineNum'+id).html(x+1));
    $('#cuisine'+id).attr('num', x+1);
    $('#subbtn'+id).attr('class', 'offbtn btn btn-success');
    $('#sumPrice').html((parseFloat($('#sumPrice').html()) + parseFloat($('#cuisine'+id).attr('price'))).toFixed(2));
  }
  // $.ajax({url:"http://localhost/db/test",data:{a:{b:2,C:3},b:4},type: 'post',success:function(result){
  //     alert(result);
  //   }, error:function(result){
  //     alert(result);
  //   }});
  var cart = {data:new Array(), sid:shopId, All:0, cnt:0, action:'submitOrder'};
  function acount() {
    body = $('#mymodal-order .modal-body');
    body.empty();
    num = $('.cuisine').size();
    all = 0;
    cart.data = new Array();
    for (var i = 0; i < num; i++) {
      obj = $('.cuisine').eq(i);
      if (obj.attr('num') != '0') {
        item = new Object();
        item.name = obj.attr('name');
        item.id = obj.attr('cuisineid');
        item.pic = obj.attr('picsrc');
        item.price = obj.attr('price');
        item.num = obj.attr('num');
        cart.data[cart.cnt++] = item;
        tmp = item.num * item.price;
        all += tmp;
        body.append(wrap_cuisine_order(item));
      }
    }
    cart.All = all;
    body.append(wrap_total_price(all.toFixed(2)));
  }
  function sendCart() {
    f1 = function(data) {
      alert('success');
    }
    f2 = function(data) {
      alert('error');
    }
    ajax_send(BASEURL+'cart/submit', cart, f1, f2);
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
              <button type="button" id="login_submit" onclick="sendCart()" class="btn btn-primary btn-lg btn-block lead"><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;确认付款</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
