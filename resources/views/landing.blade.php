<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
	<head>
		<title>CekTraining</title>
		<link href="{{ url('css/landing/style.css') }}" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="images/fav-icon.png" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		</script>
		<!----webfonts---->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<!----//webfonts---->
		<!----include-js---->
		<script type="text/javascript" src="{{ url() }}/js/landing/jquery.min.js"> </script>
		<!----//include-js---->
		<script type="text/javascript" src="{{ url() }}/js/landing/move-top.js"></script>
		<script type="text/javascript" src="{{ url() }}/js/landing/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
				});
			});
		</script>
	</head>
	<body>
	<!---- start-wrap---->
		<!---- start-header---->
		<div class="header">
				<div class="wrap">
			<!---- start-logo---->
				<div class="logo">
					<a href="#">
						<img src="{{ url() }}/images/cektraining-color.png" title="CekTraining" width="230px" />
					</a>
				</div>
			<!---- //End-logo---->
			<!----start-top-contact-info---->
			<div class="top-contact-info">
				<!----start-top-social-icons---->
				<div class="top-social-icons">
					<ul>
						<li><a class="flicker" href="#"><span> </span></a></li>
						<li><a class="stub" href="#"><span> </span></a></li>
						<li><a class="face" href="#"><span> </span></a></li>
						<li><a class="twitter" href="#"><span> </span></a></li>
					</ul>
				</div>
				<!----//End-top-social-icons---->
				<!----start-top-contact-info-box--->
				<div class="top-contact-info-box">
					<span>Call now</span><i></i><label>1-800-123-456</label>
				</div>
				<!----//End-top-contact-info-box--->
				<div class="clear"> </div>
			</div>
			<div class="clear"> </div>
			<!----end-top-contact-info---->
		</div>
		<!---- //End-header---->
	</div>
	<!----start-slide-banner---->
	<div class="slide-banner">
		<div class="wrap">
			<div class="slide-banner-left">
				<div class="slide-banner-left-divice">

				</div>
				<!----slider-script---->
				<script>
					$(function() {

						$("#slideshow > div:gt(0)").hide();

						setInterval(function() {
						  $('#slideshow > div:first')
						    .fadeOut(1000)
						    .next()
						    .fadeIn(1000)
						    .end()
						    .appendTo('#slideshow');
						},  3000);

					});
				</script>
				<!----//End-script---->
				<div id="slideshow">
					   <div>
					     <img src="{{ url() }}/images/landing/slide1.jpg" alt="" />
					   </div>
					   <div>
					     <img src="{{ url() }}/images/landing/slide2.jpg" alt="" />
					   </div>
					   <div>
					     <img src="{{ url() }}/images/landing/slide3.jpg" alt="" />
					   </div>
				</div>
			</div>
			<div class="slide-banner-right">
				<h1 style="width:100%">
					Find the Most Effective Training Services in Any Minutes
				</h1>
				<p>
					CekTraining is an inspiring and resourceful online global training directory and marketplace
