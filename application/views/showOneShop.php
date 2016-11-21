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
    <div><button type="button" class="offbtn btn btn-primary"">马上结账</button></div>
  </div>
</div>
<div class="latis">
  <div class="container" id="cuisineContainer">
    
    <div class="clearfix"> </div>
  </div>
</div>

<div>
  
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
</script>
