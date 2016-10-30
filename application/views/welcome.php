<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="body">
<div class="pageBar" style="margin-bottom:15px;">
</div>
<h1>首页推荐</h1>
<div id="shops">
</div>
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

<div class="pageBar" style="margin-top:15px;">
</div>

	<p style="font-size:18px;">This platform is under construct...</p>
	<p style="font-size:18px;">Our team: ...</p>
	<?php if(isset($para['username'])) {echo '<p style="font-size:18px;">Welcome user:'. $para['username']. ' ...</p>';}?>
	</div>
	<p style="font-size:18px;">数据库开发小分队 杨子琛(yic) 冯岩(kira)</p>
</div>


