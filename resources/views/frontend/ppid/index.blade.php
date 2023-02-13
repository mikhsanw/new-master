@extends('layouts.ppid.main')
@section('title', 'Beranda PPID')
@section('img', asset($aplikasi->file_logo->url_stream))
@section('content')
		<section id="slider" class="slider-element boxed-slider">
			<div class="fslider" data-animation="fade">
				<div class="flexslider">
					<div class="slider-wrap">
					@foreach($slider as $data)
						<div class="slide" data-thumb="{{$data->file->url_stream}}">
							<a href="#" class="d-block position-relative">
								<img src="{{$data->file->url_stream}}')" alt="Slide 2">
							</a>
						</div>
					@endforeach
					</div>
				</div>
			</div>
		</section>
		
		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap pb-0">
				<div id="posts" class="container has-init-isotope">
						
					<div class="fancy-title title-center title-border">
						<h3>Berita Terbaru Kesbangpol</h3>
					</div>

					<div id="oc-posts" class="owl-carousel posts-carousel carousel-widget posts-md" data-pagi="false" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-lg="4">
						@foreach($berita as $data)
						<div class="oc-item">
							<div class="entry">
								<div class="entry-image thumbnail d-flex">
									<a href="{{$data->file->url_stream??url('/frontend/images/Image_not_available.png')}}" data-lightbox="image"><img class="lazy entered lazy-loaded" src="{{$data->file->url_stream??url('/frontend/images/Image_not_available.png')}}" alt="{{$data->nama??''}}"></a>
								</div>
								<div class="entry-title title-xs nott">
									<h3><a href="{{url('/company/berita-detail/'.$data->id.'/'.Help::generateSeoURL($data->nama))}}">{{$data->nama}}</a></h3>
								</div>
								<div class="entry-meta">
									<ul>
										<li><i class="icon-calendar3"></i> {{date('d M Y', strtotime($data->tanggal))??''}}</li>
										<li><i class="icon-user"></i> {{$data->user->nama??''}}</li>
									</ul>
								</div>
								<div class="entry-content">
									<p>{!! Help::shortDescription($data->isi,20)!!}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>

					<div class="fancy-title title-center title-border">
						<h3>Galeri Foto</h3>
					</div>

					<div id="oc-images" class="owl-carousel image-carousel carousel-widget row-thumbnail" data-items-xs="2" data-items-sm="3" data-items-lg="4" data-items-xl="5">
						@foreach($foto as $data)
						<div class="oc-item thumbnail">
						<a href="{{$data->file->url_stream}}" data-lightbox="image" title="{{$data->nama}}"><img class="" data-animate="fadeInLeftBig" class="fadeInLeftBig animated" src="{{$data->file->url_stream}}" alt="{{$data->nama}}"></a>
						</div>
						@endforeach
					</div>

					<div class="fancy-title title-center title-border topmargin">
						<h3>Galeri Video</h3>
					</div>
					<div id="oc-images" class="owl-carousel image-carousel carousel-widget" data-items-xs="2" data-items-sm="3" data-items-lg="4" data-items-xl="5">
						@foreach($video as $data)
						<a class="grid-item" href="https://www.youtube.com/watch?v={{$data->link}}" data-lightbox="iframe">
							<div class="grid-inner thumbnail">
								<img src="https://i1.ytimg.com/vi/{{$data->link}}/hqdefault.jpg" alt="Youtube Video">
								<i class="icon-youtube-play bg-overlay-content h2 mb-0" style="display:flex; color:red"></i>
								<div class="bg-overlay">
									<div class="bg-overlay-content dark">
										<i class="icon-youtube-play h4 mb-0" data-hover-animate="fadeIn"></i>
									</div>
									<div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
								</div>
							</div>
						</a>
						@endforeach
					</div>

					<div class="fancy-title title-center title-border topmargin">
						<h3>Indeks Kepuasan Masyarakat</h3>
					</div>

					<div class="row col-mb-50 mb-0">
						<div class="col-md-6">
							<div class="card shadow">
								<div class="card-body">
								<div class="bottommargin mx-auto" style="max-width: 100%">
									<canvas id="chart-0"></canvas>
								</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card-body center">
								<div class="bottommargin mx-auto" style="max-width: 100%">
								<a href="{{url('/ppid/indeks-kepuasan-masyarakat')}}" class="button button-desc button-3d button-rounded button-teal center">Bagaimana Layanan kami ?<span>Klik disini &amp; berikan penilaian</span></a>
								</div>
							</div>
						</div>
					</div>
					
				</div>

			</div>
		</section><!-- #content end -->
@endsection
@push('css')
<style>
		.thumbnail {
  			height:250px;
		}
		.thumbnail img{
			object-fit: cover;
			width:100%;
  			height:100%;
		}
</style>
@endpush
@push('js')
	<script src="{{ URL::asset('frontend/js/chart.js') }}"></script>
	<script src="{{ URL::asset('frontend/js/chart-utils.js') }}"></script>
	<script>
		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
						'{{$ikm["sangat_baik"]}}',
						'{{$ikm["baik"]}}',
						'{{$ikm["cukup_baik"]}}',
						'{{$ikm["tidak_baik"]}}',
						'{{$ikm["sangat_tidak_baik"]}}',
					],
					backgroundColor: [
						window.chartColors.green,
						window.chartColors.blue,
						window.chartColors.yellow,
						window.chartColors.orange,
						window.chartColors.red,
					],
					label: 'Dataset 1'
				}],
				labels: [
					"Sangat Baik",
					"Baik",
					"Cukup Baik",
					"Tidak Baik",
					"Sangat Tidak Baik"
				]
			},
			options: {
				responsive: true
			}
		};

		window.onload = function() {
			var ctx = document.getElementById("chart-0").getContext("2d");
			window.myPie = new Chart(ctx, config);
		};
		
		</script>
@endpush