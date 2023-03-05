<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Help;
use App\Http\Controllers\Controller;
use App\Model\Aksesgrup;
use App\Model\Loginlog;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class userController extends Controller
{
    public function masuk(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'username'=>'required', 'password'=>'required',
        ]);
        if ($validator->fails()) {
            $response=['status'=>FALSE, 'pesan'=>$validator->messages()];
        }
        else {
            $userdata=['username'=>$request->input('username'), 'password'=>base64_decode($request->input('password'))];
            if (Auth::attempt($userdata, $request->remember)) {
                if ($user=User::whereUsername($request->input('username'))->first()) {
                    $user->update(['remember_token'=>$request->_token]);
                    Loginlog::create(['username'=>$request->input('username'), 'ip'=>(new Help)->alamatIp()]);
                    $response=['status'=>TRUE, 'pesan'=>['msg'=>'Berhasil login']];
                }
            }
            else {
                $response=["status"=>FALSE, "pesan"=>['msg'=>'Gagal Login, Username atau Password salah!!']];
            }
        }
        return response()->json($response);
    }

    public function index()
    {
        return view('backend.user.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $user=User::byLevel();
            return Datatables::of($user)->addIndexColumn()
                ->addColumn('action', function ($data){
                    return '<div class="text-center text-nowrap">
                               <a class="edit ubah pr-2" data-toggle="tooltip" data-placement="top" title="Edit" '.$this->kode.'-id="'.$data->id.'" href="#edit-'.$data->id.'">
                                   <i class="fa fa-edit text-warning"></i>
                               </a>
                               <a class="delete hidden-xs hidden-sm hapus" data-toggle="tooltip" data-placement="top" title="Delete" href="#hapus-'.$data->id.'" '.$this->kode.'-id="'.$data->id.'">
                                   <i class="fa fa-trash text-danger"></i>
                               </a>
                           </div>';
                })
                ->editColumn('status', function ($user) {
                    $status=$user->status == 1 ? '<span class="badge badge-pill badge-info">Aktif</span>' : '<span class="badge badge-pill badge-danger">Tidak Aktif</span>';
                    return '<div class="text-center">'.$status.'</div>';
                })->editColumn('aksesgrup', function ($user) {
                    $aksesgrup=$user->aksesgrup === NULL ? '-' : $user->aksesgrup->nama;
                    return '<div class="text-center">'.$aksesgrup.'</div>';
                })->addColumn('level', function ($user) {
                    return '<div class="text-center"><span class="badge badge-pill '.config('template.badge_option.'.$user->level).'">'.config("master.level.".$user->level).'</span></div>';
                })->rawColumns(['status', 'level', 'action', 'aksesgrup'])->make(TRUE);
        }
        else {
            exit("Not an AJAX request -_-");
        }
    }

    public function create()
    {
        $aksesgrup=Aksesgrup::byLevel()->pluck('nama', 'id');
        return view('backend.user.tambah', compact('aksesgrup'));
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'nama'=>'required|string|max:255', 'username'=>'required|string|max:50|unique:users', 'password'=>'min:6', 'aksesgrup_id'=>'required', 'level'=>'required',
        ]);
        if ($validator->fails()) {
            $response=['status'=>FALSE, 'pesan'=>$validator->messages()];
        }
        else {
            if (User::create($request->all())) {
                $response=['status'=>TRUE, 'pesan'=>['msg'=>'Data berhasil disimpan']];
            }
            else {
                $response=['status'=>FALSE, 'pesan'=>['msg'=>'Data gagal disimpan']];
            }
        }
        return response()->json($response);
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user=User::find($id);
        $aksesgrup=Aksesgrup::byLevel()->pluck('nama', 'id');
        return view('backend.user.ubah', compact('user', 'aksesgrup'));
    }

    public function update(Request $request, $id)
    {
        $validator=Validator::make($request->all(), [
            'password'=>'nullable|min:6', 'aksesgrup_id'=>'required', 'level'=>'required',
        ]);
        if ($validator->fails()) {
            $response=['status'=>FALSE, 'pesan'=>$validator->messages()];
        }
        else {
            $user=User::find($id);
            if ($request->has('password')) {
                $update=$user->update($request->all());
            }
            else {
                $update=$user->update($request->except('password'));
            }
            if ($update) {
                $response=['status'=>TRUE, 'pesan'=>['msg'=>'Data berhasil diubah']];
            }
            else {
                $response=['status'=>FALSE, 'pesan'=>['msg'=>'Data gagal diubah']];
            }
        }
        return response()->json($response);
    }

    public function hapus($id)
    {
        $user=User::find($id);
        return view('backend.user.hapus', ['user'=>$user]);
    }

    public function destroy($id)
    {
        $user=User::find($id);
        if ($user->id == Auth::id()) {
            return response()->json(['status'=>FALSE, 'pesan'=>['msg'=>'Maaf, tidak bisa menghapus akun sendiri. Silahkan Hubungi Administrator..']]);
        }
        if ($user->delete()) {
            $response=['status'=>TRUE, 'pesan'=>['msg'=>'Data berhasil dihapus']];
        }
        else {
            $response=['status'=>FALSE, 'pesan'=>['msg'=>'Data gagal dihapus']];
        }
        return response()->json($response);
    }

    public function ubahpassword($id)
    {
        if ($id == Auth::user()->id) {
            $user=User::find($id);
            return view('backend.user.ubah_password', compact('user'));
        }
        // return view('backend.main.404');
    }

    public function resetpassword(Request $request)
    {
        if (Auth::user()->id != $request->input('id')) {
            $response=['status'=>FALSE, 'pesan'=>['msg'=>'Tidak ada akses']];
        }
        else {
            $user=User::find($request->input('id'));
            $nullable=$user->password == NULL ? 'nullable|' : '';
            $validator=Validator::make($request->all(), [
                'password_lama'=>$nullable.'required', 'password'=>'required|min:6|confirmed', 'password_confirmation'=>'required|min:6',
            ]);
            if ($validator->fails()) {
                $response=['status'=>FALSE, 'pesan'=>$validator->messages()];
            }
            else {
                if ($user->password == NULL) {
                    if (User::find($request->input('id'))->update($request->all())) {
                        $response=['status'=>TRUE, 'pesan'=>['msg'=>'Password Berhasil diubah']];
                    }
                    else {
                        $response=['status'=>FALSE, 'pesan'=>['msg'=>'Password Gagal diubah']];
                    }
                }
                else if (Hash::check($request->input('password_lama'), Auth::user()->password) && $user->password != NULL) {
                    if (User::find($request->input('id'))->update($request->all())) {
                        $response=['status'=>TRUE, 'pesan'=>['msg'=>'Password Berhasil diubah']];
                    }
                    else {
                        $response=['status'=>FALSE, 'pesan'=>['msg'=>'Password Gagal diubah']];
                    }
                }
                else {
                    $response=['status'=>FALSE, 'pesan'=>['msg'=>'Password Lama salah']];
                }
            }
        }
        return response()->json($response);
    }

    public function lockScreen(Request $request)
    {
        if ($request->ajax()) {
            if (env('APP_ENV') == 'development') {
                if (Auth::user()->update(['remember_token'=>NULL])) {
                    $response=['status'=>TRUE, 'pesan'=>'Screen Locked'];
                }
            }
        }
        return response()->json($response ?? ['status'=>FALSE, 'pesan'=>'Request invalid']);
    }
}
