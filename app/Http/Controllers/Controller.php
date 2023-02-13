<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\Help;
use App\Model\aplikasi;
use App\Model\Kontak;
use View;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $model,$kode;

    public function __construct()
    {
        $this->kode = Help::menu()['kode'] ?? null;
        $this->model = Help::menu()['model'] ?? null;

        View::share([
            'aplikasi'      => aplikasi::first(),
            'kontak'      => new Kontak,
            'menu' => [
                'beranda'        => url('/'),
            ],
        ]);
    }
}
