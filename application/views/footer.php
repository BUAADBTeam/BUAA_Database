<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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


	<script type="text/javascript" src="<?php echo base_url()?>static/js/libs/jquery-1.7.1.min.js"></script>
  <script src="<?php echo base_url()?>static/js/libs/jquery.easing.1.3.js"></script>
  <script src="<?php echo base_url()?>static/js/script.js"></script>
  <script src="<?php echo base_url()?>static/js/libs/jquery.jcarousel.min.js"></script>
	
	<script type="text/javascript">
	// FRONT SLIDER STARTER
jQuery(document).ready(function() {
jQuery('#mycarousel').jcarousel({
auto: 3,
wrap: 'last',
scroll: 1,
animation: 'slow',
initCallback: mycarousel_initCallback,
});
}); 
	</script>

</html>