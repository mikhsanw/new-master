@foreach($menu_item as $mn)
    @if($mn->tampil == 1)
        @if($mn->checkAksesmenu(Auth::user()->aksesgrup_id))
            @include('backend.home.sidebar_item.submenu', ['mn'=>$mn])
        @endif
    @else
        @include('backend.home.sidebar_item.submenu', ['mn'=>$mn])
    @endif
@endforeach
