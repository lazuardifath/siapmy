<!doctype html>
<html>
<head>
	<title>@yield('title','') | MY-Siap</title>
	<!-- initiate head with meta tags, css and script -->

	@include('include.head')
</head>
<body id="app" >
    <div class="wrapper">
    	<!-- initiate header-->
    	@include('include.header')
    	<div class="page-wrap">
	    	<!-- initiate sidebar-->
	    	@include('include.sidebar')

	    	<div class="main-content">
	    		<!-- yeild contents here -->
	    		@yield('content')
	    	</div>

            <!-- initiate chat section-->
	    	@include('include.chat')

            @include('include.bottomnav')
	    	<!-- initiate footer section-->
	    	@include('include.footer')

    	</div>
    </div>

	<!-- initiate modal menu section-->
	@include('include.modalmenu')

	<!-- initiate scripts-->
	@include('include.script')
</body>
</html>
