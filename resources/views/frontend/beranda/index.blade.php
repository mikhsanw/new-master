@extends('layouts.frontend.main')
@section('title', 'Beranda')
@section('img', ($aplikasi->file_logo?(asset($aplikasi->file_logo->url_stream)):''))
@section('content')
		<section id="slider" class="slider-element boxed-slider">
			<div class="fslider">
				<div class="flexslider">
					<div class="slider-wrap">
					@foreach($slider as $data)
						<div class="slide">
							<a href="#" class="d-block position-relative">
								<img src="{{$data->file->url_stream}}')" alt="Slide 2">
							</a>
						</div>
					@endforeach
					</div>
				</div>
			</div>
		</section>
@endsection
