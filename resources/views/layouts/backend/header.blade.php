<header class="main-header">
	<div class="d-flex align-items-center logo-box">
		<a href="#" class="waves-effect waves-light nav-link rounded d-none d-md-inline-block mx-10 push-btn" data-toggle="push-menu" role="button">
			<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
		</a>	
		<!-- Logo -->
		<a href="{{url('/home')}}" class="logo">
		  <!-- logo-->
		  <div class="logo-lg">
			@if($aplikasi->file_logo || $aplikasi->file_favicon)
			<span class="light-logo"><img src="{{ $aplikasi->file_logo?asset($aplikasi->file_logo->url_stream):($aplikasi->file_favicon?asset($aplikasi->file_favicon->url_stream):'') }}" height="40px" class="text-left"> {{$aplikasi->singkatan}}</span>
			  <span class="dark-logo"><img src="{{ $aplikasi->file_logo?asset($aplikasi->file_logo->url_stream):($aplikasi->file_favicon?asset($aplikasi->file_favicon->url_stream):'') }}" height="40px" class="text-left"> {{$aplikasi->singkatan}}</span>
			  
			  <!-- <span class="light-logo"><img src="{{url('backend/images/logo-light-text.png')}}" alt="logo"></span>
			  <span class="dark-logo"><img src="{{url('backend/images/logo-light-text.png')}}" alt="logo"></span> -->
			@endif
		  </div>
		</a>	
	</div>  
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-10">
		<div class="container">
		  <!-- Sidebar toggle button-->
		  <div class="app-menu">
			<ul class="header-megamenu nav">
				<li class="btn-group nav-item d-md-none">
					<a href="#" class="waves-effect waves-light nav-link rounded push-btn" data-toggle="push-menu" role="button">
						<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
					</a>
				</li>
				<li class="btn-group nav-item d-none d-xl-inline-block">
					<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded full-screen" title="Full Screen">
						<i class="icon-Expand-arrows"><span class="path1"></span><span class="path2"></span></i>
					</a>
				</li>
			</ul> 
		  </div>

		  <div class="navbar-custom-menu r-side">
			<ul class="nav navbar-nav">		  
				
			  <!-- User Account-->
			  <li class="dropdown user user-menu">
				<a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown" title="User">
					<i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
				</a>
				<ul class="dropdown-menu animated flipInX">
				  <li class="user-body">
					 <a class="dropdown-item" href="{{url('user/ubahpassword/'.$user->id)}}"><i class="ti-user text-muted mr-2"></i> Ubah Password</a>
					 <div class="dropdown-divider"></div>
					 <a class="dropdown-item keluar" href="#keluar"><i class="ti-lock text-muted mr-2"></i>  {{ __('Logout') }}
                                    </a>

				  </li>
				</ul>
			  </li>	

			  <!-- Control Sidebar Toggle Button -->
			  <li>
				  <a href="#" data-toggle="control-sidebar" title="Setting" class="waves-effect waves-light">
					<i class="icon-Settings"><span class="path1"></span><span class="path2"></span></i>
				  </a>
			  </li>

			</ul>
		  </div>
		</div>
    </nav>
  </header>