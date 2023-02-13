<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Gambar;
use App\Http\Controllers\Controller;
use App\Model\File;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Storage;

class fileController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function getFile($id, $nama)
    {
        $file=File::find($id);
        if (Storage::disk($file->disk)->exists($file->target)) {
            if ($file->as_gambar) {
                return Gambar::get($file);
            }
            return response()->make($file->take,200, [
                'Content-Type' => $file->mime,
                'Content-Disposition' => 'inline; filename="'.$nama.'.pdf"',
            ]);
        }
        return view('layouts.backend.error.410', [
            'data'=>[
                'code'=>410,
                'status'=>'GONE',
                'file'=>$file->nama,
                'error'=>'File tidak ditemukan',
                'msg'=>'Maaf Kami tidak dapat menemukan file yang anda minta, silahkan hubungi pembuat file untuk keterangan lebih lanjut',
            ],
        ]);
    }

    public function download($id, $nama)
    {
        $file=File::find($id);
        if (Storage::disk($file->disk)->exists($file->target)) {
            return $file->download;
        }
        return view('layouts.backend.error.410', [
            'data'=>[
                'code'=>410,
                'status'=>'GONE',
                'file'=>$file->nama,
                'error'=>'File tidak ditemukan',
                'msg'=>'Maaf Kami tidak dapat menemukan file yang anda minta, silahkan hubungi pembuat file untuk keterangan lebih lanjut',
            ],
        ]);
    }
}
