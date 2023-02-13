@extends('auth.index')
@section('content')
    <div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded30 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary">{{ config('master.aplikasi.nama') }}</h2>
								<p class="mb-0">Silahkan login untuk melanjutkan</p>							
							</div>
							<div class="p-40">
								<form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
											</div>
											<input type="text" class="form-control pl-15 bg-transparent @error('username') is-invalid @enderror" placeholder="Username" id="username" name="username" value="{{config('master.tes_login.uname')}}" required autocomplete="username" autofocus>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
											</div>
											<input type="password" class="form-control pl-15 bg-transparent @error('password') is-invalid @enderror" value="{{config('master.tes_login.pwd')}}" placeholder="Password" id="password" name="password" required autocomplete="current-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
									</div>
									  <div class="row">
										<div class="col-6">
										  <div class="checkbox">
											<input type="checkbox" class="custom-control-input" name="remember" id="basic_checkbox_1" {{ old('remember') ? 'checked' : '' }}>
											<label for="basic_checkbox_1" for="remember">{{ __('Ingatkan Saya') }}</label>
										  </div>
										</div>
										<!-- /.col -->
										<!-- <div class="col-6">
										 <div class="fog-pwd text-right">
											<a href="javascript:void(0)" class="hover-warning"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
										  </div>
										</div> -->
										<!-- /.col -->
										<div class="col-12 text-center">
										  <button type="button" class="btn btn-primary mt-10 goLogin">{{ __('Login') }}</button>
                                          <div class="mt-3 text-center">
                                                <span class='pesan'></span>
                                            </div>
										</div>
										<!-- /.col -->
									  </div>
								</form>	
								<!-- <div class="text-center">
									<p class="mt-15 mb-0">Don't have an account? <a href="auth_register.html" class="text-warning ml-5">Sign Up</a></p>
								</div>	 -->
							</div>						
						</div>
						<!-- <div class="text-center">
						  <p class="mt-20 text-white">- Sign With -</p>
						  <p class="gap-items-2 mb-20">
							  <a class="btn btn-social-icon btn-round btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
							  <a class="btn btn-social-icon btn-round btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
							  <a class="btn btn-social-icon btn-round btn-instagram" href="#"><i class="fa fa-instagram"></i></a>
							</p>	
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
@include('auth.footer')
@endsection
@push('js')
<script src="{{ asset('ojisatriani/noauth/login/ajax.js') }}"></script>
<script src="{{ asset('backend/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js')}}"></script>
@endpush
