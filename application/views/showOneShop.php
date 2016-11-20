<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">shopId='<?php echo $para['id']?>'</script>
<!-- banner -->
<div class="banner">
  
</div>
<!-- banner --> 
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
</script>
