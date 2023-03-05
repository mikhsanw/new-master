@extends('layouts.backend.index')
@push('header', ($menu->nama ?? 'Perbaikan'))
@section('content')
<section class="error-page h-p100">
		<div class="container h-p100">
		  <div class="row h-p100 align-items-center justify-content-center text-center">
			  <div class="col-lg-7 col-md-10 col-12">
				  <div class="rounded30 p-50">
					  <h1 class="font-size-180 font-weight-bold error-page-title"> <i class="fa fa-gear fa-spin"></i></h1>
					  <h1>{{ ($menu->nama ?? 'Perbaikan') }}!</h1>
					  <h3>Mohon maaf, halaman ini sedang dalam perbaikan.</h3>
					  <h4>Silahkan kunjungi kembali nanti.</h4>	
				  </div>
			  </div>				
		  </div>
		</div>
	</section>
@endsection
