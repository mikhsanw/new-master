@extends('layouts.ppid.main')
@section('title', 'Indeks Kepuasan Masyarakat')
@section('img', asset($aplikasi->file_logo->url_stream))
@section('content')
	<section id="content">
		<div class="content-wrap">
			<div class="container clearfix">
				<div class="row justify-content-center">
					<div class="col-lg-12 col-md-10">
						<div class="card shadow">
							<div class="card-body">
								<h2 class="center" style="margin-bottom:-40px">Indeks Kepuasan Masyarakat</h2>
								<div class="line mb-2"></div>
								<p>Formulir Indeks Kepuasan Masyarakat
Kuesioner Indeks Kepuasan Masyarakat Bapak/Ibu Yang Terhormat, Kami mohon Anda berkenan mengisi kuesioner berikut ini sebagai upaya kami terus-menerus memperbaiki dan memberikan pelayanan yang terbaik kepada masyarakat. Partisipasi Anda akan sangat berguna untuk menyusun indeks kepuasan masyarakat atas layanan {{$aplikasi->nama. ' '.$aplikasi->daerah}}. Atas perhatian dan partisipasinya, disampaikan terima kasih.</p>
							<form>
								<div class="form-group row">
									<label for="email" class="col-sm-2 col-form-label">Email</label>
									<div class="col-sm-6">
										<input type="email" name="email" class="form-control" id="email" placeholder="Email">
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-2 col-form-label">Nama</label>
									<div class="col-sm-6">
										<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama">
									</div>
								</div>
								<div class="form-group row">
									<label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
									<div class="col-sm-10">
										<input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat">
									</div>
								</div>
								<div class="form-group row">
									<label for="hp" class="col-sm-2 col-form-label">Telepon / HP</label>
									<div class="col-sm-6">
										<input type="text" name="hp" class="form-control" id="hp" placeholder="Nomor Telepon / HP">
									</div>
								</div>
								<fieldset class="form-group">
									<div class="row">
										<legend class="col-form-label col-sm-2 pt-0">Pelayanan Kami</legend>
										<div class="col-sm-10">
											<div class="form-check">
												<input class="form-check-input" type="radio" name="status" id="status1" value="0" checked="">
												<label class="form-check-label" for="status1">
												Sangat Baik
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="status" id="status2" value="1">
												<label class="form-check-label" for="status2">
												Baik
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="status" id="status3" value="2">
												<label class="form-check-label" for="status3">
												Cukup Baik
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="status" id="status4" value="3">
												<label class="form-check-label" for="status4">
												Tidak Baik
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="status" id="status5" value="4">
												<label class="form-check-label" for="status5">
												Sangat Tidak Baik
												</label>
											</div>
										</div>
									</div>
								</fieldset>
								<div class="form-group row">
									<div class="col-sm-10">
										<button type="button" onclick="savePenilaian()" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('css')
<link rel="stylesheet" media="screen, print" href="{{ asset('resources/css/sweetalert2/sweetalert2.bundle.css') }}">
@endpush
@push('js')
<script src="{{ asset('resources/vendor/jquery/blockUI.js') }}"></script>
<script src="{{ asset('resources/vendor/sweetalert2/sweetalert2.bundle.js') }}"></script>
	<script>
		function savePenilaian() {
			$.ajax({
				url: "{{ url('ppid/save-ikm')}}",
				type: "POST",
				data: {
					'_token'    : '{{csrf_token()}}',
					'email'		: $(`#email`).val(),
					'nama'		: $(`#nama`).val(),
					'alamat'	: $(`#alamat`).val(),
					'hp'		: $(`#hp`).val(),
					'status'    : document.querySelector(`input[name="status"]:checked`).value,
				},
				beforeSend: function () {
					loadingFadeIn();
				},
				success: function (res) {
					loadingFadeOut();
					if (res.status === true) {
						Swal.fire({
							title: 'Sukses!',
							text: res.pesan,
							type: 'success',
							timer: 3000
						});
					} else {
						$.each(res.pesan, function(i, item) {
                            $("#"+i).addClass('is-invalid');
                            $("#"+i).after('<div class="invalid-feedback" role="alert">' + item +'</div>');
                        });
						Swal.fire({
							title: 'Whoops!',
							text: 'Lengkapi semua form',
							type: 'info',
							timer: 3000
						});
					}
				}
			});
		}

$(function () {
	"use strict";
	$(".myadmin-alert .closed").click(function (event) {
		$(this).parents(".myadmin-alert").fadeToggle(350);
		return false;
	});
});

$(document).keyup(function(e) {
     if (e.keyCode == 27) { // escape
        loadingFadeOut()
    }
});

$(document).ajaxStart(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
});

$(document).ajaxError(function (event, jqxhr, settings, exception) {
	if (jqxhr.status == 500) {
		$(".alertbottom").fadeToggle(350);
	}
});

function loadingFadeIn() {
    loadingBlock();
    internetConnection();
}

function loadingFadeOut() {
    $.unblockUI();
}

function loadingBlock() {
	$.blockUI({
		css: {
			border: 'none',
			padding: '10px',
			width: '150px',
			top:"40%",
            left: $('body').hasClass('mobile-view-activated') ? "30%" : "45%",
			textAlign:"center",
			backgroundColor: '#000',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			opacity: .5,
			color: '#fff'
		},
		message: '<h4>Loading... <i class="fa fa-refresh fa-spin"></i></h4>',
		onOverlayClick: $.unblockUI
	});
}

function internetConnection(){
    if(navigator.onLine === false || navigator.online === 'undefined'){
        Swal.fire({
            title: 'Internet Terputus',
            text: 'Silahkan cek koneksi internet anda, atau coba lagi nanti',
            type: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Okay',
            allowOutsideClick: false,
            allowEscapeKey: false,
            size: 'small',
        }).then((result) => {
            if (result.value) {
                loadingFadeOut();
            }
        })
    }
}

	</script>
@endpush