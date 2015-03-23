<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Creative Wizardry</title>
	<meta property="og:title" content="Creative Wizardry" />
    <meta property="og:site_name" content="http://creativewizardry.com"/>
    <meta property="og:url" content="http://creativewizardry.com"/>
    <meta property="og:description" content="Creative Wizardry"/>
	<!-- Stylesheets -->
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet"/>
	<!-- Fonts -->
	<link href="//fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div id="page" class="page-width">
		<div id="page-nav">
			<nav>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ url('/about') }}">About</a></li>
					<li><a href="{{ url('/contact') }}">Contact</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</nav>
			<div class="clear"></div>
		</div>
		<div id="page-head"></div>
		<div id="page-body">
			<div id="body-primary" class="page-col">
				@yield('content')
			</div>
			<div id="body-secondary" class="page-col">
				@yield('secondary')
			</div>
			<div class="clear"></div>			
		</div>
		<div id="page-foot">
			<p>Disclaimer: The opinions expressed are my own personal opinions and do not represent my employer's view in any way.<p>
		</div>
	</div>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
