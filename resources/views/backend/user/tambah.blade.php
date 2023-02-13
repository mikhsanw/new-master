{!! Form::open(array('id' => 'frmOji', 'route' => [$halaman->kode.'.store'], 'class' => 'form account-form', 'method' => 'post')) !!}
<div class="row">
    <div class="col-md-12 form-group">
        <div class="form-group">
            {!! Form::label('Nama', 'Siapa Namanya ?', array('class' => 'control-label')) !!}
            {!! Form::text('nama', NULL, array('id' => 'nama', 'class' => 'form-control', 'placeholder' => 'Nama')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('nip', 'NIP', array('class' => 'control-label')) !!}
            {!! Form::text('nip', NULL, array('id' => 'nip', 'class' => 'form-control', 'placeholder' => 'NIP')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Password', 'Password', array('class' => 'control-label')) !!}
            <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
        </div>
        <div class="form-group">
            {!! Form::label('email', 'E-Mail', array('class' => 'control-label')) !!}
            {!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email')) !!}
        </div>
    </div>
    <div class="col-md-6 form-group">
        <div class="form-group">
            {!! Form::label('Akses Grup', 'Akses Grup', array('class' => 'control-label')) !!}
            {!! Form::select('aksesgrup_id', $aksesgrup, 5, array('id' => 'aksesgrup_id', 'class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('level', 'Level', array('class' => 'control-label')) !!}
            {!! Form::select('level', config('master.level'), 5, array('id' => 'level', 'class' => 'form-control')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <span class="pesan"></span>
        <div id="output"></div>
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                <div id="statustxt">0%</div>
            </div>
        </div>
    </div>
</div>
{!! Form::hidden('table-list', 'datatable', array('id' => 'table-list')) !!}
{!! Form::close() !!}
<script src="{{ URL::asset('resources/vendor/jquery/jquery.enc.js') }}"></script>
<script src="{{ URL::asset('resources/vendor/jquery/jquery.form.js') }}"></script>
<script src="{{ URL::asset(config('master.aplikasi.author').'/js/ajax_progress.js') }}"></script>
<script>
    $('.modal-title').html('<i class="{!! $halaman->icon !!}"></i> Tambah {{ $halaman->nama }}');
</script>
