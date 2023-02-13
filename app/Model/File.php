<?php

namespace App\Model;

use App\Helpers\Help;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory, SoftDeletes;
    use uuid {
        boot as uuidBoot;
    }

    protected $dates=['deleted_at'];

    protected $casts=[
        'id'=>'string', 'data'=>'array',
    ];

    protected $fillable=[
        'data', 'name'
    ];

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getTargetAttribute()
    {
        return $this->data['target'] ?? NULL;
    }

    public function getDiskAttribute()
    {
        return $this->data['disk'] ?? 'local';
    }

    public function getNamaAttribute()
    {
        return Arr::last(Str::of($this->target)->explode('/')->toArray());
    }

    public function getPathAttribute()
    {
        return Str::of($this->target)->explode('/')->slice(0, -1)->implode('/');
    }

    public function getUrlAttribute()
    {
        return asset('file/'.$this->nama_alias);
    }

    public function getUrlStreamAttribute()
    {
        return asset('file/'.$this->id.'/Document '.config('master.aplikasi.nama')).' '.date('Y-m-d');
    }

    public function getUrlDownloadAttribute()
    {
        return asset('download/'.$this->id.'/Document '.config('master.aplikasi.nama')).' '.date('Y-m-d');
    }

    public function getNamaAliasAttribute()
    {
        return $this->id.'/'.Str::slug(preg_replace('/\\.[^.\\s]{3,4}$/', '', $this->nama)).'.'.Arr::last(Str::of($this->target)->explode('.')->toArray());
    }

    public function getDownloadAttribute()
    {
        return Storage::disk($this->disk)->download($this->target);
    }

    public function getTakeAttribute()
    {
        return Storage::disk($this->disk)->get($this->target);
    }

    public function getTypeAttribute()
    {
        $get_type=Storage::disk($this->disk)->mimeType($this->target);
        $extension=['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
        if (in_array($get_type, $extension)) {
            $type="gambar";
        }
        else {
            $type="file";
        }
        return $type;
    }

    public function getExtensionAttribute()
    {
        return Arr::last(Str::of($this->target)->explode('.')->toArray());
    }

    public function getAsGambarAttribute()
    {
        return $this->type == "gambar" ? TRUE : FALSE;
    }

    public function getSizeAttribute()
    {
        return Help::formatSizeUnits(Storage::disk($this->disk)->size($this->target));
    }

    public static function boot()
    {
        parent::boot();
        static::uuidBoot();
    }
}
