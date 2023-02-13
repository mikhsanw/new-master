<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuid
{
    /*
    |----------------------------------------------------------------------------------------------
    | perlu definisikan alias jika di model ada method "boot" juga, contoh alias didalam class:
    |----------------------------------------------------------------------------------------------
    |   class Nama extends Model
    |   {
    |       use SoftDeletes;
    |       use Uuid {
    |           boot as uuidBoot;
    |       }
    |   }
    |----------------------------------------------------------------------------------------------
    | dan panggil dalam boot model, contoh pemanggilan :
    |----------------------------------------------------------------------------------------------
    |   public static function boot()
    |   {
    |       parent::boot();
    |       static::uuidBoot();
    |   }
    |----------------------------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            try {
                $model->id = $model->id == '' ? (string) Str::orderedUuid():$model->id;
            } catch (UnsatisfiedDependencyException $e) {
                abort(500, $e->getMessage());
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
