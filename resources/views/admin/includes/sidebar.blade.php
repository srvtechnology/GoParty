<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="pull-left">
                @if(auth()->guard('admin')->user()->image=="")
                <img src="{{ URL::to('public/admin/assets/images/users/avatar-1.jpg')}}" alt="" class="thumb-md img-circle">
                @else
                <img src="{{ URL::to('storage/app/public/admin_image')}}/{{auth()->guard('admin')->user()->image}}" alt="" class="thumb-md img-circle">
                @endif

            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{auth()->guard('admin')->user()->name}} <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('admin.profile')}}"><i class="fas fa-user-circle"></i> Profile</a></li>
                        <li><a href="{{route('admin.change.password')}}"><i class="fas fa-cog"></i> Change Password</a></li>
                        <li><a href="{{route('admin.logout')}}"><i class="fas fa-power-off"></i> Logout</a></li>
                    </ul>
                </div>

                <p class="text-muted m-0">Administrator</p>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

                

                <li><a href="{{route('admin.dashboard')}}" class="waves-effect @if(Request::segment(2)=="") active @endif"><i class="fa fa-money"></i><span>Dashboard</span></a></li>
                <li><a href="{{route('admin.manage.contact')}}" class="waves-effect @if(Request::segment(2)=="manage-contact") active @endif"><i class="fa fa-money"></i><span>Contact</span></a></li>

        
           

               

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
