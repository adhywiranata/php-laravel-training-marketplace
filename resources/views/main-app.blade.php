<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<META NAME="robots" CONTENT="noindex">
	<title>@yield('title')</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/vendor.css') }}" rel="stylesheet">
	<!--<link href="{{ asset('/css/form-generator.css') }}" rel="stylesheet">-->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<input type="hidden" id="base_url" />

	<nav class="navbar navbar-default navbar-fixed-top" id="navbar-main">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand pull-right" href="{{url()}}">
					<img src="{{ url('images/cektraining-dark.png') }}" height="100%" />
				</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<!--<li><a href="#"><span class="btn bold trigger-popup trigger-request-trainer" style="margin-top:-5px;">Request for Training</span></a></li>-->
						<!--
						<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"  style="background:#222;"><i class="fa fa-search"></i> Find Training <span class="caret"></span></a>
		          <ul class="dropdown-menu" style="background:#333;">
		            <li style="background:#333;"><a href="#" style="background:#333;">Freelance Trainer</a></li>
		            <li style="background:#333;"><a href="#" style="background:#333;">Training Provider</a></li>
		            <li style="background:#222;"><a href="#" style="background:#222;">Public Training</a></li>
		          </ul>
        		</li>
						-->
						<!--
						<li><a href="{{ url('/trainers') }}">{{ trans('content.nav_find_trainer') }}</a></li>
						<li><a href="{{ url('/training-providers') }}">{{ trans('content.nav_find_provider') }}</a></li>
						<li><a href="{{ url('/public-trainings') }}">{{ trans('content.nav_find_public_training') }}</a></li>
						-->

						<li class="trigger-popup trigger-sign-in"><a>{{ trans('content.nav_login') }}</a></li>
					@else
						<!--
						<li><a href="{{ url('super-cool-coach/trainings') }}">{{ trans('content.nav_find_my_training') }}</a></li>
						<li><a href="{{ url('/dashboard') }}">{{ trans('content.nav_dashboard') }}</a></li>
					-->
						<!--
						<li>
							<a href="{{ url('public-training/add') }}">
								<span class="btn btn-green bold" style="margin-top:-5px;">
									{{ trans('content.nav_post_training') }}
								</span>
							</a>
						</li>
						-->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"  style="background:#222 !important; color:#fff !important;">
								<img src="http://speaqus.com/img/photos/profile_picture/original/fandyakwka.jpg" height="30px">
								@if(Auth::user()->first_name != '')
									{{ Auth::user()->first_name }}
									{{ Auth::user()->last_name }}
								@else
									{{ Auth::user()->email }}
								@endif
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="{{ url('dashboard') }}">
										{{ trans('content.nav_dashboard') }}
									</a>
								</li>
								<li>
									<a href="{{ url('dashboard/messages') }}">
										{{ trans('content.nav_messages') }}
										<span class="red-back padding-3-5 bold uppercase rounded">
											5 {{ trans('content.nav_unread') }}
										</span>
									</a>
								</li>
								<li>
									<a href="{{ url('dashboard/contacts') }}">
										{{ trans('content.nav_contacts') }}
										<span class="green-back padding-3-5 bold uppercase rounded">
											5 {{ trans('content.nav_new_contact') }}
										</span>
									</a>
								</li>
								<li>
									<a href="{{ url('settings/plan') }}">
										{{ trans('content.nav_account') }}
										<span class="bold">BASIC</span>
										<span class="orange-back padding-3-5 bold uppercase rounded">
											{{ trans('content.nav_upgrade') }}
										</span>
									</a>
								</li>
								<li>
									<a href="{{ url('logout') }}">
										{{ trans('content.nav_logout') }}
									</a>
								</li>
							</ul>
						</li>
					@endif
				</ul>
				@include('general.action-flash')
			</div>
		</div>
	</nav>

	@yield('content')

  <div class="popup-overlay">
  </div>

  @include('general.sign-in')

  @include('general.request-popup')

	@include('general.skill-popup')

	@include('general.send-message-popup')

	@include('general.send-evaluation-popup')

	@include('general.send-testimonial-popup')

	<div id="popup-container">

	</div>

	<!-- Scripts -->
	<script src="{{ asset('/js/vendor.js') }}"></script>

	<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
	<script src="{{ asset('/js/app.js') }}"></script>
	<!--<script src="{{ asset('js/form-engine.js') }}"></script>-->
</body>
</html>
