@extends('layouts.backend.index')
@push('title', 'Akses Menu dari '. $aksesgrup->nama)
@push('header', 'Akses Menu dari '. $aksesgrup->nama)
@push('tombol')
<a href="{{ URL::asset($url_admin.'/aksesgrup') }}" class="waves-effect waves-light btn bg-gradient-danger text-white py-2 px-3 b-0 tambah">
	Kembali
</a>
<a href="#tambah" id="editable_table_new" aksesgrup-id="{{ $aksesgrup->id }}" class="waves-effect waves-light btn bg-gradient-secondary text-white py-2 px-3 b-0 tambah">
	Kelola
</a>
@endpush
@section('content')
<div class="panel-container show">
	<div class="panel-content">
		<table id="datatable" class="table table-striped table-bordered display" style="width:100%">
			<thead class="bg-primary-600">
				<tr>
					<th>Menu</th>
					<th>Sub Menu</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

@endsection
@push('js')
@include('layouts.backend.js.datatable-js')
<script type="text/javascript" src="{{ URL::asset(config('master.aplikasi.author').'/'.$halaman->kode.'/jquery.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset(config('master.aplikasi.author').'/'.$halaman->kode.'/'.$aksesgrup->id.'/datatables.js') }}"></script>

<link rel="stylesheet" href="{{ url('backend/assets/vendor_plugins/iCheck/icheck.min.js') }}">
@endpush
