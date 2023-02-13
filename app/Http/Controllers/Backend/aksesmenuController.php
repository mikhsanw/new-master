<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Aksesgrup;
use App\Model\Aksesmenu;
use App\Model\Menu;
use Illuminate\Http\Request;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class aksesmenuController extends Controller
{
    public function index()
    {
        //
    }

    public function data(Request $request, $id)
    {
        if ($request->ajax()) {
            $aksesmenu=(new Aksesmenu)->getAksesMenu($id, NULL);
            return Datatables::of($aksesmenu)->addColumn('nama', function ($aksesmenu) {
                    return $aksesmenu->menu->nama;
                })->addColumn('submenu', function ($aksesmenu) use ($id) {
                    return $aksesmenu->getAksesMenu($id, $aksesmenu->menu_id)->get()->pluck('menu.nama')->toArray();
                })->rawColumns(['submenu', 'nama'])->make(TRUE);
        }
        else {
            exit("Not an AJAX request -_-");
        }
    }

    public function create($id)
    {
        $menu=Menu::whereNull('parent_id')->get();
        if ($aksesgrup=Aksesgrup::find($id)) {
            return view('backend.aksesmenu.tambah', compact('menu', 'aksesgrup'));
        }
        else {
            return abort(404);
        }
    }

    public function store(Request $request)
    {
        if ($request->has('menu')) {
            Aksesmenu::where('aksesgrup_id', $request->input('id'))->forceDelete();
            foreach ($request->input('menu') as $value) {
                try {
                    if (Aksesmenu::updateOrCreate(['menu_id'=>$value, 'aksesgrup_id'=>$request->input('id')], ['aksesgrup_id'=>$request->input('id'), 'menu_id'=>$value])) {
                        $response=["status"=>TRUE, "pesan"=>['msg'=>' menu & submenu tersimpan']];
                    }
                } catch (\Exception $e) {
                    $response=["status"=>FALSE, "pesan"=>['msg'=>'Pesan kesalahan : <br>'.$e->getMessage()]];
                }
            }
            return json_encode($response);
        }
        else {
            return json_encode(["status"=>FALSE, "pesan"=>['msg'=>'Gagal menyimpan akses menu, harap pilih salah satu.']]);
        }
    }

    public function show($id)
    {
        if ($aksesgrup=Aksesgrup::find($id)) {
            return view('backend.aksesmenu.index', compact('aksesgrup'));
        }
        else {
            return abort(404);
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
