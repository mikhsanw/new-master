@foreach($menu as $mn)
    <div class="col-lg-6 table-responsive">
        <ul class="list-group m-1">
            <li class="list-group-item">
                {!! Form::checkbox('menu[]', $mn->id, $mn->checkAksesmenu($aksesgrup->id), array('id' => 'icheck-input menu'.$mn->id, 'menu-id' => $mn->id, 'class' => 'icheck-input menu'.$mn->id)) !!}
                &nbsp;&nbsp;
                <label for="icheck-input menu{{$mn->id}}">{{$mn->nama}}</label>
                @if(count($mn->children))
                    <ul class="list-group ml-3">
                        @foreach($mn->children as $cmn)
                            @include('backend.aksesmenu.menu.sub-menu',['mn'=>$cmn,'aksesgrup'=>$aksesgrup])
                        @endforeach
                    </ul>
                @endif
            </li>
        </ul>
    </div>
@endforeach
