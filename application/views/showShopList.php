<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
  $('#headerResturants').attr('class', 'active');
</script>
<!-- about -->
<div class="orders">
  <div class="container", id="shopContainer">
  </div>
</div>
<!-- about -->  

<script type="text/javascript">
    $('#shopContainer').empty();
  loadShop = function(data) {
    if (data.status != 0) {
      return;
    }
    $('#shopContainer').empty();
    for (var i = 0; i < data.count; i++) {
      $('#shopContainer').append(wrap_shop_list(data.data[i]));
    }
  };
  ajax_send(BASEURL + 'shop/getShop', 0, loadShop, load_error);
</script>