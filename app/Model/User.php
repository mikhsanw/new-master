<?php

namespace App\Model;

use App\Traits\Uuid;
use Carbon\Carbon;
use Carbon\Traits\Cast;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes,Cast;
    use uuid {
        boot as uuidBoot;
    }

    protected $dates=['deleted_at'];
    protected $fillable=[
        'id','username','nama','email', 'password', 'email_verified_at', 'level', 'aksesgrup_id','remember_token'
    ];
    protected $hidden=[
        'password', 'remember_token',
    ];
    protected $casts=[
        'email_verified_at'=>'datetime',
        'id'=>'string',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id=\Ramsey\Uuid\Uuid::uuid4()->toString();
            $model->email_verified_at=Carbon::now();
        });
    }

    public function setPasswordAttribute($value)
    {
        if ($value != "") {
            $this->attributes['password']=bcrypt(trim($value));
        }
    }

    public function scopeByLevel($query)
    {
        if (Auth::user()->level == 1) {
            return $query->latest();
        }
        else {
            return $query->where('aksesgrup_id', '!=', 1)->latest();
        }
    }

    public function aksesgrup()
    {
        return $this->belongsTo('App\Model\Aksesgrup');
    }

    public function berita()
    {
        return $this->hasMany('App\Model\Berita');
    }

    public function getUnorIdAttribute()
    {
        return $this->penempatan()->whereDefinitif(TRUE)->first()->unor_id ?? ($this->penempatan()->first()->unor_id ?? null);
    }
}
