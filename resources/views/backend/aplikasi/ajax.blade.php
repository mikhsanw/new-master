$(function(){
	$('#logo form').on('submit', function (e){
		if (!e.isDefaultPrevented()){
			$.ajax({
				url : "{{ url($kode.'/store_logo') }}",
				type : "POST",
				data: new FormData($(this)[0]),
				processData: false,
				contentType: false,
				cache: false,
				xhr:function () {
				let xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function (evt) {
					if (evt.lengthComputable) {
						let percentComplete = evt.loaded / evt.total;
						percentComplete = parseInt(percentComplete * 100);
						$('.progress-bar-logo').css('width', percentComplete + '%').html(`Menyimpan Data ${percentComplete}%`);
						if (percentComplete >=99) {
							$('.progress-bar-logo').css('width', percentComplete + '%').html("Selesai " + percentComplete + '%');
						}
					}
				}, false);
				return xhr;
			},
			beforeSend: function () {
				$('.btn-logo').prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i> Menyimpan');
				$('.is-invalid').toggleClass('is-invalid');
				$('.invalid-feedback').remove();
				$('.progress').show().find('.progress-bar-logo').css('width', '0%').html("Mengirim Data 0%");
			},
				success: function (res) {
					if (res.status === true) {
						$('#datatable').DataTable().ajax.reload();
						Swal.fire({
							title: 'Sukses!',
							text: res.pesan,
							type: 'success',
							timer: 1500
						}).then((result) => {
							// if (result.dismiss === Swal.DismissReason.timer) {
							//     $('.modal').modal('hide');
							// }
						});
						$('.modal').modal('hide');
					} else {
						$.each(res.pesan, function (index, value) {
							$('#' + index).toggleClass('is-invalid').after('<span class="invalid-feedback" role="alert">' + value + '</span>');
						});
						$('.btn-logo').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan')
						$('.progress').hide();
					}
				},
				error : function(data){
					
				}
			});
			return false;
		}
	});
});

$(function(){
	$('#favicon form').on('submit', function (e){
		if (!e.isDefaultPrevented()){
			$.ajax({
				url : "{{ url($kode.'/store_favicon') }}",
				type : "POST",
				data: new FormData($(this)[0]),
				processData: false,
				contentType: false,
				cache: false,
				xhr:function () {
				let xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function (evt) {
					if (evt.lengthComputable) {
						let percentComplete = evt.loaded / evt.total;
						percentComplete = parseInt(percentComplete * 100);
						$('.progress-bar-favicon').css('width', percentComplete + '%').html(`Menyimpan Data ${percentComplete}%`);
						if (percentComplete >=99) {
							$('.progress-bar-favicon').css('width', percentComplete + '%').html("Selesai " + percentComplete + '%');
						}
					}
				}, false);
				return xhr;
			},
			beforeSend: function () {
				$('.btn-favicon').prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i> Menyimpan');
				$('.is-invalid').toggleClass('is-invalid');
				$('.invalid-feedback').remove();
				$('.progress').show().find('.progress-bar-favicon').css('width', '0%').html("Mengirim Data 0%");
			},
				success: function (res) {
					if (res.status === true) {
						$('#datatable').DataTable().ajax.reload();
						Swal.fire({
							title: 'Sukses!',
							text: res.pesan,
							type: 'success',
							timer: 1500
						}).then((result) => {
							// if (result.dismiss === Swal.DismissReason.timer) {
							//     $('.modal').modal('hide');
							// }
						});
						$('.modal').modal('hide');
					} else {
						$.each(res.pesan, function (index, value) {
							$('#' + index).toggleClass('is-invalid').after('<span class="invalid-feedback" role="alert">' + value + '</span>');
						});
						$('.btn-favicon').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan')
						$('.progress').hide();
					}
				},
				error : function(data){
					
				}
			});
			return false;
		}
	});
});