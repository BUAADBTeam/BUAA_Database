<!doctype html>

<body class="home">

<!-- LOGIN POP UPS -->
<div id="popup-overlay"></div>
<div class="popup" id="popup-login">
	<h2>Login form</h2>
	<hr class="separator">
	<form method="post" action="" class="form clearfix">
		<fieldset>
			<label for="login-username">用户名:</label>
			<input type="text" name="" id="login-username" class="input text">
			<label for="login-password">密码:</label>
			<input type="password" name="" id="login-password" class="input text">
		</fieldset>
	</form>
	<hr class="separator">
	<button class="button submit">登录</button>
	<div class="links"><a href="#">忘记密码 </a> | <a href="#" class="register-btn"> 新账户</a></div>
	<a class="close" href="#"></a>
</div>
<div class="popup" id="popup-register">
		<h2>Registration form</h2>
		<hr class="separator">
		<form method="post" action="" class="form clearfix">
			<fieldset>
				<label for="login-username">Username:</label>
				<input type="text" name="" id="login-username" class="input text">
				<label for="login-email">Email:</label>
				<input type="text" name="" id="login-email" class="input text error" value="Error">
				<label for="login-password">Password:</label>
				<input type="password" name="" id="login-password" class="input text">
				<label for="login-confirm-password">Confirm password:</label>
				<input type="password" name="" id="login-confirm-password" class="input text">
			</fieldset>
		
			<hr class="separator">
			
			<div class="checks">
				<div class="check-row">
					<label><input type="checkbox" class="input checkbox">I have read and agree to the <a href="#">Terms &amp; Conditions</a></label>
				</div>
				<div class="check-row">
					<label><input type="checkbox" class="input checkbox">I agree to recieve promotional mails</label>
				</div>
			</div>

			<button class="button submit">Register now</button>
		</form>
		<a class="close" href="#"></a>
	</div>
<!-- END LOGIN POP UPS -->
  <div class='
wrapper '>
    <header>
      <div class="top-nav">
        <nav>
          <ul>
            <li><a href="#" id="login-btn">login</a></li>
            <li><a href="#" class="register-btn">register</a></li>
            <li><a href="about.php">about</a></li>
            <li><a href="contact.php">contact</a></li>
            <li><a href="menu.php">menu</a></li>
          </ul>
        </nav>
        
        <form class="search-form" method="post">
          <input type="text" class="search">
          <input type="submit" class="search-submit" value="">
        </form>
  
      </div>
      <a href="index.php" class="logo"><img src="<?php echo base_url()?>static/images/logo.png" alt="your logo" /></a>
			<nav class="main-menu">
				<ul>
					<li><a href="listing.php">Fruits and vegetables</a></li>
					<li><a href="listing.php">Seafood</a></li>
					<li><a href="listing.php">Meat</a></li>
					<li><a href="listing.php">Entrees</a></li>
					<li><a href="listing.php">Pizza and pasta</a></li>
					<li><a href="listing.php">Desserts</a></li>
					<li id="lava-elm"></li>
				</ul>
			</nav>
      <div class="header-slider-canvas">
				<div class="parts part-1"></div>
				<div class="parts part-2"></div>
				<div class="parts part-3"></div>
			</div>
	  		
	   <ul id="mycarousel" class="jcarousel-skin-header-slider">
		<li><img src="<?php echo base_url()?>static/images/toystory.jpg" width="680px" height="464" alt="" /><div class="description"><span class='
price '>$24.00</span><span class='
name '>Lamb chops and asparagus</span><a href="#" class="shop">shop now</a></div></li>
		<li><img src="<?php echo base_url()?>static/images/up.jpg" width="680px"  height="464" alt="" /><div class="description"><span class='
price '>$39.00</span><span class='
name '>Lamb chops and asparagus</span><a href="#" class="shop">shop now</a></div></li>
		<li><img src="<?php echo base_url()?>static/images/walle.jpg" width="680px"  height="464" alt="" /></li>
		<li><img src="<?php echo base_url()?>static/images/nemo.jpg" width="680px"  height="464" alt="" /></li>
	  </ul>
    </header><div class="copyrights">Collect from <a href="http://www.cssmoban.com/"  title="网站模板">网站模板</a></div>
