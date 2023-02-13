@extends('layouts.backend.index')
@push('header', ($menu->nama ?? 'ERROR'))
@section('content')
<section class="error-page h-p100">
    <div class="container h-p100">
        <div class="row h-p100 align-items-center justify-content-center text-center">
            <div class="col-lg-7 col-md-10 col-12">
                <div class="rounded30 p-50">
                    <img src="{{url('images/auth-bg/404.jpg')}}" class="max-w-200" alt="" />
                    <h1>{{ ($menu->nama ?? 'ERROR') }} !</h1>
                    <h3>Mohon maaf, Halaman tidak ditemukan.</h3>
                    <div class="my-30"><a href="{{url('/home')}}" class="btn btn-danger">Back to dashboard</a></div>				  
                </div>
            </div>				
        </div>
    </div>
</section>
@endsection
