@extends('layouts.backend.index')
@push('header', ($menu->nama ?? 'Tidak ada akses'))
@section('content')
<div class="h-alt-hf d-flex flex-column align-items-center justify-content-center text-center">
    <h1 class="page-error color-fusion-500">
        <span class="text-gradient"> <Em>ERROR 403</Em> </span>
    </h1>
    <h3 class="fw-500 mb-5">
        Mohon maaf, anda tidak ada akses untuk mengunjungi halaman ini.
    </h3>
    <div class="my-30"><a href="{{url('/home')}}" class="btn btn-danger">Back to dashboard</a></div>				  

</div>
@endsection
