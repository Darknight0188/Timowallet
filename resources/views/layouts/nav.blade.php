<div class="wrapper">
        <div class="sidebar">
          <h2>Menu</h2>
          <ul id="accordion">
            <li class="panel"><a href="#"><i class="fas fa-home"></i>Home</a></li>
            <li class="panel"><a href="#" data-toggle="collapse" data-parent="#accordion" data-target="#collapse1" class="collapsed" aria-expanded="false"><i class="fas fa-user"></i><span>Account</span><i class="fas fa-caret-down"></i></a>
            <div id="collapse1" class="collapse" aria-expanded="false" style="height: 0px;">
                <ul class="dropdown">
                    <li><a href="{{url('user/update')}}/{{Auth::user()->id}}">User infomation</a></li>
                    <li><a href="{{url('user/change')}}/{{Auth::user()->id}}">Change password</a></li>
                </ul>
            </div>
        </li>
        <li class="panel"><a href="#" data-toggle="collapse" data-parent="#accordion" data-target="#collapse2" class="collapsed" aria-expanded="false"><i class="fas fa-address-card"></i><span>Wallet</span><i class="fas fa-caret-down" id="wallet"></i></a>
          <div id="collapse2" class="collapse" aria-expanded="false" style="height: 0px;">
                  <ul class="dropdown">
                      <li><a href="{{url('wallet/list')}}">List Wallet</a></li>
                      <li><a href="{{url('wallet/create')}}">Create Wallet</a></li>
                  </ul>
            </div>
        </li>
        
            <!-- <li class="panel"><a href="#"><i class="fas fa-address-card"></i>Wallet</a></li> -->
          <li class="panel"><a href="#" data-toggle="collapse" data-parent="#accordion" data-target="#collapse3" class="collapsed" aria-expanded="false"><i class="fas fa-project-diagram"></i><span>Category</span><i class="fas fa-caret-down" id="category"></i></a>
            <div id="collapse3" class="collapse" aria-expanded="false" style="height: 0px;">
                  <ul class="dropdown">
                      <li><a href="{{url('category')}}">List Category</a></li>
                      <li><a href="{{url('category/create')}}">Create Category</a></li>
                  </ul>
            </div>
          </li>
            <li class="panel"><a href="#"><i class="fas fa-blog"></i>Blogs</a></li>
            <li class="panel"><a href="#"><i class="fas fa-address-book"></i>Contact</a></li>
            <li class="panel"><a href="#"><i class="fas fa-map pin"></i>Maps</a></li>
          </ul>
        </div>
        <div class="main_content">
          <!-- <div class="header">Dasbroad</div> -->
          <div class="col-lg-12">
            @if(Session::has('flash_message'))
            <div class="alert alert-success" role="alert">
              {!! Session::get('flash_message') !!}
            </div>
            @endif
          </div>
          <div class="info">
            @yield('infomation')
          </div>
        </div>
      </div>  