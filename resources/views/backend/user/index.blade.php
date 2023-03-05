@extends('layouts.backend.index')
@push('title','User')
@push('header','User')
@push('tombol')
<button class="waves-effect waves-light btn bg-gradient-primary text-white py-2 px-3 tambah">
	Tambah
</button>
@endpush
@section('content')
<div class="panel-container show">
	<div class="panel-content">
		<table id="datatable" class="table table-striped table-bordered display" style="width:100%">
			<thead class="bg-primary">
				<tr>
					<th class="text-center">Username</th>
					<th >Nama</th>
					<th >E-Mail</th>
					<th class="text-center">Akses Grup</th>
					<th class="text-center">Level</th>
					<th class="text-center wid-10">Aksi</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
@endsection
@push('js')
@include('layouts.backend.js.datatable-js')
<script type="text/javascript" src="{{ URL::asset(config('master.aplikasi.author').'/user/jquery.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset(config('master.aplikasi.author').'/user/datatables.js') }}"></script>
@endpush
