<!doctype html>
<html>
<head>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Cooker</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="stylesheet" href="css/style.css?v=2">
  <link rel="stylesheet" href="../css/jcarousel.css">

  <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
  <script src="js/libs/modernizr-1.7.min.js"></script>
	
</head>

<body>
  
<!-- LOGIN POP UPS -->
<div id="popup-overlay"></div>
<div class="popup" id="popup-login">
	<h2>Login form</h2>
	<hr class="separator">
	<form method="post" action="" class="form clearfix">
		<fieldset>
			<label for="login-username">Username:</label>
			<input type="text" name="" id="login-username" class="input text">
			<label for="login-password">Password:</label>
			<input type="password" name="" id="login-password" class="input text">
		</fieldset>
	</form>
	<hr class="separator">
	<button class="button submit">Login</button>
	<div class="links"><a href="#">Forgotten password </a> | <a href="#" class="register-btn"> New account</a></div>
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
      <a href="index.php" class="logo"><img src="images/logo.png" alt="your logo" /></a>
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
    </header>
		<div class="content clearfix">
			<div class="breadcrumbs">
				<ul>
					<li><a href="#">Home</a></li>
					<li>Entrees</li>
				</ul>
			</div>
			<div class="left-content">
				
				
				<form method="post" action="" class="form contact-form">
					<fieldset>
						<label for="contact-your-name">Your name: <span class="required">*</span></label>
						<input type="text" id="contact-your-name" class="input text">
						<label for="contact-your-email">Your e-mail: <span class="required">*</span></label>
						<input type="text" id="contact-your-email" class="input text">
						<label for="contact-subject">Subject:</label>
						<input type="text" id="contact-subject" class="input text">
						<label for="contact-details">Details: <span class="required">*</span></label>
						<textarea id="contact-details" rows="30" cols="50" class="input textarea"></textarea>
						<span class="required-desr">* required fields</span>
						<button class="button">Send message</button>
					</fieldset>
				</form>

				<div class="contact-address">
					<h2 class="heading">Address</h2>
					<p><strong>Cooker Online Food</strong><br>
					101 Timberlachen Circle, Suite 202<br>
					Lake Mary, FL 32746</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse accumsan lectus vel dolor dignissim laoreet. Nulla sagittis malesuada eros in imperdiet. Duis consequat volutpat dictum. </p>
					<p>Nulla sagittis malesuada eros in imperdiet. Duis consequat volutpdictum. Suspendisse accumsan lectus vel dolor dignissim laoreet.</p>
				</div>
				
				<hr />

				<h2 class="heading">Find us here</h2>

				<div class="contact-map">
					<img src="images/contact-map.jpg" alt="">
				</div>
			</div>
			<div class="right-content">
				<div class="call-us">
					<span class="label">Call us now!</span>
					<span class="pop phone">0800/ 567 345</span>
					<span class="label">Working time:</span>
					<span class="pop">0-24h</span>
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

				<hr />
				<div class="featured-meals">
					
					<h2 class="heading">Featured meals</h2>

					<div class="prev-next-buttons">
						<a href="#" class="prev"></a>
						<a href="#" class="next"></a>
					</div>

					<div class="block meal">
						<ul>
							<li>
								<div class="image">
									<img src="images/meal-8.jpg" alt="">
								</div>
								<h1>Skewers</h1>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing...</p>
								<span class="price">$18.32</span>
								<a href="check-out.php" class="add-to-cart-button">add to cart</a>
							</li>
							<li>
								<div class="image">
									<img src="images/meal-8.jpg" alt="">
								</div>
								<h1>Skewers</h1>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing...</p>
								<span class="price">$18.32</span>
								<a href="check-out.php" class="add-to-cart-button">add to cart</a>
							</li>
						</ul>
					</div>
				</div>
			</div>			
		</div>
	</div>
		<footer>
			<div class="footer-holder">
				<a href="" class="logo">Cooker Logo</a>
						<div class="newsletter">
							<div class="quote">
								<h6>Newsletter</h6>
								<p>Sign-up for our newsletter and be always aware of the new offers and services:</p>
								<form method="post">
									<input type="text"><input type="submit" value="Submit" class="submit-button">
								</form>
							</div>
						</div>
						<div class="links first">
							<h6>follow us on...</h6>
							<ul>
								<li class="facebook"><a href="#">Facebook</a></li>
								<li class="twitter"><a href="#">Twitter</a></li>
								<li class="rss"><a href="#">Rss feed</a></li>
							</ul>
						</div>
						<div class="links">
							<h6>useful links</h6>
							<ul>
								<li><a href="#">Specials</a></li>
								<li><a href="#">New orders</a></li>
								<li><a href="#">Terms and conditions of use</a></li>
								<li><a href="#">About</a></li>
								<li><a href="#">Contact</a></li>
								<li><a href="#">Sitemap</a></li>
							</ul>
						</div>
						<div class="links">
							<h6>categories</h6>
							<ul>
								<li><a href="#">Fruits and vegetables</a></li>
								<li><a href="#">Seafood</a></li>
								<li><a href="#">Meat</a></li>
								<li><a href="#">Entrees</a></li>
								<li><a href="#">Pizza and pasta</a></li>
								<li><a href="#">Desserts</a></li>
							</ul>
						</div>
						<div class="credits clearfix">
							&copy; Copyright &copy; 2013.Company name All rights reserved.<a target="_blank" href="http://www.cssmoban.com/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a> -  More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a>
						</div>
			</div>
    </footer>
</body>
	<script src="js/libs/jquery-1.7.1.min.js" type="text/javascript"></script>
  <script src="js/libs/jquery.easing.1.3.js"></script>
  <script src="js/script.js"></script>
  <script src="js/libs/jquery.jcarousel.min.js"></script>

</html>