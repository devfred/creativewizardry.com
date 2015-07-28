<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>@yield('title', 'Notes/Thoughts/Research') | Creative Wizardry</title>
	<meta property="og:title" content="@yield('title', 'Notes/Thoughts/Research') | Creative Wizardry" />
    <meta property="og:site_name" content="http://creativewizardry.com"/>
    <meta property="og:url" content="{{URL::current()}}"/>
    <meta property="og:description" content="@yield('description', 'Notes/Thoughts/Research | CreativeWizardry')"/>
    <link rel="search" href="{{ asset('opensearchdescription.xml') }}" type="application/opensearchdescription+xml" title="Search Creative Wizardry" />
	<!-- Stylesheets -->
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet"/>
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">	
	@yield('header_scripts')
</head>
<body>
	<div id="page" class="page-width">
        <div id="page-nav">
            <nav class="navbar navbar-default">
                <div>
                    <div class="navbar-header ">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"></a>
                    </div>

                    <div class="collapse navbar-collapse" id="navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/about') }}">About</a></li>
                            <li><a href="{{ url('/contact') }}">Contact</a></li>
                            @if (Auth::guest())
                                <li>
                                    <a class="btn btn-default btn-outline btn-circle collapsed"  data-toggle="collapse" href="#nav-collapse1" aria-expanded="false" aria-controls="nav-collapse1">Search</a>
                                </li>
                            @else
                                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                                <li>
                                    <a class="btn btn-default btn-outline btn-circle collapsed"  data-toggle="collapse" href="#nav-collapse3" aria-expanded="false" aria-controls="nav-collapse3">User Menu</a>
                                </li>
                            @endif
                        </ul>

                        <div class="collapse nav-collapse"  id="nav-collapse1">
                            <form class="navbar-form navbar-right form-inline" role="form" method="POST" action="{{ url('/search') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">                                                            
                                <div class="form-group">
                                    <input type="text" class="form-control" name="term" id="term"/>
                                </div>                                
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </form>
                        </div>

                        @if (Auth::guest())

                        @else
                            <ul class="collapse nav navbar-nav nav-collapse" id="nav-collapse3">
                                <li><a href="{{ url('/admin') }}">Admin Dashboard</a></li>
                            </ul>
                        @endif
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container -->
            </nav><!-- /.navbar -->
        </div>
		<div id="page-head">
                <h1 class="site-title"> <a href="/">Creative Wizardry </a></h1>
                <span class="h2 tagline"> <a href="/">Notes/Thoughts/Research </a></span>
        </div>
		<div id="page-body">

			<div id="body-top">
                @yield('body_top')
			</div>
			<div id="body-primary-admin">
				<div id="primary-content">
                    @if(Session::has('message'))
                        <div class="alert alert-info">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif                    
					@yield('content')
				</div>				
			</div>
			<div class="clear"></div>			
			<div id="body-bottom">
                <div class="module disclaimer">
                    <p class="alert alert-warning">Disclaimer: The opinions expressed here are my own personal opinions and do not represent my employer's view in any way.<p>
                </div>
            </div>
		</div>
		<div id="page-foot">
            <p>
                <a href="http://creativewizardry.com" title="Creative Wizardry" alt="Creative Wizardry">Creative Wizardry</a> is the personal playground of Frederick King. <a href="http://creativewizardry.com" title="Creative Wizardry" alt="Creative Wizardry">Creative Wizardry</a> makes heavy use of PHP and JavaScript. All original code is Copyright &copy;2015 <a href="http://creativewizardry.com" title="Creative Wizardry" alt="Creative Wizardry">Creative Wizardry</a> . Please enjoy.
            </p>
        </div>
	</div>
    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    @yield('footer_scripts')
</body>
</html>
