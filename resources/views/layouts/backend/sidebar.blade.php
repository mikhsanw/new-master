<aside class="main-sidebar">
<!-- sidebar-->
    <section class="sidebar position-relative">
		<div class="user-profile px-20 py-15">
			<div class="d-flex align-items-center">			
				<div class="image">
				  <img src="{{ Avatar::create($user->nama)->toBase64() }}" class="avatar avatar-lg b-0" alt="User Image">
				</div>
				<div class="info">
					<a class="px-20" href="#">{{ strtoupper(strtolower($user->nama)) }}</a>
					<p class="px-20"><span>{!! ucwords(strtolower(config('master.level.'.$user->level))) !!}</span></p>
					
				</div>
			</div>
        </div>
		<hr>
		<div class="multinav">
		  <div class="multinav-scroll" style="height: 100%;">
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">		
				<li class="">
				  <a href="{{url('home')}}">
				   <i class="fa fa-home"><span class="path1"></span><span class="path2"></span></i>
					<span>Dashboard</span>
				  </a>
				</li>	
				@include('layouts.backend.sidebar_item.menu',['menu_item'=>$menu_item])
				 	     
			  </ul>
			</div>
		</div>
    </section>
</aside>
