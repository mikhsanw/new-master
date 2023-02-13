@extends('layouts.ppid.main')
@section('title', $data->nama)
@section('img', asset($aplikasi->file_logo->url_stream))
@section('content')
		<!-- <section id="page-title">
			<div class="container clearfix">
				<h1>{{$data->nama}}</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Profil</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{$data->nama}}</li>
				</ol>
			</div>
		</section> -->
		@if($data->status==0)
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
					<div class="row justify-content-center">
						<div class="col-lg-12 col-md-10">
							<div class="card shadow">
								<div class="card-body m-md-5 m-xs-2">
									<h2 style="text-align:center ;">{{$data->nama}}</h2>
									<div class="line m-md-5 m-xs-2"></div>
									<p>{!!$data->isi!!}</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- #content end -->
		@elseif($data->status==3)
		<section id="content">
			<div class="content-wrap">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-12 col-md-10">
							<div class="card shadow">
								<div class="card-body m-md-5 m-xs-2">
									<h2 style="text-align:center ;">{{$data->nama}}</h2>
									<div class="line m-md-5 m-xs-2"></div>
									<div class="list-group">
										@foreach($doc as $dokumen)	
										<a href="#" class="list-group-item list-group-item-action dokumen" data-bs-toggle="modal" data-bs-target="#dokumen-modal-lg" data-bs-title="{{$dokumen->name}}" data-bs-whatever="{{$dokumen->url_stream}}">
											{{$dokumen->name}}
											<i class="i-plain icon-download float-end dokumen" data-bs-toggle="modal" data-bs-target="#dokumen-modal-lg" data-bs-title="{{$dokumen->name}}" data-bs-whatever="{{$dokumen->url_stream}}"></i>
										</a>
										@endforeach
									</div>

									<div class="line"></div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- #content end -->
		@endif
		

		<div class="modal fade" id="dokumen-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
						<button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
					</div>
					<div class="modal-body">
							<iframe width="100%" height="600px"></iframe>
					</div>
				</div>
			</div>
		</div>

		<script>
			var modalShow = document.getElementById('dokumen-modal-lg')
			modalShow.addEventListener('show.bs.modal', function (event) {
				var button = event.relatedTarget
				var recipient = button.getAttribute('data-bs-whatever')
				var title = button.getAttribute('data-bs-title')
				var modalTitle = modalShow.querySelector('.modal-title')
				modalTitle.textContent = 'Dokumen ' + title
				var makeIframe = modalShow.querySelector(".modal-body iframe");
				makeIframe.setAttribute("src", recipient);
			})
		</script>
@endsection