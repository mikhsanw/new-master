@extends('auth.index')
@section('content')
    @php($bg = array('bg-e-office-1','bg-e-office-2'))
    <div class="page-wrapper">
        <div class="page-inner bg-brand-gradient">
            <div class="page-content-wrapper bg-transparent m-0">
                {{--                            <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">--}}
                {{--                                <div class="d-flex align-items-center container p-0">--}}
                {{--                                    @include('auth.logo')--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                <div class="flex-1" style="background: url({{ asset('backend/img/logo/'.$bg[array_rand($bg)].'.jpg') }}) no-repeat center bottom fixed; background-size: cover;">
                    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                        <div class="row ">
                            <div class="col col-md-6 col-lg-7 hidden-sm-down text-center">
                                {{--  <h2 class="fs-xxl fw-500 mt-4 text-dark text-center">
                                     <img  src="{{ asset('backend/img/logo/logogram-putih-200.png') }}" style="filter: drop-shadow(2px 4px 6px black);" alt="">
                                 </h2> --}}
                                {{--   <small class="h3 fw-300 mt-3 mb-5 text-center opacity-60">
                                      <iframe width="400" height="220" src="https://www.youtube.com/embed/njscDhEY_3o" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                  </small> --}}
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
                                <h1 class="text-dark fw-300 mb-3 d-sm-block  text-center mb-5">
                                    <img style="border-image: inherit; width: 40%;" src="{{ asset('backend/img/logo/e-office-text.png') }}" alt="">
                                </h1>
                                <div class="card p-4 rounded-plus text-dark" style="background-color: #ffffff21 !important;">
                                    {{--   <div class="text-center">
                                          <img style="width: 30%;" class=" text-center" src="{{ asset('backend/img/logo/logo-e-office-putih.png') }}" alt="{{ config('master.aplikasi.nama') }}" aria-roledescription="logo">
                                      </div> --}}
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" name="username" id="username"
                                                   class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                   placeholder="Username" value="{{config('master.tes_login.uname')}}" required>
                                            <div class="help-block text-dark">Masukkan username anda</div>
                                            @error('username')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password"
                                                   class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                   placeholder="Password" value="{{config('master.tes_login.pwd')}}" required>
                                            <div class="help-block text-dark">Masukkan password anda</div>
                                            @error('password')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group text-left">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="remember"></label>{{ __('Ingatkan Saya') }}
                                                <span class=" pull-right "><a href="{{ url('password/reset') }}">LupaPassword?</a></span>
                                            </div>
                                        </div>
                                        <div class="row no-gutters">
                                            <div class="col-lg-12 pl-lg-1 my-2">
                                                <button type="button" class="btn btn-danger btn-block goLogin">
                                                    <span class="fa fa-sign-in"></span><span class="loading fa fa-spinner fa-spin-2x" style="display: none"></span> &nbsp; {{ __('Login') }}
                                                </button>
                                                <br><br>
                                                <div class="margin-top-30 text-center">
                                                    <span class='pesan'></span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div style="text-align: center;">
                                        <a href="{{url('https://riau.go.id')}}" target="_blank">
                                            <img style="width: 20px" src="{{ asset('backend/img/logo/pemprov.png') }}" alt="">
                                        </a>
                                        <a href="{{url('http://asn.riau.go.id/')}}" target="_blank">
                                            <img style="width: 30px" src="{{ asset('backend/img/logo/smartasn.png') }}" alt="">
                                        </a>
                                        <a href="{{url('https://anjab.riau.go.id/')}}" target="_blank">
                                            <img style="width: 30px" src="{{ asset('backend/img/logo/anjab.png') }}" alt="">
                                        </a>
                                        <a href="{{url('https://bsre.bssn.go.id/')}}" target="_blank">
                                            <img style="width: 30px" src="{{ asset('backend/img/logo/bsre.png') }}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('auth.footer')
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('ojisatriani/noauth/login/ajax.js') }}"></script>
@endpush
