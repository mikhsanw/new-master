$(function () {
	"use strict";
	$(".myadmin-alert .closed").click(function (event) {
		$(this).parents(".myadmin-alert").fadeToggle(350);
		return false;
	});
});

$(document).keyup(function(e) {
     if (e.keyCode == 27) { // escape
        ojisatrianiLoadingFadeOut()
    }
});

$(document).ajaxStart(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        beforeSend: function(xhr) {
            if("{!! $user->remember_token !!}" === ""){
                xhr.abort();
                $('#lock-screen-modal').modal({backdrop: 'static', keyboard: false});
            }
        }
    });
});

$(document).ajaxError(function (event, jqxhr, settings, exception) {
	if (jqxhr.status == 500) {
		$(".alertbottom").fadeToggle(350);
	}
});

$(document).ready(function(){
    <!-- loadNotification(); -->
    lockScreen();

	$('.ubahpassword').click(function(){
		ojisatrianiLoadingFadeIn();
		var id = $(this).attr('user-id');
		$.loadmodal({
			url: "{{ url($url_admin.'/user/ubahpassword') }}/"+ id,
			id: 'responsive',
			dlgClass: 'fade',
			bgClass: 'warning',
			title: 'Ubah Password',
			width: 'whatever',
			modal: {
				keyboard: true,
				// any other options from the regular $().modal call (see Bootstrap docs)
				},
					ajax: {
				dataType: 'html',
				method: 'GET',
				success: function(data, status, xhr){
					ojisatrianiLoadingFadeOut();
				},
			},
				});
		return false;
	});

	$('.keluar').click(function(){
		$.ajax({
			type: 'POST',
			url: '{{ url('logout') }}',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			enctype: 'multipart/form-data',
			dataType: 'json',
			cache: false,
			beforeSend: function(){
					{{-- sebelumKirim(); --}}
			},
			success: function(data){
				location.href="{{ url('login') }}"
			},
			error: function(x, e){
				//	errorMsg(x.status);
			}
		});
	});

    $("#form-lock-screen #password").keyup(function(e){
		var code = e.which;
		if(code==13)e.preventDefault();
		if(code==32||code==13||code==188||code==186){
			$("#unlock-screen").click();
		}
	});

    $('#unlock-screen').click(function(e){
        $.ajax({
            type: "POST",
			url: "{{ url('pengguna/masuk') }}",
			data: {
                'username': $('#form-lock-screen #username').val(),
                'password': btoa($('#form-lock-screen #password').val()),
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
			dataType: 'json',
			cache: false,
			beforeSend: function(){
                $('#unlock-screen').attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                $('#form-lock-screen #password').removeClass('is-invalid');
            },
            success: function(data){
                $('#unlock-screen').attr('disabled', false).html('<i class="fa fa-key"></i>');
                if(data.status){
                    location.reload();
                }else{
                    $('#form-lock-screen #password').val('').addClass('is-invalid').focus();
                }
            }
        });
    });
});

function ojisatrianiLoadingFadeIn() {
    loadingBlock();
    internetConnection();
}

function ojisatrianiLoadingFadeOut() {
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

let error = 1;
function loadNotification() {
    $.ajax({
        url: "{{url($url_admin.'/notification')}}",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('.notify').remove();
            $.each(data.sidebar, function (key, notify) {
                if (notify.count > 0) {
                    $('.' + key).append('<span class="notify badge badge-icon position-relative ml-2 pull-right">' + notify.count + '</span>');
                }
            });
        }, error: function (e) {
            if (error++ < 3) {
                loadNotification();
                console.log("%cx " + e['responseJSON'].message + ",  reconnect ...", "color: #ff2222");
            } else {
                console.log("🙂 %c sorry we tried, but the server did not respond", "color: orange;");
            }
        }
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
                ojisatrianiLoadingFadeOut();
            }
        })
    }
}

function lockScreen(){
    if("{!! $user->remember_token !!}" === ""){
        $('#lock-screen-modal').modal({backdrop: 'static', keyboard: false});
    }else{
        let onBackground = false;
        let timeout = null;
        $(window).on('blur', function () {
            onBackground = true;
            timeout = setTimeout(function () {
                if (onBackground && !$('.modal').hasClass('show')) {
                    $.ajax({
                        url: "{{ url($url_admin.'/lock-screen') }}",
                        type: 'POST',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            _method: 'POST',
                        },
                        success: function (data) {
                            if (data.status) {
                                $('#lock-screen-modal').modal({backdrop: 'static', keyboard: false});
                            }
                        }
                    });
                }
                clearTimeout(timeout);
            }, 1000 * 60 * 30);
        }).on('focus', function () {
            onBackground = false;
            clearTimeout(timeout);
        });
    }
}
