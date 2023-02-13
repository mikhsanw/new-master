<li class="{{ (count($mn->children) > 0 ? 'treeview' :'').' '.$mn->active($mn->kode) }}">
    <a href="{{ count($mn->children) > 0 ? '#' : url(ltrim($url_admin.'/'.$mn->link, '/')) }}">
    <i class="{{ $mn->icon }}"><span class="path1"></span><span class="path2"></span></i>
    <span>{{ $mn->nama }}</span>
    @if(count($mn->children) > 0)
        <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
        </span>
    @endif
    </a>
    @if(count($mn->children) > 0)
        <ul class="treeview-menu">
            @foreach($mn->children as $sub)
                @if($sub->tampil == 1 && $sub->status == 1)
                    @if($sub->checkAksesmenu(Auth::user()->aksesgrup_id))
                        @include('layouts.backend.sidebar_item.submenu', ['mn'=>$sub])
                    @endif
                @endif
            @endforeach		
        </ul>
    @endif
</li>