<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from powerbi-admin-template.multipurposethemes.com/bs4/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Feb 2023 04:44:23 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="{!! ucwords(strtolower(($aplikasi->nama??'').' '.($aplikasi->daerah??''))) !!}">
    <meta name="author" content="{!! config('master.aplikasi.author') !!}">
    <link rel="icon" href="{{ asset($aplikasi->file_favicon->url_stream) }}">

    <title>{{ config('master.aplikasi.nama') }} - @stack('title')</title>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{url('backend/main/css/vendors_css.css')}}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{url('backend/main/css/style.css')}}">
	<link rel="stylesheet" href="{{url('backend/main/css/skin_color.css')}}">

	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css"> -->
	<link rel="stylesheet" media="screen, print" href="{{url('resources/css/sweetalert2/sweetalert2.bundle.css')}}">
	@stack('css')
     
  </head>

<body class="hold-transition light-skin sidebar-mini {{config('master.aplikasi.color_skin').' '.config('master.aplikasi.skin')}} fixed">
	
<div class="wrapper">
	<div id="loader"></div>
    @include('layouts.backend.header')

        @include('layouts.backend.sidebar')

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<div class="container">
				<!-- Main content -->
				@if(is_null($halaman))
					@yield('content')
                @else
					<div class="content-header">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="page-title"><i class="{!! $halaman->icon ?? 'fa fa-home' !!}"></i> &nbsp; {{$halaman->parent->nama??$halaman->nama}}</h3>
								<div class="d-inline-block align-items-center">
									<nav>
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
											<li class="breadcrumb-item" aria-current="page">{{$halaman->parent->nama??'Beranda'}}</li>
											<li class="breadcrumb-item active" aria-current="page">{{$halaman->nama}}</li>
										</ol>
									</nav>
								</div>
							</div>
							<h6 class="pull-right">{{date("l, d F Y")}}</h6>
							
						</div>
					</div>
					@if ($halaman->detail)
						@include('layouts.backend.sidebar_item.informasi',['judul'=>($halaman->detail['title'] ?? ''),'keterangan'=>($halaman->detail['keterangan'] ?? ''),'status_pengumuman'=>($halaman->detail['status_pengumuman'] ?? '')])
					@endif
					<!-- Main content -->
					<section class="content">
						<div class="row">
							
						<div class="col-12">
							<div class="box">
								<div class="box-header">						
									<h4 class="box-title">Data <small class="font-italic font-weight-light">@stack('header')</small></h4>
									<div class="box-controls pull-right">
										<ul class="nav nav-pills nav-pills-sm" role="tablist">
											<li class="nav-item">
												@stack('tombol')
											</li>
										</ul>
									</div>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										@yield('content')
									</div>
								</div>
							</div>
						</div>
						</div>
					</section>
				@endif
				<!-- /.content -->
			</div>
		</div>
		<!-- /.content-wrapper -->
		@include('layouts.backend.footer')
  
  @include('layouts.backend.sidebar_item.setting')
  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
</div>
<!-- ./wrapper -->
	
	<!-- Vendor JS -->
	<script src="{{url('backend/main/js/vendors.min.js')}}"></script>
    <script src="{{url('backend/assets/icons/feather-icons/feather.min.js')}}"></script>	
	<script src="{{url('backend/assets/vendor_components/PACE/pace.min.js')}}"></script>

	<!-- Power BI Admin App -->
	<script src="{{url('backend/main/js/template.js')}}"></script>
	<script src="{{url('backend/main/js/demo.js')}}"></script>
	<script src="{{url('backend/main/js/pages/dashboard.js')}}"></script>
	<script src="{{url('backend/main/js/pages/pace.js')}}"></script>
	
	<script src="{{ asset('resources/vendor/sweetalert2/sweetalert2.bundle.js') }}"></script>
	<script src="{{ asset('resources/vendor/jquery/blockUI.js') }}"></script>
	<script src="{{ asset('resources/vendor/jquery/jquery.loadmodal.js') }}"></script>
	<script src="{{ asset(config('master.aplikasi.author').'/js/jquery.js') }}"></script>
	<!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin='anonymous'></script> -->
	@stack('js')
	
</body>

<!-- Mirrored from powerbi-admin-template.multipurposethemes.com/bs4/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Feb 2023 04:45:18 GMT -->
</html>
