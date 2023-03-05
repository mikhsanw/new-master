@extends('layouts.backend.index')
@push('title', 'Detail '. $halaman->nama . ' '. $aksesgrup->nama)
@push('header', 'Detail '. $halaman->nama . ' '.$aksesgrup->nama)
@push('tombol')
<a class="waves-effect waves-light btn bg-gradient-danger py-2 px-3 b-0 tambah" href="{{ url('aksesgrup') }}">
	kembali
</a>
@endpush
@section('content')
<div class="panel-container show">
	<div class="panel-content">
		<table id="datatable" class="table table-striped table-bordered display" style="width:100%">
			<thead class="bg-primary-600">
				<tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Email</th>
                </tr>
			</thead>
		</table>
	</div>
</div>
@endsection
@push('js')
@include('layouts.backend.js.datatable-js')
<script type="text/javascript" src="{{ URL::asset(config('master.aplikasi.author').'/'. $halaman->kode .'/jquery.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset(config('master.aplikasi.author').'/'. $halaman->kode .'/'.$aksesgrup->id.'/datatables_detail.js') }}"></script>
@endpush
