<?php

namespace App\Http\Middleware;

use App\Model\Aksesmenu;
use App\Model\BolehAksesSubmenu;
use App\Model\Menu;
use Closure;
use Illuminate\Http\Response;
use Route;

class aksesmenuMiddleware
{
    public function handle($request, Closure $next)
    {
        $user	= \Auth::user();
        $current=	explode(".", Route::currentRouteName());
        $menu	=	menu::where('kode', $current[0])->first();
        if($menu !== NULL){
            if($menu->tampil){
                $bolehakses = TRUE;
                if($menu->perbaikan)
                {
                    $bolehakses = BolehAksesSubmenu::whereAksesgrupId(\Auth::user()->aksesgrup_id)->whereMenuId($menu->id)->first() ?? FALSE;
                }
                if($bolehakses)
                {
                    $aksessub =  Aksesmenu::where('aksesgrup_id', $user->aksesgrup_id)->where('menu_id', $menu->id);
                    if($aksessub->first()){
                        return $next($request);
                    }else{
                        return new Response(view('layouts.backend.error.403', ['menu'=>$menu]));
                    }
                } else {
                    return new Response(view('layouts.backend.error.503', ['menu'=>$menu]));
                }
            }else{
                return $next($request);
            }
        }else{
            return new Response(view('layouts.backend.error.403'));
        }
    }
}
