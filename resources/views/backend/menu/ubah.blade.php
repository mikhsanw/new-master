{!! Form::open(array('id' => 'frmOji', 'class' => 'form account-form', 'method' => 'PUT')) !!}
<div class="row">
    <div class="col-md-6">
        <p>
            {!! Form::label('Nama Menu', 'Nama Menu', array('class' => 'control-label')) !!}
            {!! Form::text('nama', $menu->nama, array('id' => 'nama', 'class' => 'form-control', 'placeholder' => 'Nama Menu')) !!}
        </p>
        <p>
            {!! Form::label('Kode Menu', 'Kode Menu', array('class' => 'control-label')) !!}
            {!! Form::text('kode', $menu->kode, array('id' => 'kode', 'class' => 'form-control', 'placeholder' => 'Kode Menu')) !!}
        </p>
        <p>
            {!! Form::label('Link', 'Link', array('class' => 'control-label')) !!}
            {!! Form::text('link', $menu->link, array('id' => 'link', 'class' => 'form-control', 'placeholder' => 'Link')) !!}
        </p>
    </div>
    <div class="col-md-6">
        <p>
            {!! Form::label('Icon', 'Icon digunakan : ', array('class' => 'control-label')) !!} &nbsp;
            <span class="{{$menu->icon}}"> {{$menu->icon}}</span>
        </p>
        <div role="iconpicker" class="iconpicker center" data-original-title="" title="">
            <input type="hidden" name="icon" id="icon" value="{{$menu->icon}}">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6">
        <p>
            {!! Form::label('model', 'Model', array('class' => 'control-label')) !!}
            <span class="fa fa-info-circle" title="Model digunakan jika menggunakan construct pada controller global"></span>
            {!! Form::select('model', $model, $menu->detail['model'] ?? NULL,array('id' => 'model', 'class' => 'form-control select2', 'placeholder' => 'Pilih Model (optional)','style' => 'width:100%')) !!}
        </p>
    </div>
    <div class="col-md-3">
        <p>
            {!! Form::label('Status', 'Status', array('class' => 'control-label')) !!}
            {!! Form::select('status', array(1 => 'Tampil', 0 => 'Tidak Tampil'), $menu->status, array('id' => 'status', 'class' => 'form-control')) !!}
        </p>
    </div>
    <div class="col-md-3">
        <p>
            {!! Form::label('Tampilkan', 'Tampilkan', array('class' => 'control-label')) !!}
            {!! Form::select('tampil', array(1 => 'Private', 0 => 'Public'), $menu->tampil, array('id' => 'tampil', 'class' => 'form-control')) !!}
        </p>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
    <div class="box">
            <div class="box-header with-border">
                <span class="fa fa-bullhorn"></span>&nbsp; Atur Pengumuman &nbsp; <small>( Optional )</small>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-9">
                        <p>
                            {!! Form::label('title', 'Title / Judul ', array('class' => 'control-label')) !!}
                            {!! Form::text('title', $menu->detail["title"] ?? NULL, array('id' => 'title', 'class' => 'form-control', 'placeholder' => 'Title')) !!}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p>
                            {!! Form::label('status_pengumuman', 'Status Pengumuman', array('class' => 'control-label')) !!}
                            {!! Form::select('status_pengumuman', config('master.status_pengumuman'), $menu->detail["status_pengumuman"] ?? NULL, array('id' => 'status', 'class' => 'form-control')) !!}
                        </p>
                    </div>
                </div>
                <p>
                    {!! Form::label('keterangan', 'Keterangan', array('class' => 'control-label')) !!}
                    {!! Form::textarea('keterangan', $menu->detail['keterangan'] ?? NULL, array('id' => 'keterangan', 'class' => 'form-control js-summernote')) !!}
                </p>
            </div>
        </div>
    </div>

    {!! Form::hidden('url', URL::previous(), array('id' => 'url')) !!}
    {!! Form::hidden('id', $menu->id, array('id' => 'id')) !!}
</div>
<div class="row">
    <div class="col-md-12">
        <span class="pesan"></span>
    </div>
</div>
{!! Form::close() !!}
<style>
    .select2-container {
        z-index: 99999 !important;
    }
</style>
<link rel="stylesheet" media="screen, print" href="{{ asset('backend/css/formplugins/bootstrap-iconpicker/bootstrap-iconpicker.css') }}">
<script src="{{ URL::asset('backend/js/formplugins/bootstrap-iconpicker/bootstrap-iconpicker.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset(config('master.aplikasi.author').'/'.$halaman->kode.'/ajax.js') }}"></script>
<script src="{{ URL::asset(config('master.aplikasi.author').'/js/ajax.js') }}"></script>
<script src="{{ asset('backend/fromplugin/summernote/summernote.js') }}" async=""></script>
<script>
    $('.modal-title').html('<span class="fa fa-edit"></span> Ubah data menu');
    $('.select2').select2();
    $('[name="icon"]').val('{{ $menu->icon }}');
    $('.js-summernote').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
        height: 200,
        dialogsInBody: true,
    });
</script>
