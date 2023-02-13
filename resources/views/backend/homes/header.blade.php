<header class="page-header" role="banner">
    <!-- we need this logo when user switches to nav-function-top -->
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
            @if($aplikasi->file_favicon)
                <img src="{{ asset($aplikasi->file_favicon->url_stream) }}" alt="{{ $aplikasi->nama ?? '' }}" aria-roledescription="logo">
                <span class="page-logo-text mr-1">{{ $aplikasi->nama ?? ''}}</span>
            @endif
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- DOC: nav menu layout change shortcut -->
    <div class="hidden-md-down dropdown-icon-menu position-relative">
        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
            <i class="ni ni-menu"></i>
        </a>
        <ul>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                    <i class="ni ni-minify-nav"></i>
                </a>
            </li>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                    <i class="ni ni-lock-nav"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- DOC: mobile button appears during mobile width -->
    <div class="hidden-lg-up">
        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
            <i class="ni ni-menu"></i>
        </a>
    </div>
    <div class="ml-auto d-flex">
        <div class="hidden-md-down">
            <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
                <i class="fal fa-cog"></i>
            </a>
        </div>
        <!-- app user menu -->
        <div>
            <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com" class="header-icon d-flex align-items-center justify-content-center ml-2">
                <img src="{{ Avatar::create($user->nama)->toBase64() }}" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                        <span class="mr-2 d-table-cell align-middle status status-success status-sm">
                            <img src="{{ Avatar::create($user->nama)->toBase64() }}" class="rounded-circle profile-image shadow" alt="{!! $user->nama !!}">
                        </span>
                        <div class="info-card-text">
                            <div class="fs-lg text-truncate text-truncate-lg">{{ strtoupper(strtolower($user->nama)) }}</div>
                            <span class="text-truncate text-truncate-md opacity-80"> {!! ucwords(strtolower(config('master.level.'.$user->level))) !!}</span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider m-0 font-weight-bold"></div>
                <a href="{{url('user/ubahpassword/'.$user->id)}}" class="dropdown-item">Ubah Password</a>
                <a href="#keluar" class="dropdown-item fw-500 pt-3 pb-3 keluar" onclick="e.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
            </div>
        </div>
    </div>
</header>
