@extends('layouts.backend.index')
@push('title', $halaman->nama)
@push('header', $halaman->nama)
@push('tombol')
<a class="waves-effect waves-light btn bg-gradient-primary py-2 px-3 b-0 text-white tambah" href="#tambah">
	Tambah
</a>
@endpush
@section('content')
<div class="panel-container show">
	<div class="panel-content">
		<table id="datatable" class="table table-striped table-bordered display" style="width:100%">
			<thead class="bg-primary">
				<tr>
					<th>Nama Grup</th>
					<th>Alias</th>
					<th class="text-center wid-10" tabindex="0" rowspan="1" colspan="1">Akses Menu</th>
					<th class="text-center wid-10" tabindex="0" rowspan="1" colspan="1">Aksi</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
@endsection
@push('js')
@include('layouts.backend.js.datatable-js')
<script type="text/javascript" src="{{ URL::asset(config('master.aplikasi.author').'/'. $halaman->kode .'/jquery.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset(config('master.aplikasi.author').'/'. $halaman->kode .'/datatables.js') }}"></script>
@endpush
