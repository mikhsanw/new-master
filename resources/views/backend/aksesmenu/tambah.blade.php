{!! Form::open(array('id' => 'frmOji', 'class' => 'form account-form', 'method' => 'post')) !!}
<div class="row">
	@include('backend.aksesmenu.menu.menu',['menu'=>$menu,'aksesgrup'=>$aksesgrup])
	{!! Form::hidden('url', URL::previous(), array('id' => 'url')) !!}
	{!! Form::hidden('id', $aksesgrup->id, array('id' => 'id')) !!}
</div>
<div class="row">
	<div class="col-md-12">
		<span class="pesan"></span>
	</div>
</div>
{!! Form::close() !!}
<script src="{{ URL::asset(config('master.aplikasi.author').'/aksesmenu/ajax.js') }}"></script>
<script src="{{ URL::asset(config('master.aplikasi.author').'/js/ajax.js') }}"></script>
