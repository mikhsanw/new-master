<!-- Control Sidebar -->
<aside class="control-sidebar">
	  
      <div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger"><i class="fa fa-close text-white" data-toggle="control-sidebar"></i></span> </div>  <!-- Create the tabs -->
      <ul class="nav nav-tabs control-sidebar-tabs">
        <!-- <li class="nav-item"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-inbox"></i></a></li>
        <li class="nav-item"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-play"></i></a></li>
      </ul> -->
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <div class="flexbox">
              <a href="javascript:void(0)" class="text-grey">
                  <i class="ti-more"></i>
              </a>	
              <p>Users</p>
              <a href="javascript:void(0)" class="text-right text-grey"><i class="ti-plus"></i></a>
            </div>
            <div class="lookup lookup-sm lookup-right d-none d-lg-block">
              <input type="text" name="s" placeholder="Search" class="w-p100">
            </div>
            </div>
  
        </div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <div class="flexbox">
              <a href="javascript:void(0)" class="text-grey">
                  <i class="ti-more"></i>
              </a>	
              <p>Todo List</p>
              <a href="javascript:void(0)" class="text-right text-grey"><i class="ti-plus"></i></a>
            </div>
          <ul class="todo-list mt-20">
              
            </ul>
        </div>
        <!-- /.tab-pane -->
      </div>
    </aside>
    <!-- /.control-sidebar -->

{{-- Modal Lock Screen --}}
<div class="modal modal-small fade text-center" id="lock-screen-modal" tabindex="-1" role="dialog" style="display: none; " aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-white m-50">
                <div class="py-3">
                    <img src="{{ Avatar::create($user->nama)->toBase64() }}" class="img-responsive rounded-circle img-thumbnail" alt="thumbnail">
                </div>
                <div class="form-group">
                    <h3>
                        {!! $user->nama !!}
                        <small>
                            {!! $user->username !!}
                        </small>
                    </h3>
                    <div id="form-lock-screen">
                      <div class="input-group mb-5">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                        </div>
                        <input type="hidden" value="{!! $user->username !!}" name="username" id="username">
                        <input type="password" name="password" id="password" class="form-control bg-transparent" placeholder="Password">
                        <div class="input-group-append">
                          <button class="btn btn-success shadow-0 waves-effect waves-themed" type="button" id="unlock-screen">
                              <i class="fas fa-key"></i></button>
                        </div>
                      </div>
                    </div>
                    <p class="text-white opacity-50">Enter your password to retrieve your session</p>
                    <p class="text-white opacity-50">OR</p>
                    <div class="text-center">
                        <a href="#logout" onclick="e.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-primary opacity-90 keluar">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
