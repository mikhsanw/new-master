<?php

namespace App\Model;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class aplikasi extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $casts=[
        'id'=>'string',
    ];
    protected $fillable=[
        'id', 'nama', 'singkatan', 'daerah'
    ];

    public function file_logo()
    {
        return $this->morphOne(File::class, 'morph')->where('name', '=', 'logo');
    }

    public function file_favicon()
    {
        return $this->morphOne(File::class, 'morph')->where('name', '=', 'favicon');
    }
}
