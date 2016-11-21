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
  cid = -1;
  getCuisine();
</script>