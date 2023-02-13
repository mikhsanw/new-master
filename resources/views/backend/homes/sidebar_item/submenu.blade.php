<li class="{{ $mn->active($mn->kode) }}">
    <a href="{{ count($mn->children) > 0 ? '#' : url(ltrim($url_admin.'/'.$mn->link, '/')) }}" title="{{ $mn->nama }}" data-filter-tags="{{ $mn->nama }}">
        <i class="{{ $mn->icon }}"></i>
        <span class="nav-link-text {{ $mn->kode }}" data-i18n="nav.{{ $mn->kode }}">{{ $mn->nama }}</span>
    </a>
    @if(count($mn->children) > 0)
        <ul style="background: #2f4b5d">
            @foreach($mn->children as $sub)
                @if($sub->tampil == 1 && $sub->status == 1)
                    @if($sub->checkAksesmenu(Auth::user()->aksesgrup_id))
                        @include('backend.home.sidebar_item.submenu', ['mn'=>$sub])
                    @endif
                @endif
            @endforeach
        </ul>
    @endif
</li>
