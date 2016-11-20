<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
  $('#headerHome').attr('class', 'active');
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
