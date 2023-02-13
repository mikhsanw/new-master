<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="{{$aplikasi->singkatan}}" />
	<meta name="description" content="{{$aplikasi->singkatan.' '.$aplikasi->daerah}} - @yield('title')" />
	<link rel="canonical" href="{{url()->full()}}" />
	<meta property="og:locale" content="id_ID" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="@yield('title')" />
	<meta property="og:description" content="{{$aplikasi->singkatan.' '.$aplikasi->daerah}} - @yield('title')" />
	<meta property="og:url" content="{{url()->full()}}" />
	<meta property="og:site_name" content="{{$aplikasi->singkatan.' '.$aplikasi->daerah}} - @yield('title')" />
	<meta property="article:modified_time" content="{{date('Y-m-d H:i:s')}}" />
	<meta property="og:image" content="@yield('img')" />
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:label1" content="Est. reading time" />
	<meta name="twitter:data1" content="3 minutes" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ URL::asset('frontend/css/bootstrap.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ URL::asset('frontend/style.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ URL::asset('frontend/css/dark.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ URL::asset('frontend/css/font-icons.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ URL::asset('frontend/css/animate.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ URL::asset('frontend/css/magnific-popup.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ URL::asset('frontend/css/swiper.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ URL::asset('frontend/css/custom.css') }}" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	@if($aplikasi->file_favicon)
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($aplikasi->file_favicon->url_stream) }}">
	<title>@yield('title') | {{$aplikasi->singkatan.' '.$aplikasi->daerah}}</title>
	@endif
	@stack('css')
</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		@include('layouts.frontend.header')
		@yield('content')
		@include('layouts.frontend.footer')


	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="{{ URL::asset('frontend/js/jquery.js') }}"></script>
	<script src="{{ URL::asset('frontend/js/plugins.min.js') }}"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{ URL::asset('frontend/js/functions.js') }}"></script>
	@stack('js')
	<script>
	$(function() {
		$( "#side-navigation" ).tabs({ show: { effect: "fade", duration: 400 } });
	});
</script>

</body>
</html>