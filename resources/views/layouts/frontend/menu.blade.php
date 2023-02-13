@if(empty($mega))
<li class="menu-item">
    @if(count($data->children) > 0)
    <a class="menu-link" href="{{url('#')}}"><div>{{$data->nama}}</div></a>
    <ul class="sub-menu-container" style="min-width: max-content">
        @foreach($data->children as $sub)
            @include('layouts.frontend.menu', ['data'=>$sub])
        @endforeach
    </ul>
    @else
        @if($data->status==2)
        <a class="menu-link" href="{{$data->link}}"><div>{{$data->nama}}</div></a>
        @else
        <a class="menu-link" href="{{url('/company/page/'.$data->id.'/'.Help::generateSeoURL($data->nama))}}"><div>{{$data->nama}}</div></a>
        @endif

    @endif
</li>
@else
<li class="menu-item mega-menu mega-menu-small">
    <a class="menu-link" href="#"><div>{{$data->nama}}</div></a>
    <div class="mega-menu-content" style="width: max-content">
        <div class="row mx-0">
            @php $i=1; @endphp
            @foreach($data->children as $sub)
                @if($i==1)
                <ul class="sub-menu-container mega-menu-column col" style="min-width: fit-content">
                    <li class="menu-item">
                        @if($sub->status==2)
                            <a class="menu-link" href="{{$sub->link}}"><div>{{$sub->nama}}</div></a>
                        @else
                            <a class="menu-link" href="{{url('/company/page/'.$sub->id.'/'.Help::generateSeoURL($sub->nama))}}"><div>{{$sub->nama}}</div></a>
                        @endif
                    </li>
                @elseif($i==2)
                    <li class="menu-item">
                        @if($sub->status==2)
                            <a class="menu-link" href="{{$sub->link}}"><div>{{$sub->nama}}</div></a>
                        @else
                            <a class="menu-link" href="{{url('/company/page/'.$sub->id.'/'.Help::generateSeoURL($sub->nama))}}"><div>{{$sub->nama}}</div></a>
                        @endif
                    </li>
                @elseif($i==3)
                    <li class="menu-item">
                        @if($sub->status==2)
                            <a class="menu-link" href="{{$sub->link}}"><div>{{$sub->nama}}</div></a>
                        @else
                            <a class="menu-link" href="{{url('/company/page/'.$sub->id.'/'.Help::generateSeoURL($sub->nama))}}"><div>{{$sub->nama}}</div></a>
                        @endif
                    </li>
                </ul>
                @endif
                @php $i++ @endphp
                @php if($i>3) $i=1; @endphp

                @endforeach
        </div>
    </div>
</li>
@endif