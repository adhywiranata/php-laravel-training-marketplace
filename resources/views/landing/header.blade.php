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
					<a href="{{ url('') }}">
						<img src="{{ url() }}/images/cektraining-color.png" title="CekTraining" width="230px" />
					</a>
				</div>
			<!---- //End-logo---->
			<!----start-top-contact-info---->
			<div class="top-contact-info">
					<a href="{{ url('training-provider') }}" class="nav-btn">Become a Training Provider</a>
					<a href="{{ url('freelance-trainer') }}" class="nav-btn">Become a Freelance Trainer</a>
					<a href="{{ url('login') }}" class="nav-btn">Login</a>
				<!----//End-top-contact-info-box--->
				<div class="clear"> </div>
			</div>
			<div class="clear"> </div>
			<!----end-top-contact-info---->
		</div>
		<!---- //End-header---->
	</div>
