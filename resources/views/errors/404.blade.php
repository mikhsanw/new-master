
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(config('master.aplikasi.favicon')) }}">
    

    <title>@stack('title',$data['status'] ?? 'Error') | {!! config('master.aplikasi.singkatan') !!}</title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{url('backend/main/css/vendors_css.css')}}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{url('backend/main/css/style.css')}}">
	<link rel="stylesheet" href="{{url('backend/main/css/skin_color.css')}}">	

</head>
<body class="hold-transition theme-primary bg-img" style="background-image: url({{url('backend/images/auth-bg/bg-4.jpg')}})">
	
	<section class="error-page h-p100">
		<div class="container h-p100">
		  <div class="row h-p100 align-items-center justify-content-center text-center">
			  <div class="col-lg-7 col-md-10 col-12">
				  <div class="rounded30 p-50">
					  <img src="{{url('backend/images/auth-bg/404.jpg')}}" class="max-w-200" alt="" />
					  <h1>Halaman tidak ditemukan !</h1>
					  <h3>Ups, halaman yang anda cari tidak tersedia</h3>
					  <div class="my-30"><a href="{{ URL::previous() }}" class="btn btn-danger">Kembali</a></div>				  
				  </div>
			  </div>				
		  </div>
		</div>
	</section>


	<!-- Vendor JS -->
	<script src="{{url('backend/main/js/vendors.min.js')}}"></script>
    <script src="{{url('backend/assets/icons/feather-icons/feather.min.js')}}"></script>	


</body>

</html>