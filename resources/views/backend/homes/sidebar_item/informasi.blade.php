@if($keterangan)
    <div id="top-information" class="alert alert-{!! !empty($status_pengumuman) ? $status_pengumuman : 'dark' !!} frame-wrap alert-dismissible fade show p-2 mb-1" kode-halaman="{!! $halaman->kode !!}" role="alert" style="display: none;">
        <a href="#" class="close close-top-information" aria-label="Close">
            <span aria-hidden="true"><i class="fal fa-times"></i></span>
        </a>
        <div class="d-flex flex-start w-100">
            <div class="mr-2">
            <span class="icon-stack icon-stack-lg">
                <i class="base base-6 icon-stack-3x opacity-100 color-danger-500"></i>
                <i class="base base-10 icon-stack-2x opacity-100 color-danger-300 fa-flip-vertical"></i>
                <i class="fal fa-info icon-stack-1x opacity-100 color-white"></i>
            </span>
            </div>
            <div class="d-flex flex-fill">
                <div class="flex-fill text-dark">
                    <span class="h5">{!! $judul !!}</span>
                    <br> {!! $keterangan !!}
                </div>
            </div>
        </div>
    </div>
@endif
