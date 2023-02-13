@extends('backend.home.index')
@push('title','Ubah Password')
@push('header','Ubah Password')
@section('content')
<div class="panel-container show">
	<div class="panel-content">
		<div class="gantipwd">
			<form>
				<div class="form-group">
					<label for="password_lama">Password Lama</label>
					<input type="password" name="password_lama" class="form-control" id="password_lama" placeholder="Password Lama">
				</div>
				<div class="form-group">
					<label for="password">Password Baru</label>
					<input type="password" name="password" class="form-control" id="password" placeholder="Password Baru">
				</div>
				<div class="form-group">
					<label for="password_confirmation">Ketik ulang password</label>
					<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Ketik ulang password">
				</div>
				<input type="hidden" value="{{$user->id}}" name="id" class="form-control" id="id">
		      <button type="button" onclick="ubahPassword()" class="btn btn-primary">Ubah</button>
	      	</form>
      </div>
	</div>
</div>
@endsection
@push('js')
<script src="{{ URL::asset('resources/vendor/jquery/jquery.enc.js') }}"></script>
<script src="{{ URL::asset('resources/vendor/jquery/jquery.form.js') }}"></script>
<script>
	function ubahPassword() {
		$.ajax({
			url: "{{ url($url_admin.'/user/ubahpassword')}}",
			type: "POST",
			data: {
				'_token'    		: '{{csrf_token()}}',
				'id'				: $(`#id`).val(),
				'password_lama'		: $(`#password_lama`).val(),
				'nama'				: $(`#nama`).val(),
				'password'			: $(`#password`).val(),
				'password_confirmation'		: $(`#password_confirmation`).val(),
			},
			beforeSend: function () {
				ojisatrianiLoadingFadeIn();
			},
			success: function (res) {
				ojisatrianiLoadingFadeOut();
				if (res.status === true) {
					Swal.fire({
						title: 'Sukses!',
						text: res.pesan.msg,
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
						text: res.pesan.msg,
						type: 'info',
						timer: 3000
					});
				}
			}
		});
	}
</script>
@endpush
@push('css')

@endpush
