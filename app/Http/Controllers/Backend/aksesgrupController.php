<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Aksesgrup;
use App\Model\User;
use Illuminate\Http\Request;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class aksesgrupController extends Controller
{
    public function index()
    {
        return view('backend.aksesgrup.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $aksesgrup = Aksesgrup::byLevel();
            return Datatables::of($aksesgrup)
            ->addIndexColumn()
            ->editColumn('nama', function($aksesgrup){
                return '<a href="'.url('aksesgrup/'.$aksesgrup->id).'" class="text-info">'.$aksesgrup->nama.'</a>';
            })
             ->addColumn(
                 'action', '<div style="text-align: center;">
                               <a class="edit ubah" data-toggle="tooltip" data-placement="top" title="Edit" aksesgrup-id="{{ $id }}" href="#edit-{{ $id }}">
                                   <i class="fa fa-edit text-warning"></i>
                               </a>&nbsp; &nbsp;
                               <a class="delete hidden-xs hidden-sm hapus" data-toggle="tooltip" data-placement="top" title="Delete" aksesgrup-id="{{ $id }}" href="#hapus-{{ $id }}" >
                                   <i class="fa fa-trash text-danger"></i>
                               </a>
                           </div>'
                        )
              ->addColumn('aksesmenu', '<div style="text-align: center;"><a href="{{ url(config("master.url.admin")."/aksesmenu/".$id)  }}" class="ubah" data-toggle="tooltip" data-placement="top" title="Akses Menu"><i class="fa fa-share text-info"></i></a>')
              ->rawColumns(['action', 'aksesmenu', 'nama'])->make(true);
        } else {
            exit("Not an AJAX request -_-");
        }
    }

    public function data_detail(Request $request, $id)
    {
        if ($request->ajax()) {
            $users = User::where('aksesgrup_id',$id);
            return Datatables::of($users)
            ->addIndexColumn()->make(true);
        } else {
            exit("Not an AJAX request -_-");
        }
    }

    public function create()
    {
        return view('backend.aksesgrup.tambah');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'		=> 'required',
            'alias'		=> 'required',
          ]);
        if ($validator->fails()) {
            $respon = array('status'=>false, 'pesan' => $validator->messages());
        } else {
            if (Aksesgrup::create($request->all())) {
                $respon = array('status'=>true, 'pesan' => ['msg' => 'Data berhasil disimpan']);
            } else {
                $respon = array('status'=>false, 'pesan' => ['msg' => 'Data gagal disimpan']);
            }
        }
        return response()->json($respon);
    }

    public function show($id)
    {
        if($aksesgrup = Aksesgrup::find($id)) {
            return view('backend.aksesgrup.detail', compact('aksesgrup'));
        }else{
            return new Response(view('errors.404'));
        }
    }

    public function edit($id)
    {
        if($aksesgrup = Aksesgrup::find($id)) {
            return view('backend.aksesgrup.ubah', compact('aksesgrup'));
        }else{
            return new Response(view('errors.404'));
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama'		=> 'required',
            'alias'		=> 'required',
          ]);
        if ($validator->fails()) {
            $respon = array('status'=>false, 'pesan' => $validator->messages());
        } else {
            if (Aksesgrup::find($id)->update($request->all())) {
                $respon = array('status'=>true, 'pesan' => ['msg' => 'Data berhasil diubah']);
            } else {
                $respon = array('status'=>false, 'pesan' => ['msg' => 'Data gagal diubah']);
            }
        }
        return response()->json($respon);
    }

    public function hapus($id)
    {
        if($aksesgrup = Aksesgrup::find($id)) {
            return view('backend.aksesgrup.hapus', compact('aksesgrup'));
        }else{
            return new Response(view('errors.404'));
        }
    }

    public function destroy($id)
    {
        $aksesgrup = Aksesgrup::find($id);
        if ($aksesgrup->delete()) {
            $respon = array('status'=>true, 'pesan' => ['msg' => 'Data berhasil dihapus']);
        } else {
            $respon = array('status'=>false, 'pesan' => ['msg' => 'Data gagal dihapus']);
        }
        return response()->json($respon);
    }
}
