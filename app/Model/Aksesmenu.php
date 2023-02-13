<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aksesmenu extends Model
{
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

    public function getAksesMenu($id,$parent_id=null)
    {
        $data = $this->join('menus','menus.id','aksesmenus.menu_id')->where('aksesgrup_id', $id);
        if (is_null($parent_id)) {
            $data->whereNull('parent_id');
        }else{
            $data->whereNotNull('parent_id')->where('menus.parent_id', $parent_id);
        }
        return $data->select('aksesmenus.*')->latest('aksesmenus.created_at');
    }
}