<div class="content clearfix">
<div id="meals-of-the-day">
				<h3 class="title-separator"><span class="title">Meals of the day</span><span class="sep"></span></h3>
				<ul>
					<li class="meal">
						<div class="img-holder"><img src="<?php echo base_url()?>static/images/meal-1.png" alt=""></div>
            <div class="desc-holder">
							<h1><a href="#">Lorem ipsum dolar sit amet consectetur</a></h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac massa mauris, vitae viverra mauris. Proin libero purus, feugiat rhoncus auctor ut, tempus dictum nunc.</p>
							<span class="price">$15.45</span>
							<a href="check-out.php" class="add-to-cart-button">add to cart</a>
						</div>
					</li>
					<li class="meal">
						<div class="img-holder"><img src="<?php echo base_url()?>static/images/meal-2.png" alt=""></div>
            <div class="desc-holder">
							<h1><a href="#">Lorem ipsum dolar sit amet consectetur</a></h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac massa mauris, vitae viverra mauris. Proin libero purus, feugiat rhoncus auctor ut, tempus dictum nunc.</p>
							<span class="price">$15.45</span>
							<a href="check-out.php" class="add-to-cart-button">add to cart</a>
						</div>
					</li>
					<li class="meal">
						<div class="img-holder"><img src="<?php echo base_url()?>static/images/meal-3.png" alt=""></div>
            <div class="desc-holder">
							<h1><a href="#">Lorem ipsum dolar sit amet consectetur</a></h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac massa mauris, vitae viverra mauris. Proin libero purus, feugiat rhoncus auctor ut, tempus dictum nunc.</p>
							<span class="price">$15.45</span>
							<a href="check-out.php" class="add-to-cart-button">add to cart</a>
						</div>
					</li>
					<li class="meal">
						<div class="img-holder"><img src="<?php echo base_url()?>static/images/meal-1.png" alt=""></div>
            <div class="desc-holder">
							<h1><a href="#">Lorem ipsum dolar sit amet consectetur</a></h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac massa mauris, vitae viverra mauris. Proin libero purus, feugiat rhoncus auctor ut, tempus dictum nunc.</p>
							<span class="price">$15.45</span>
							<a href="check-out.php" class="add-to-cart-button">add to cart</a>
						</div>
					</li>
					<li class="meal">
						<div class="img-holder"><img src="<?php echo base_url()?>static/images/meal-2.png" alt=""></div>
            <div class="desc-holder">
							<h1><a href="#">Lorem ipsum dolar sit amet consectetur</a></h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac massa mauris, vitae viverra mauris. Proin libero purus, feugiat rhoncus auctor ut, tempus dictum nunc.</p>
							<span class="price">$15.45</span>
							<a href="check-out.php" class="add-to-cart-button">add to cart</a>
						</div>
					</li>
					<li class="meal">
						<div class="img-holder"><img src="<?php echo base_url()?>static/images/meal-3.png" alt=""></div>
            <div class="desc-holder">
							<h1><a href="#">Lorem ipsum dolar sit amet consectetur</a></h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac massa mauris, vitae viverra mauris. Proin libero purus, feugiat rhoncus auctor ut, tempus dictum nunc.</p>
							<span class="price">$15.45</span>
							<a href="check-out.php" class="add-to-cart-button">add to cart</a>
						</div>
					</li>
				</ul>
			</div>
			<h3 class="title-separator"><span class="title">Featured meals</span><span class="sep"></span></h3>
			
			
			<div id="featured-meals">
				<ul>
					<li class="meal">
						<div class="img-holder"><img src="<?php echo base_url()?>static/images/meal-4.jpg" alt=""></div>
						<h1><a href="#">Lorem ipsum</a></h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						<span class="price">$15.45</span>
						<a href="check-out.php" class="add-to-cart-button">add to cart</a>
					</li>
					<li class="meal">
						<div class="img-holder"><img src="<?php echo base_url()?>static/images/meal-5.jpg" alt=""></div>
						<h1><a href="#">Lorem ipsum</a></h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
						<span class="price">$15.45</span>
						<a href="check-out.php" class="add-to-cart-button">add to cart</a>
					</li>
					<li class="meal">
						<div class="img-holder"><img src="<?php echo base_url()?>static/images/meal-6.jpg" alt=""></div>
						<h1><a href="#">Lorem ipsum</a></h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						<span class="price">$15.45</span>
						<a href="check-out.php" class="add-to-cart-button">add to cart</a>
					</li>
				</ul>
			</div>

			<div class="cart-box">
				<div class="top">Cart</div>
				<div class="body">
					<ul>
						<li class="info">
							<span class="products"><strong>5</strong> products</span>
							<a href="#">View cart</a>
						</li>
						<li class="price">
							<span class="label">Shipping</span>
							<span class="value">$0.00</span>
						</li>
						<li class="price">
							<span class="label">Total</span>
							<span class="value">$0.00</span>
						</li>
					</ul>
					<a class="submit-button" href="check-out.php">Check out</a>
					<div class="graphic"></div>
				</div>
			</div>
  </div>
</div>
