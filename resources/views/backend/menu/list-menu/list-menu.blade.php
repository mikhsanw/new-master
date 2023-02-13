    <ol class="dd-list">
        @foreach($menu as $mn)
            <li class="dd-item dd3-item" data-id="{{$mn->id}}">
                <div class="dd-handle dd3-handle">
                </div>
                <div class="dd3-content" title="{{$mn->detail['title'] ?? ''}}">
                    @if($mn->icon) <span class="{{$mn->icon}}"></span> @endif {{$mn->nama}}
                    <div class="pull-right">
                        <a class="edit ubah" data-toggle="tooltip" data-placement="top" title="Ubah data menu" menu-id="{{ $mn->id }}" href="#edit-{{$mn->id}}">
                            <i class="fa fa-edit text-warning"> </i>
                        </a>&nbsp; &nbsp;
                        <a class="delete hidden-xs hidden-sm hapus" data-toggle="tooltip" data-placement="top" title="Hapus Menu" menu-id="{{ $mn->id }}" href="#hapus-{{$mn->id}}">
                            <i class="fa fa-trash text-danger"> </i>
                        </a>
                    </div>
                </div>
                @include('backend.menu.list-menu.list-menu', ['menu'=>$mn->children])
            </li>
        @endforeach
    </ol>

