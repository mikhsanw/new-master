<!-- Header
============================================= -->
<header id="header" class="header-size-sm">
	<div class="container">
		<div class="header-row flex-column flex-lg-row justify-content-center justify-content-lg-start">

			<!-- Logo
			============================================= -->
			<div id="logo" class="me-0 me-lg-auto">
			@if($aplikasi->file_logo)
				<a href="{{url('/')}}" class="standard-logo" data-dark-logo="{{ URL::asset($aplikasi->file_logo->url_stream) }}"><img src="{{ URL::asset($aplikasi->file_logo->url_stream) }}" alt="Logo"></a>
				<a href="{{url('/')}}" class="retina-logo" data-dark-logo="{{ URL::asset($aplikasi->file_logo->url_stream) }}"><img src="{{ URL::asset($aplikasi->file_logo->url_stream) }}" alt="Logo"></a>
			@endif
			</div><!-- #logo end -->

			<div class="header-misc mb-4 mb-lg-0 order-lg-last">

				<ul class="header-extras me-0 me-sm-4">
					<li>
						<i class="i-plain icon-email3 m-0"></i>
						<div class="he-text">
							Email
							<span>{!!$kontak->email?$kontak->filterkontak('email')->isi:''!!}</span>
						</div>
					</li>
					<li>
						<i class="i-plain icon-call m-0"></i>
						<div class="he-text">
							Kontak
							<span>{!!$kontak->telp?$kontak->filterkontak('telp')->isi:''!!}</span>
						</div>
					</li>
				</ul>

			</div>

		</div>
	</div>

	<div id="header-wrap" class="border-top border-f5">
		<div class="container">
			<div class="header-row justify-content-between flex-row-reverse flex-lg-row">

				<div id="primary-menu-trigger">
					<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
				</div>

				<!-- Primary Navigation
				============================================= -->
				<nav class="primary-menu">

					<ul class="menu-container">
						@foreach($menu as $key => $val)
						<li class="menu-item">
							<a class="menu-link" href="{{is_string($val) ? $val : '#'}}"><div>{{$key}}</div></a>
							@if(!is_string($val))
							<ul class="sub-menu-container" style="min-width: max-content">
								@foreach($val as $keydata => $data)
									@if(count($data->children) > 3 && $keydata >= 10)
										@include('layouts.frontend.menu',['data'=>$data,'mega'=>true])
									@else
										@include('layouts.frontend.menu',['data'=>$data])
									@endif
								@endforeach
							</ul>
							@endif
						</li>
						@endforeach
					</ul>

				</nav><!-- #primary-menu end -->

				<form class="top-search-form" action="search.html" method="get">
					<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
				</form>

			</div>

		</div>
	</div>
	<div class="header-wrap-clone"></div>
</header><!-- #header end -->