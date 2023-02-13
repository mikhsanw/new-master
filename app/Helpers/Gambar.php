<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
class Gambar
{
    public static function generate($model)
    {
        try {
            $img = Image::make(Storage::disk($model->disk)->get($model->target));
            $img->backup();
            foreach ($model->fileable->ukuran as $ukuran) {
                if(config('master.ukuran.'.$ukuran.'.width') == NULL)
                {
                    $img->resize(null, config('master.ukuran.'.$ukuran.'.height'), function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } elseif (config('master.ukuran.'.$ukuran.'.height') == NULL)
                {
                    $img->resize(config('master.ukuran.'.$ukuran.'.width'), null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } else {
                    $img->resize(config('master.ukuran.'.$ukuran.'.width'),config('master.ukuran.'.$ukuran.'.height'));
                }
                Storage::makeDirectory($model->fileable->folder);
                Storage::put($model->fileable->folder . '/' . $ukuran . '-'. $model->nama, $img->encode('jpg'));
                $img->reset();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public static function hapus($model)
    {
        try {
            if(Storage::disk($model->disk)->exists($model->target))
            {
                Storage::disk($model->disk)->delete($model->target);
                foreach ($model->fileable->ukuran as $ukuran) {
                    Storage::disk($model->disk)->delete($model->path . '/'. $ukuran.'-'.$model->nama);
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public static function get($model, $ukuran = NULL)
    {
        try {
            if(Storage::disk($model->disk)->exists($model->target))
            {
                if($ukuran != NULL && in_array($ukuran, $model->ukuran))
                {
                    return Image::make(Storage::disk($model->disk)->get($model->path . '/'. $ukuran.'-'.$model->nama))->response();
                } else {
                    return Image::make(Storage::disk($model->disk)->get($model->target))->response();
                }
            } else {
                return Image::make(public_path('images/no-photo.png'))->response();
            }
        } catch (\Throwable $th) {
            return Image::make(public_path('images/no-photo.png'))->response();
        }
    }

}
