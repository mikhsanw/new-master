<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BolehAksesSubmenu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'menu_id', 'aksesgrup_id'
    ];

	public function menu()
	{
        return $this->belongsTo('App\Model\Menu');
	}

	public function aksesgrup()
	{
        return $this->belongsTo('App\Model\Aksesgrup');
	}
}