that helps to connect professionals training organizer and students with the right training services around the world.
				</p>
				<!--
				<p>Lorem <span>ipsum</span> dolor sit amet, consectetur adipiscing elit. Aliquam feugiat et nibh id hendrerit. Sed rhoncus pulvinar ipsum, et commodo nisl sodales vel. Etiam sit amet Duis pellentesque <span>vulputate tortor, ac volutpat</span> in. In ultrices metus purus comot es.</p>
			-->
				<ul>
					<li><a class="slide-bbtn" href="#">SIGN UP NOW FOR FREE</a></li>
					<li><a class="slide-bbtn" href="#">ARE YOU TRAINING VENDOR?</a></li>
				</ul>
			</div>
			<div class="clear"> </div>
		</div>
	</div>
	<!----//End-slide-banner---->
	<!----start-top-grids---->
	<div class="top-grids">
		<div class="wrap">
			<h2><span>WHY</span> CEKTRAINING ?</h2>
			<div class="top-grid">
				<div class="top-grid-head">
					<div class="top-grid-head-left">
						<span> </span>
					</div>
					<div class="top-grid-head-right">
						<h3><span>Lorem</span>ASIGNMENT</h3>
					</div>
					<div class="clear"> </div>
				</div>
				<div class="top-grid-info">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam feugiat et nibh id hendrerit. Sed rhoncus pulvinar ipsum, et commodo nisl sodales vel. Etiam sit amet commodo ligula. Nunc adipiscing. imperdiet est a dignissim.</p>
				</div>
			</div>
			<div class="top-grid">
				<div class="top-grid-head">
					<div class="top-grid-head-left icon1">
						<span> </span>
					</div>
					<div class="top-grid-head-right">
						<h3><span>DOLOR</span>SEARCH</h3>
					</div>
					<div class="clear"> </div>
				</div>
				<div class="top-grid-info">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam feugiat et nibh id hendrerit. Sed rhoncus pulvinar ipsum, et commodo nisl sodales vel. Etiam sit amet commodo ligula. Nunc adipiscing. imperdiet est a dignissim.</p>
				</div>
			</div>
			<div class="top-grid top-grid1">
				<div class="top-grid-head">
					<div class="top-grid-head-left icon2">
						<span> </span>
					</div>
					<div class="top-grid-head-right">
						<h3><span>Amet</span>SETTINGS</h3>
					</div>
					<div class="clear"> </div>
				</div>
				<div class="top-grid-info">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam feugiat et nibh id hendrerit. Sed rhoncus pulvinar ipsum, et commodo nisl sodales vel. Etiam sit amet commodo ligula. Nunc adipiscing. imperdiet est a dignissim.</p>
				</div>
			</div>
			<div class="clear"> </div>
		</div>
	</div>
	<!----//End-top-grids---->
	<!---carousel---->
	<div class="img-carousel">
		<div class="wrap">
			<h3><span>Take a look at</span> Our Users</h3>
			<!-- start content_slider -->
		       <div id="owl-demo" class="owl-carousel" >
	                <div class="item" style="max-height:50px !important;">
	                	<img class="lazyOwl" data-src="{{ url() }}/images/corporates/3m_indonesia_pt.jpg" alt="Lazy Owl Image">
	                </div>
	                 <div class="item" >
	                	<img class="lazyOwl" height="50px;" data-src="{{ url() }}/images/corporates/3m_indonesia_pt.jpg" alt="Lazy Owl Image">
	                </div>
	                 <div class="item">
	                	<img class="lazyOwl" data-src="{{ url() }}/images/corporates/3m_indonesia_pt.jpg" alt="Lazy Owl Image">
	                </div>
	                 <div class="item">
	                	<img class="lazyOwl" data-src="{{ url() }}/images/corporates/3m_indonesia_pt.jpg" alt="Lazy Owl Image">
	                </div>
	                  <div class="item">
	                	<img class="lazyOwl" data-src="{{ url() }}/images/corporates/3m_indonesia_pt.jpg" alt="Lazy Owl Image">
	                </div>
	                 <div class="item">
	                	<img class="lazyOwl" data-src="{{ url() }}/images/corporates/3m_indonesia_pt.jpg" alt="Lazy Owl Image">
	                </div>
              </div>
		</div>
		<!---start-carousel-script---->
		<link href="{{ url() }}/css/landing/owl.carousel.css" rel="stylesheet">
		 <script src="{{ url() }}/js/landing/owl.carousel.js"></script>
	     <script>
		    $(document).ready(function() {
		      $("#owl-demo").owlCarousel({
		        items : 4,
		        lazyLoad : true,
		        autoPlay : true,
		        pagination :false
		      });

		    });
	    </script>
		<!---//End-carousel-script---->
	</div>
	<!---img-carousel---->
	<!----start-price-tables----->
	<div class="price-tables">
		<div class="wrap">
			<h3><span>SING UP YOUR</span> PREMIUM memembership</h3>
			<div class="price-table-grids">
				<div class="price-table-grid price-table-grid1">
					<div class="price-table-grid-head price-table-grid-head1">
						<h2>Regular <label>$9.99</label></h2>
					</div>
					<div class="price-table-grid-info">
						<h4>included features</h4>
						<ul>
							<li><a href="#"><span> </span>basic features mini</a></li>
							<li><a href="#"><span> </span>lorem ipusm dolor sit amet</a></li>
							<li><a href="#"><span> </span>adipiscing dolor feugiat</a></li>
							<li><a href="#"><span> </span>basic features mini</a></li>
							<li><a href="#"><span> </span>lorem ipusm dolor sit amet</a></li>
							<a class="btn1" href="#">Buy Now</a>
							<div class="clear"> </div>
						</ul>

					</div>
				</div>
				<div class="price-table-grid price-table-grid2">
					<div class="price-table-grid-head price-table-grid-head2">
						<h2>ELITE <label>$29.99 </label></h2>
					</div>
					<div class="price-table-grid-info">
						<h4>included features</h4>
						<ul>
							<li><a href="#"><span> </span>basic features mini</a></li>
							<li><a href="#"><span> </span>lorem ipusm dolor sit amet</a></li>
							<li><a href="#"><span> </span>adipiscing dolor feugiat</a></li>
							<li><a href="#"><span> </span>basic features mini</a></li>
							<li><a href="#"><span> </span>lorem ipusm dolor sit amet</a></li>
							<a class="btn1 btn2" href="#">Buy Now</a>
							<div class="clear"> </div>
						</ul>

					</div>
				</div>
				<div class="price-table-grid price-table-grid3">
					<div class="price-table-grid-head price-table-grid-head3">
						<h2>Pro-user <label>$19.99</label></h2>
					</div>
					<div class="price-table-grid-info">
						<h4>included features</h4>
						<ul>
							<li><a href="#"><span> </span>basic features mini</a></li>
							<li><a href="#"><span> </span>lorem ipusm dolor sit amet</a></li>
							<li><a href="#"><span> </span>adipiscing dolor feugiat</a></li>
							<li><a href="#"><span> </span>basic features mini</a></li>
							<li><a href="#"><span> </span>lorem ipusm dolor sit amet</a></li>
							<a class="btn1 btn3" href="#">Buy Now</a>
							<div class="clear"> </div>
						</ul>

					</div>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
	</div>
	<!----//End-price-tables----->
	<!----start-bottom-grids---->
	<div class="bottom-grids">
		<div class="wrap">
			<div class="bottom-grid-left">
				<h3>What customers <span>say</span></h3>
				<div class="bottom-grid-boxs">
					<div class="bottom-grid-box">
						<div class="bottom-grid-box-left">
							<a href="#"> <img src="{{ url() }}/images/landing/people.jpg" alt="" /></a>
						</div>
						<div class="bottom-grid-box-right">
							<p>Donec sollicitudin rhoncus porta. Phasellus poret pretium mauris sapien sed arcu. Etiam eu riconvallis.</p>
							<ul>
								<li><a href="#">Jane Leonarde,</a></li>
								<li>lorem </li>
							</ul>
						</div>
						<div class="clear"> </div>
					</div>
					<div class="bottom-grid-box">
						<div class="bottom-grid-box-left">
							<a href="#"> <img src="{{ url() }}/images/landing/people.jpg" alt="" /></a>
						</div>
						<div class="bottom-grid-box-right">
							<p>Donec sollicitudin rhoncus porta. Phasellus poret pretium mauris sapien sed arcu. Etiam eu riconvallis.</p>
							<ul>
								<li><a href="#">Jane Leonarde,</a></li>
								<li>lorem </li>
							</ul>
						</div>
						<div class="clear"> </div>
					</div>
					<div class="bottom-grid-box">
						<div class="bottom-grid-box-left">
							<a href="#"> <img src="{{ url() }}/images/landing/people.jpg" alt="" /></a>
						</div>
						<div class="bottom-grid-box-right">
							<p>Donec sollicitudin rhoncus porta. Phasellus poret pretium mauris sapien sed arcu. Etiam eu riconvallis.</p>
							<ul>
								<li><a href="#">Jane Leonarde,</a></li>
								<li>lorem </li>
							</ul>
						</div>
						<div class="clear"> </div>
					</div>
					<div class="bottom-grid-box">
						<div class="bottom-grid-box-left">
							<a href="#"> <img src="{{ url() }}/images/landing/people.jpg" alt="" /></a>
						</div>
						<div class="bottom-grid-box-right">
							<p>Donec sollicitudin rhoncus porta. Phasellus poret pretium mauris sapien sed arcu. Etiam eu riconvallis.</p>
							<ul>
								<li><a href="#">Jane Leonarde,</a></li>
								<li>lorem </li>
							</ul>
						</div>
						<div class="clear"> </div>
					</div>
				</div>
			</div>
			<div class="bottom-grid-right">
				<h3>LEarn <span>more</span></h3>
				<iframe src="//www.youtube.com/embed/f0xpcXKhlWY"  allowfullscreen></iframe>
			</div>
			<div class="clear"> </div>
		</div>
	</div>
	<!----//End-bottom-grids---->
	<!----start-news-letter--->
	<div class="news-letter">
		<div class="wrap">
			<div class="news-letter-left">
				<h3><span>subscribe to our</span> Newsletter</h3>
			</div>
			<div class="news-letter-right">
				<form>
					<input type="text" placeholder="Enter Email here" required />
					<input type="submit" value="" />
				</form>
			</div>
			<div class="clear"> </div>
		</div>
	</div>
	<!----//End-news-letter--->
	<!----start-footer---->
	<div class="footer">
		<div class="wrap">
			<div class="footer-left">
				<p>Copyright &#169; 2013 <a href="http://munka.softpae.sk/">Martina Pitakova.</a> All right reserved .Template by <a href="http://w3layouts.com/">W3layouts</a></p>
			</div>
			<div class="footer-right">
				<ul>
					<li><a href="#"> Privacy Policy</a></li>
					<li><a href="#"> Terms & Conditions</a></li>
				</ul>
				<script type="text/javascript">
						$(document).ready(function() {
							/*
							var defaults = {
					  			containerID: 'toTop', // fading element id
								containerHoverID: 'toTopHover', // fading element hover id
								scrollSpeed: 1200,
								easingType: 'linear'
					 		};
							*/

							$().UItoTop({ easingType: 'easeOutQuart' });

						});
					</script>
			    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
			</div>
			<div class="clear"> </div>
		</div>
	</div>
	<!----//End-footer---->
	<!---- //End-wrap---->
	</body>
</html>
