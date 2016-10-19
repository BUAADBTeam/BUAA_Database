<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="body">
	<p style="font-size:18px;">This platform is under construct...</p>
	<p style="font-size:18px;">Our team: ...</p>
	<?php if(isset($para['username'])) {echo '<p style="font-size:18px;">Welcome user:'. $para['username']. ' ...</p>';}?>
	<div style="background:url(http://img.kumi.cn/photo/ba/81/ef/ba81ef79360abd82.jpg) no-repeat;height:400px; background-size:600px 400px;">
	</div>
	<p style="font-size:18px;">数据库开发小分队 杨子琛(yic) 冯岩(kira)</p>
</div>

<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
    Dropdown
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
  </ul>
</div>

