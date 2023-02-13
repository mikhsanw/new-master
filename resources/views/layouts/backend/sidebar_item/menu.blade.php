@foreach($menu_item as $mn)
    @if($mn->tampil == 1)
        @if($mn->checkAksesmenu(Auth::user()->aksesgrup_id))
            @include('layouts.backend.sidebar_item.submenu', ['mn'=>$mn])
        @endif
    @else
        @include('layouts.backend.sidebar_item.submenu', ['mn'=>$mn])
    @endif
@endforeach
