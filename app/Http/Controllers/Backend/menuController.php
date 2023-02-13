<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Help;
use App\Http\Controllers\Controller;
use App\Model\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class menuController extends Controller
{
    public function index()
    {
        return view('backend.menu.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $menu=Menu::with(['children'])->whereNull('parent_id')->sort()->get();
            return view('backend.menu.list-menu.list-menu', compact('menu'));
        }
        else {
            exit("Not an AJAX request -_-");
        }
    }

    public function create()
    {
        $data=[
          'model'=>Help::listFile(app_path('/Model'),['php'])
        ];
        return view('backend.'.$this->kode.'.tambah', $data);
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'nama'=>'required',
                'kode'=>'required|unique:menus',
                'link'=>'required|unique:menus',
                'icon'=>'required',
                'status'=>'required',
                'tampil'=>'required',
                'title'=>'nullable',
                'keterangan'=>'nullable'
                ]);
        if ($validator->fails()) {
            $respon=['status'=>false, 'pesan'=>$validator->messages()];
        }
        else {
            $request->request->add([
                'detail'=>[
                    'model'=>$request->model ?? '',
                    'title'=>$request->title ?? '',
                    'keterangan'=>$request->keterangan ?? '',
                    'status_pengumuman'=>$request->status_pengumuman,
                ]
            ]);
            if (Menu::create($request->all())) {
                $respon=['status'=>true, 'pesan'=>['msg'=>'Data berhasil disimpan']];
            }
            else {
                $respon=['status'=>false, 'pesan'=>['msg'=>'Data gagal disimpan']];
            }
        }
        return response()->json($respon);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        if (Menu::find($id)) {
            $data=[
                'model'=>Help::listFile(app_path('/Model'), ['php']), 'menu'=>Menu::find($id),
            ];
            return view('backend.'.$this->kode.'.ubah', $data);
        }else{
            return abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator=Validator::make($request->all(),
            [
                'nama'=>'required',
                'kode'=>'required|unique:menus,kode,'.$id,
                'link'=>'required|unique:menus,kode,'.$id,
                'status'=>'required',
                'icon'=>'required',
                'tampil'=>'required',
                'title'=>'nullable',
                'keterangan'=>'nullable'
                ]);
        if ($validator->fails()) {
            $respon=['status'=>false, 'pesan'=>$validator->messages()];
        }
        else {
            $request->request->add([
                'detail'=>[
                    'model'=>$request->model ?? '',
                    'title'=>$request->title,
                    'keterangan'=>$request->keterangan,
                    'status_pengumuman'=>$request->status_pengumuman,
                ]
            ]);
            if (Menu::find($id)->update($request->all())) {
                $respon=['status'=>true, 'pesan'=>['msg'=>'Data berhasil diubah']];
            }
            else {
                $respon=['status'=>false, 'pesan'=>['msg'=>'Data gagal diubah']];
            }
        }
        return response()->json($respon);
    }

    public function hapus($id)
    {
        if($menu=Menu::find($id)) {
            return view('backend.menu.hapus', ['menu'=>$menu]);
        }else{
            return abort(404);
        }
    }

    public function destroy($id)
    {
        $menu=Menu::find($id);
        if ($menu->delete()) {
            $respon=['status'=>true, 'pesan'=>['msg'=>'Data berhasil dihapus']];
        }
        else {
            $respon=['status'=>false, 'pesan'=>['msg'=>'Data gagal dihapus']];
        }
        return response()->json($respon);
    }

    public function susunMenu(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->loopUpdateMenu(json_decode($request->input('urutkan')));
        }
        return back();
    }

    function loopUpdateMenu($menu, $parent=null)
    {
        if ($menu) {
            foreach ($menu as $key=> $dt) {
                if (Menu::find($dt->id)->update(['parent_id'=>$parent, 'urut'=>$key + 1])) {
                    if (isset($dt->children)) {
                        $this->loopUpdateMenu($dt->children, $dt->id);
                    }
                }
            }
        }
    }

    public function extract()
    {

        $data = $this->model::orderBy('parent_id','asc')->orderBy('urut','asc')->get();
        foreach ($data as $menu) {
            $array[]=[
                'id'=>$menu->id,
                'parent_id'=>$menu->parent_id ?? NULL,
                'kode'=>$menu->kode,
                'nama'=>$menu->nama,
                'link'=>$menu->link,
                'icon'=>$menu->icon,
                'tampil'=>$menu->tampil,
                'urut'=>$menu->urut,
                'status'=>$menu->status,
                'detail'=>$menu->detail ? ["model"=>$menu->detail['model'] ?? NULL, "title"=>$menu->detail['title'] ?? NULL, "keterangan"=>$menu->detail['keterangan'] ?? NULL] : NULL
            ];
        }
        $row =[
          'menu'=>$array,
          'akses_root'=>$this->model::pluck('kode')->toArray(),
        ];
        return response()->json($row);
    }
}
