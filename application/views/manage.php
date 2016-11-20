<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">shopId='<?php echo $para['id']?>'</script>
<!-- banner -->
<!-- <div class="banner">
  
</div> -->
<!-- banner --> 
<div class="latis">
  <div class="container" id="cuisineContainer">
    <div class="col-md-4 latis-left" id="cuisine1">
      <h3>Maecenas ornare enim</h3>
      <img src="<?php echo base_url();?>static/images/4.jpg" class="img-responsive" alt="">
      <div class="special-info grid_1 simpleCart_shelfItem">
        <p>Cum sociis natodiculus mus.rhoncus egestas ac sit </p>
        <div class="cur">
          <div class="cur-left">
            <div class="btn-group">
              <button type="button" style="display: none;" class="putbtn btn btn-default" onclick="put(1)">
                上架
              </button>
              <button type="button" class="offbtn btn btn-success" onclick="off(1)">
                下架
              </button>
              <button type="button" class="delbtn btn btn-danger" onclick="del(1)">
                删除
              </button>
            </div>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 latis-left" id="cuisine2">
      <h3>Dis parturient montes</h3>
      <img src="<?php echo base_url();?>static/images/1.jpg" class="img-responsive" alt="">
      <div class="special-info grid_1 simpleCart_shelfItem">
        <p>Cum sociis natodiculus mus.rhoncus egestas ac sit </p>
        <div class="cur">
          <div class="cur-left">
            <div class="btn-group">
              <button type="button" class="putbtn btn btn-default" onclick="put(2)">
                上架
              </button>
              <button type="button" style="display: none;" class="offbtn btn btn-success" onclick="off(2)">
                下架
              </button>
              <button type="button" class="btn btn-danger" onclick="del(2)">
                删除
              </button>
            </div>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 latis-left">
      <h3>Curabitur congue blandit</h3>
      <img src="<?php echo base_url();?>static/images/3.jpg" class="img-responsive" alt="">
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
    <div class="col-md-12"><p><br /></p></div>
    <div class="col-md-4 latis-left">
      <h3>Curabitur congue blandit</h3>
      <img src="<?php echo base_url();?>static/images/3.jpg" class="img-responsive" alt="">
      <div class="special-info grid_1 simpleCart_shelfItem">
        <p>Cum sociis natodiculus mus.rhoncus egestas ac sit</p>
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
  loadf2 = function(data) {
    alert("加载失败，请重试");
  };
  function getCuisine() {
    url = BASEURL + 'shop/c/'+ shopId +'/true';
    ajax_send(url,0,loadf1,loadf2);
  };
  putf1 = function(data) {
    if (data.status != 0) {
      f2();
      return;
    }
    $('#cuisine' + cid + ' .putbtn').attr('style', 'display:none');
    $('#cuisine' + cid + ' .offbtn').attr('style', '');
  };
  offf1 = function(data) {
    if (data.status != 0) {
      alert(data.status);
      f2();
      return;
    }
    $('#cuisine' + cid + ' .putbtn').attr('style', '');
    $('#cuisine' + cid + ' .offbtn').attr('style', 'display:none');
  };
  delf1 = function(data) {
    if (data.status != 0) {
      f2();
      return;
    }
    getCuisine();
  };
  f2 = function(data) {
    alert("操作失败，请重试");
  }
  function put(id) {
    url = BASEURL + 'shop/put/' + id;
    cid = id;
    ajax_send(url,0,putf1,f2);
  }
  function off(id) {
    url = BASEURL + 'shop/off/' + id;
    cid = id;
    ajax_send(url,0,offf1,f2);
  }
  function del(id) {
    url = BASEURL + 'shop/del/' + id;
    ajax_send(url,0,delf1,f2);
  }
  cid = -1;
  getCuisine();
</script>