{!! Form::open(array('id' => 'frmOji', 'class' => 'form account-form', 'method' => 'post')) !!}
<div class="row">
    <div class="col-md-6">
        <p>
            {!! Form::label('nama', 'Nama Menu', array('class' => 'control-label')) !!}
            {!! Form::text('nama', NULL, array('id' => 'nama', 'class' => 'form-control', 'placeholder' => 'Nama Menu')) !!}
        </p>
        <p>
            {!! Form::label('kode', 'Kode Menu', array('class' => 'control-label')) !!}
            {!! Form::text('kode', NULL, array('id' => 'kode', 'class' => 'form-control', 'placeholder' => 'Kode Menu')) !!}
        </p>
        <p>
            {!! Form::label('link', 'Link', array('class' => 'control-label')) !!}
            {!! Form::text('link', NULL, array('id' => 'link', 'class' => 'form-control', 'placeholder' => 'Link')) !!}
        </p>


    </div>
    <div class="col-md-6">
        <p>
            {!! Form::label('icon', 'Icon', array('class' => 'control-label')) !!}
        </p>
        <div role="iconpicker" class="iconpicker center" data-original-title="" title="">
            <input type="hidden" name="icon" id="icon" value="fas fa-building">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6">
        <p>
            {!! Form::label('model', 'Model', array('class' => 'control-label')) !!}
            <span class="fa fa-info-circle" title="Model digunakan jika menggunakan construct pada controller global"></span>
            {!! Form::select('model', $model, [],array('id' => 'model', 'class' => 'form-control select2', 'placeholder' => 'Pilih Model (optional)', 'style' => 'width:100%')) !!}
        </p>
    </div>
    <div class="col-md-3">
        <p>
            {!! Form::label('status', 'Status', array('class' => 'control-label')) !!}
            {!! Form::select('status', array(1 => 'Show', 0 => 'Hide'), NULL, array('id' => 'status', 'class' => 'form-control')) !!}
        </p>
    </div>
    <div class="col-md-3">
        <p>
            {!! Form::label('tampil', 'Tampilkan', array('class' => 'control-label')) !!}
            {!! Form::select('tampil', array(1 => 'Private', 0 => 'Public'), NULL, array('id' => 'tampil', 'class' => 'form-control')) !!}
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
                            {!! Form::text('title', NULL, array('id' => 'title', 'class' => 'form-control', 'placeholder' => 'Title')) !!}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p>
                            {!! Form::label('status_pengumuman', 'Status Pengumuman', array('class' => 'control-label')) !!}
                            {!! Form::select('status_pengumuman', config('master.status_pengumuman'), NULL, array('id' => 'status', 'class' => 'form-control')) !!}
                        </p>
                    </div>
                    <p>
                </div>
                    {!! Form::label('keterangan', 'Keterangan', array('class' => 'control-label')) !!}
                    {!! Form::textarea('keterangan',  NULL, array('id' => 'keterangan', 'class' => 'form-control js-summernote')) !!}
                </p>
            </div>
        </div>
    </div>
    {!! Form::hidden('url', URL::previous(), array('id' => 'url')) !!}
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
    $('.modal-title').html('<span class="fa fa-plus-circle"></span> Tambah Menu')
    $('.select2').select2();
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
        inlineMode: true,
    });

</script>
