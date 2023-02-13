<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="{!! ucwords(strtolower(config('master.aplikasi.nama').' '.config('master.aplikasi.daerah'))) !!}">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <meta name="author" content="{!! config('master.aplikasi.author') !!}">
    <title>@stack('title',$data['status'] ?? 'Error') | {!! config('master.aplikasi.singkatan') !!}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset(config('master.aplikasi.favicon')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(config('master.aplikasi.favicon')) }}">
    <link rel="mask-icon" href="{{ asset('backend/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/css/vendors.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('backend/css/app.bundle.css') }}">
</head>
<body class="mod-bg-1 mod-nav-link nav-mobile-push desktop chrome webkit pace-done blur">
<div class="page-wrapper alt">
    <main id="js-page-content" role="main" class="page-content">
        <div class="h-alt-f d-flex flex-column align-items-center justify-content-center text-center">
            <h1 class="page-error color-fusion-500">
                <span class="text-gradient">{!! $data['code'] ?? '410' !!}</span>
                <small class="fw-500">
                    <small class="form-control">
                        {!! $data['file'] ?? '' !!}
                    </small>
                </small>
            </h1>
            <h3 class="fw-500 mb-5">
                {!! $data['error'] ?? 'Mohon maaf, file tidak ditemukan.' !!}
            </h3>
            <h4>
                {!! $data['msg'] ?? '' !!}
                    </h4>
        </div>
    </main>
</div>
</body>
</html>

