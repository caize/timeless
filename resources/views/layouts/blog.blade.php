<!DOCTYPE html>
<html>
	<head>
		<title>Timeless</title>

		<!-- meta -->
		<meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

        @section('css')
	    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	    <link href="{{ asset('css/blog/pace.css') }}" rel="stylesheet">
	    <link href="{{ asset('css/blog/custom.css') }}" rel="stylesheet">
	    <link rel="stylesheet" href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">
	    @show

	</head>

	<body>
		<div class="container">	
			<header id="site-header">
				<div class="row">
					<div class="col-md-4 col-sm-5 col-xs-8">
						<div class="logo">
							<h1><a href="{{ url('/') }}">Timeless</a></h1>
						</div>
					</div><!-- col-md-4 -->
					<div class="col-md-8 col-sm-7 col-xs-4">
						<nav class="main-nav" role="navigation">
							<div class="navbar-header">
  								<button type="button" id="trigger-overlay" class="navbar-toggle">
    								<span class="ion-navicon"></span>
  								</button>
							</div>

							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  								<ul class="nav navbar-nav navbar-right">
    								<li class="cl-effect-11"><a href="{{ url('/') }}" data-hover="Home">Home</a></li>
    								<li class="cl-effect-11"><a href="{{ url('/category/skill') }}" data-hover="Skill">Skill</a></li>
    								<li class="cl-effect-11"><a href="{{ url('/category/life') }}" data-hover="Life">Life</a></li>
    								<li class="cl-effect-11"><a href="{{ url('/post/about-timeless') }}" data-hover="About">About</a></li>
  								</ul>
							</div><!-- /.navbar-collapse -->
						</nav>
						<div id="header-search-box">
							<a id="search-menu" href="#"><span id="search-icon" class="ion-ios-search-strong"></span></a>
							<div id="search-form" class="search-form">
								<form role="search" method="get" id="searchform" action="#">
									<input type="search" placeholder="Search" required>
									<button type="submit"><span class="ion-ios-search-strong"></span></button>
								</form>				
							</div>
						</div>
					</div><!-- col-md-8 -->
				</div>
			</header>
		</div>

		<div class="content-body">
			<div class="container">
				<div class="row">
					<main class="col-md-12">

						@yield('content')	

					</main>
				</div>
			</div>
		</div>

		<footer id="site-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="copyright">&copy; 2016 <a>念念不忘，必有回响</a> 基于laravel5构建</a></p>
					</div>
				</div>
			</div>
		</footer>

		<!-- Mobile Menu -->
		<div class="overlay overlay-hugeinc">
			<button type="button" class="overlay-close"><span class="ion-ios-close-empty"></span></button>
			<nav>
				<ul>
					<li><a href="{{ url('/') }}" data-hover="Home">Home</a></li>
					<li><a href="{{ url('/category/skill') }}" data-hover="Skill">Skill</a></li>
					<li><a href="{{ url('/category/life') }}" data-hover="Life">Life</a></li>
					<li><a href="{{ url('/post/about-timeless') }}" data-hover="About">About</a></li>
				</ul>
			</nav>
		</div>

		@section('javascript')
	    <script src="https://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
    	<script src="https://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	    <script src="https://cdn.bootcss.com/pace/1.0.2/pace.min.js"></script>
	    <script src="https://cdn.bootcss.com/modernizr/2.8.3/modernizr.min.js"></script>
		<script src="{{ asset('js/blog/script.js') }}"></script>
		@show

	    <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
    	<script type="text/javascript">
	        var duoshuoQuery = {short_name:"itimeless"};
	        (function() {
	            var ds = document.createElement('script');
	            ds.type = 'text/javascript';ds.async = true;
	            ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
	            ds.charset = 'UTF-8';
	            (document.getElementsByTagName('head')[0] 
	             || document.getElementsByTagName('body')[0]).appendChild(ds);
	        })();
        </script>
    	<!-- 多说公共JS代码 end -->

	</body>
</html>
