<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class aplikasiController extends Controller
{
    public function index()
    {
        return view('backend.'.$this->kode.'.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data= $this->model::all();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', '<div style="text-align: center;">
               <a class="edit ubah" data-toggle="tooltip" data-placement="top" title="Edit" '.$this->kode.'-id="{{ $id }}" href="#edit-{{ $id }}">
                   <i class="fa fa-edit text-warning"></i>
               </a>&nbsp; &nbsp;
               <a class="logo" data-toggle="tooltip" data-placement="top" title="Logo Besar" '.$this->kode.'-id="{{ $id }}" href="#logo-{{ $id }}">
                    <i class="fas fa-image text-info   "></i>
                </a>&nbsp; &nbsp;
                <a class="favicon" data-toggle="tooltip" data-placement="top" title="Logo Kecil" '.$this->kode.'-id="{{ $id }}" href="#favicon-{{ $id }}">
                    <i class="far fa-image text-info"></i>
                </a
           </div>')->rawColumns(['action'])->toJson();
        }
        else {
            exit("Not an AJAX request -_-");
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.'.$this->kode.'.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function logo($id)
    {
        $data=[
            'data'    => $this->model::find($id)
        ];
        return view('backend.'.$this->kode.'.logo', $data);
    }

    public function store_logo(Request $request)
    {
        if ($request->ajax()) {
            $validator=Validator::make($request->all(), [
                'file_logo'        => 'required|mimes:jpg,jpeg,png'
                ]);
            if ($validator->fails()) {
                $respon=['status'=>false, 'pesan'=>$validator->messages()];
            }
            else {
                $data = $this->model::whereId($request->id)->first();
                if ($request->hasFile('file_logo')) {
                    $data->file_logo()->updateOrCreate(['name'=>'logo'],[
                        'name'                  => 'logo',
                        'data'                      =>  [
                            'disk'      => config('filesystems.default'),
                            'target'    => Storage::putFile($this->kode.'/logo/'.date('Y').'/'.date('m').'/'.date('d'),$request->file('file_logo')),
                        ]
                    ]);
                }
                $respon=['status'=>true, 'pesan'=>'Data berhasil disimpan'];
            }
            return $respon;
        }
        else {
            exit('Ops, an Ajax request');
        }
    }

    public function favicon($id)
    {
        $data=[
            'data'    => $this->model::find($id)
        ];
        return view('backend.'.$this->kode.'.favicon', $data);
    }

    public function store_favicon(Request $request)
    {
        if ($request->ajax()) {
            $validator=Validator::make($request->all(), [
                'file_favicon'        => 'required|mimes:jpg,jpeg,png'
                ]);
            if ($validator->fails()) {
                $respon=['status'=>false, 'pesan'=>$validator->messages()];
            }
            else {
                $data = $this->model::whereId($request->id)->first();
                if ($request->hasFile('file_favicon')) {
                    $data->file_favicon()->updateOrCreate(['name'=>'favicon'],[
                        'name'                  => 'favicon',
                        'data'                      =>  [
                            'disk'      => config('filesystems.default'),
                            'target'    => Storage::putFile($this->kode.'/logo/'.date('Y').'/'.date('m').'/'.date('d'),$request->file('file_favicon')),
                        ]
                    ]);
                }
                $respon=['status'=>true, 'pesan'=>'Data berhasil disimpan'];
            }
            return $respon;
        }
        else {
            exit('Ops, an Ajax request');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=[
            'data'    => $this->model::find($id)
        ];
        return view('backend.'.$this->kode.'.ubah', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $validator=Validator::make($request->all(), [
                'nama'             => 'required|'.config('master.regex.json'),
                'singkatan'        => 'required|'.config('master.regex.json'),
                'daerah'           => 'required|'.config('master.regex.json'),
                ]);
            if ($validator->fails()) {
                $response=['status'=>FALSE, 'pesan'=>$validator->messages()];
            }
            else {
                $this->model::find($id)->update($request->all());
                $respon=['status'=>true, 'pesan'=>'Data berhasil diubah'];
            }
            return $response ?? ['status'=>TRUE, 'pesan'=>['msg'=>'Data berhasil diubah']];
        }
        else {
            exit('Ops, an Ajax request');
        }
    }
}
