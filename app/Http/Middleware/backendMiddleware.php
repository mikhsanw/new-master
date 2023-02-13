<?php

namespace App\Http\Middleware;

use App\Model\Menu;
use App\Model\aplikasi;
use Closure;
use Illuminate\Support\Facades\Auth;
use OjiSatriani\Fungsi;
use View;

class backendMiddleware
{
    protected $fungsi;
    protected $tanggal;

    public function handle($request, Closure $next)
    {
        $menus              = Menu::whereStatus(true)->whereNull('parent_id')->orderBy('urut','asc')->get();
        $aplikasi           = aplikasi::first();
        $current	        = explode(".", \Route::currentRouteName());
        $submenu            = Menu::whereKode($current[0])->latest()->first();
        $halaman            = $submenu === null ? null:$submenu;
        $this->fungsi       = new Fungsi;
        $this->tanggal      = Fungsi::setTanggal();
        View::share([
            'user'          => Auth::user(),
            'menu_item'     => $menus,
            'menus'     => $menus,
            'aplikasi'      => $aplikasi,
            'fungsi'        => $this->fungsi,
            'tanggal'       => $this->tanggal,
            'halaman'       => $halaman,
            'url_admin'     => config('master.url.admin'),
        ]);
        return $next($request);
    }
}
