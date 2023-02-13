<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="{{url('backend/images/favicon.ico')}}">

        <title>{{ config('master.aplikasi.nama') }} - Log in </title>
    
        <!-- Vendors Style-->
        <link rel="stylesheet" href="{{url('backend/main/css/vendors_css.css')}}">
        
        <!-- Style-->  
        <link rel="stylesheet" href="{{url('backend/main/css/style.css')}}">
        <link rel="stylesheet" href="{{url('backend/main/css/skin_color.css')}}">	
    </head>
    <body class="hold-transition {{config('master.aplikasi.color_skin')}} bg-img" style="background-image: url(backend/images/auth-bg/bg-1.jpg)">
        @yield('content')
        <!-- Vendor JS -->
        <script src="{{ asset('backend/main/js/vendors.min.js')}}"></script>
        <script src="{{ asset('backend/assets/icons/feather-icons/feather.min.js')}}"></script>

        <script src="{{ asset('resources/vendor/jquery/jquery.ui.shake.js') }}"></script>
        <script src="{{ asset('resources/vendor/jquery/jquery.enc.js') }}"></script>
        @stack('js')
    </body>
</html>
