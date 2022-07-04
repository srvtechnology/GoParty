<!-- Main Header Nav -->
<header class="header-nav menu_style_home_one style2 dashbord menu-fixed main-menu">
  <div class="container-fluid p0">
    <!-- Ace Responsive Menu -->
    <nav>
      <!-- Menu Toggle btn-->
      <div class="menu-toggle">
        <img class="nav_logo_img img-fluid" src="{{url('/')}}/public/adminasset/images/header-logo.svg" alt="header-logo.svg">
        <button type="button" id="menu-btn">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
      </div>
      <a href="index.html" class="navbar_brand float-left dn-md">
        <img class="logo1 img-fluid" src="{{url('/')}}/public/adminasset/images/header-logo2.svg" alt="header-logo.svg">
        <img class="logo2 img-fluid" src="{{url('/')}}/public/adminasset/images/header-logo2.svg" alt="header-logo2.svg">
        <span>Houzing</span>
      </a>
      <!-- Responsive Menu Structure-->
      <ul id="respMenu" class="ace-responsive-menu text-right" data-menu-style="horizontal">
        <li> <a href="#"><span class="title">Home</span></a>
        <!-- Level Two-->
        <ul>
          <li><a href="index.html">Home V1</a></li>
          <li><a href="index2.html">Home V2</a></li>
          <li><a href="index3.html">Home V3</a></li>
          <li><a href="index4.html">Home V4</a></li>
          <li><a href="index5.html">Home V5</a></li>
          <li><a href="index6.html">Home V6</a></li>
          <li><a href="index7.html">Home V7</a></li>
          <li><a href="index8.html">Home V8</a></li>
          <li><a href="index9.html">Home V9</a></li>
          <li><a href="index10.html">Home V10</a></li>
        </ul>
      </li>
      
      <li class="user_setting">
        <div class="dropdown">
          <a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
            @if(@Auth::guard('admin')->user()->image)
            <img src="{{url('/')}}/storage/app/public/admin/{{Auth::guard('admin')->user()->image}}" alt="" style="width: 100px; border-radius: 180px;">@else<i class='fas fa-user-tie' style='font-size:36px;color: black;'  ></i>
            @endif
            <span class="dn-1366"> {{Auth::guard('admin')->user()->name}}<span class="fa fa-angle-down ml5"></span></span>
          </a>
          <div class="dropdown-menu">
            <div class="user_set_header">
              @if(@Auth::guard('admin')->user()->image)
              <img src="{{url('/')}}/storage/app/public/admin/{{Auth::guard('admin')->user()->image}}" alt="" style="width: 100px; border-radius: 180px;">@else<i class='fas fa-user-tie' style='font-size:36px;color: black;'  ></i>
              @endif
              <p>{{Auth::guard('admin')->user()->name}}<br><span class="address">{{Auth::guard('admin')->user()->email}}</span></p>
            </div>
            <div class="user_setting_content">
             {{--  <a class="dropdown-item active" href="{{route('admin.edit.view')}}">My Profile</a> --}}
              <a class="dropdown-item" href="{{ route('admin.logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </nav>
</div>
</header>
<!-- Main Header Nav For Mobile -->
<div id="page" class="stylehome1 h0">
<div class="mobile-menu">
  <div class="header stylehome1">
    <div class="main_logo_home2 text-center"> <img class="nav_logo_img img-fluid mt10" src="{{url('/')}}/public/adminasset/images/header-logo.svg" alt="header-logo.svg"> <span class="mt15">Houzing</span> </div>
    <ul class="menu_bar_home2">
      <li class="list-inline-item"><a class="custom_search_with_menu_trigger msearch_icon" href="#"></a></li>
      <li class="list-inline-item"><a class="muser_icon" href="#" data-toggle="modal" data-target="#logInModal"><span class="flaticon-user"></span></a></li>
      <li class="list-inline-item"><a class="menubar" href="#menu"><span></span></a></li>
    </ul>
  </div>
  </div><!-- /.mobile-menu -->
  <nav id="menu" class="stylehome1">
    <ul>
      <li><span>Home</span>
      <ul>
        <li><a href="index.html">Home V1</a></li>
        <li><a href="index2.html">Home V2</a></li>
        <li><a href="index3.html">Home V3</a></li>
        <li><a href="index4.html">Home V4</a></li>
        <li><a href="index5.html">Home V5</a></li>
        <li><a href="index6.html">Home V6</a></li>
        <li><a href="index7.html">Home V7</a></li>
        <li><a href="index8.html">Home V8</a></li>
        <li><a href="index9.html">Home V9</a></li>
        <li><a href="index10.html">Home V10</a></li>
      </ul>
    </li>
  </ul>
</nav>
</div>