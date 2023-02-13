<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @if($aplikasi->file_favicon)
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset($aplikasi->file_favicon->url_stream) }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($aplikasi->file_favicon->url_stream) }}">
    @endif
    <meta name="description" content="{!! ucwords(strtolower(($aplikasi->nama??'').' '.($aplikasi->daerah??''))) !!}">
    <title>@stack('title','Home') | {{$aplikasi->singkatan??''}}</title>
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <meta name="author" content="{!! config('master.aplikasi.author') !!}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/css/vendors.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/css/app.bundle.css') }}">
    <link rel="mask-icon" href="{{ asset('backend/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="{{ asset('resources/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{asset('backend/css/all.css')}}"/>
    <link rel="stylesheet" media="screen, print" href="{{ asset('resources/css/sweetalert2/sweetalert2.bundle.css') }}">
    @if (config('master.aplikasi.tema') != NULL)
        <link id="mytheme" rel="stylesheet" media="screen, print" href="{{asset('backend/css/themes/cust-theme-'.config('master.aplikasi.tema').'.css')}}">
    @endif
    <link id="myskin" rel="stylesheet" media="screen, print" href="{{asset('backend/css/skin/skin-master.css')}}">
    @stack('css')
{{--    <script>--}}
{{--        window.OneSignal = window.OneSignal || [];--}}
{{--        OneSignal.push(function () {--}}
{{--            OneSignal.init({--}}
{{--                autoResubscribe: true,--}}
{{--                allowLocalhostAsSecureOrigin: true,--}}
{{--                appId: "{!! env('ONESIGNAL_APP_ID') !!}",--}}
{{--                notifyButton: {--}}
{{--                    enable: true,--}}
{{--                },--}}
{{--            });--}}
{{--            OneSignal.getUserId().then(function (userId) {--}}
{{--                if (userId != null) {--}}
{{--                    $.post('provider/onesignal', {--}}
{{--                        '_token': "{{csrf_token()}}",--}}
{{--                        'pegawai_id': "{{$user->pegawai_id}}",--}}
{{--                        'token': userId,--}}
{{--                    })--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
</head>
<body class="mod-bg-1 nav-function-fixed mod-nav-dark mod-nav-link">
<script>
    'use strict';
    let classHolder = document.getElementsByTagName("BODY")[0],
        themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) : {},
        themeURL = themeSettings.themeURL || '',
        themeOptions = themeSettings.themeOptions || '';

    if (themeSettings.themeOptions) {
        classHolder.className = themeSettings.themeOptions;
    }
    if (themeSettings.themeURL && !document.getElementById('mytheme')) {
        let cssfile = document.createElement('link');
        cssfile.id = 'mytheme';
        cssfile.rel = 'stylesheet';
        cssfile.href = themeURL;
        document.getElementsByTagName('head')[0].appendChild(cssfile);

    } else if (themeSettings.themeURL && document.getElementById('mytheme')) {
        document.getElementById('mytheme').href = themeSettings.themeURL;
    }

    let saveSettings = function () {
        themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function (item) {
            return /^(nav|header|footer|mod|display)-/i.test(item);
        }).join(' ');
        if (document.getElementById('mytheme')) {
            themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
        }
        localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
    };

    let resetSettings = function () {
        localStorage.setItem("themeSettings", "");
    };
</script>
<div class="page-wrapper">
    <div class="page-inner">
        @include('backend.home.sidebar')
        <div class="page-content-wrapper">
            @include('backend.home.header')
            <main id="js-page-content" role="main" class="page-content">
                <ol class="breadcrumb page-breadcrumb">
                    <li class="position-absolute pos-top pos-right d-none d-sm-block">
                        {{ $fungsi->getHari() }}, {{ $fungsi->tanggalIndonesia() }}
                    </li>
                </ol>
                @if(is_null($halaman))
                    @yield('content')
                @else
                    @if ($halaman->detail)
                        @include('backend.home.sidebar_item.informasi',['judul'=>($halaman->detail['title'] ?? ''),'keterangan'=>($halaman->detail['keterangan'] ?? ''),'status_pengumuman'=>($halaman->detail['status_pengumuman'] ?? '')])
                    @endif
                    <div class="row">
                        <div class="col-xl-12">
                            <div id="panel-1" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        <span class="fa {!! $halaman->icon ?? 'fa-home' !!}"></span> &nbsp;
                                        @stack('header')
                                    </h2>
                                    @stack('panel')
                                    <div class="panel-toolbar">
                                        <div class="btn-group">
                                            @stack('tombol')
                                        </div>
                                    </div>
                                </div>
                                @yield('content')
                            </div>
                        </div>
                    </div>
                @endif
            </main>
            <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
            @include('backend.home.footer')
        </div>
    </div>
    @include('backend.home.sidebar_item.setting')
</div>
<script src="{{ asset('backend/js/vendors.bundle.js') }}"></script>
<script src="{{ asset('backend/js/app.bundle.js') }}"></script>
<script src="{{ asset('resources/vendor/jquery/blockUI.js') }}"></script>
<script src="{{ asset('resources/vendor/jquery/jquery.loadmodal.js') }}"></script>
<script src="{{ asset(config('master.aplikasi.author').'/home/jquery.js') }}"></script>
<script src="{{ asset('resources/vendor/sweetalert2/sweetalert2.bundle.js') }}"></script>
{{--<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>--}}
@stack('js')
</body>
</html>
