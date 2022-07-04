<div class="col-lg-12">
	<div class="dashboard_navigationbar dn db-lg mt50">
		<div class="dropdown">
			<button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10"></i> Dashboard Navigation</button>
			<ul id="myDropdown" class="dropdown-content">
				<li><a class="{{request()->segment(2)=='dashboard'?'active':''}}" href="{{route('admin.dashboard.home')}}"><span class="flaticon-dashboard"></span> Dashboard</a></li>


			{{-- 	<li><a href="{{route('admin.edit.view')}}" class="{{request()->segment(2)=='edit-profile'?'active':''}}"> --}}<span class="flaticon-user"></span> My Profile</a></li>
				
				  <li> <a  href="{{ route('admin.logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  <span class="flaticon-logout"></span>{{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
			</ul>
		</div>
	</div>
</div>