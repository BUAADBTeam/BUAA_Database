<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="shops">
  <div class="row">
    <div class="col-xs-6 col-md-3">
      <div class="shop">
        <div class="thumbnail">
        <a href="">
        <img src="<?php echo base_url();?>/static/src/1.jpg" height="10000" weight="200" alt="Loading...">
        </a>
        <!-- <img src="<?php echo base_url();?>/static/src/1.jpg"> -->
        <p class="lead"><span class="label label-default">商家</span>北航大食堂<br/><span class="label label-default">地址</span>北航</p>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  pageNum=<?php echo $pageNum;?>;
  f1 = function(data) {
    if (data.status != 0) {
      alert(data.msg);
      return;
    }
    for (var i = 0; i < data.count; i += 4) {
      $('#shops').append("<div class=\"row\" id=row"+i+"><>");
      for (var j = 0; j < 4 && i + j < data.count; j++) {
      	$('.row'+i).append(wrap_shop(data.data[i + j]));
      }
    }
  };
  f2 = function(data) {
    alert("Something amazing happened! Please try again later.");
  }
  url = BASEURL+'shop/s/'+pageNum.toString();
  $(function(){
    ajax_send(url,0,f1,f2);
    $('.pageBar').append(pageDIV(pageNum>0?pageNum:1,'Prev',tk));
    for (var i=1;i<=<?php echo $count;?>;++i) {
      $('.pageBar').append(pageDIV(i,i.toString(),tk));
    }
    $('.pageBar').append(pageDIV(<?php echo $pageNum+2>$count?$count:($pageNum+2)?>,'Next',tk));
    $('.pageBar').append('<div class="clear"></div>');
  });
</script>

<div class="pageBar" style="margin-top:15px;">