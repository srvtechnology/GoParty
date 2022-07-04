@section('head')
@include('admin.include.head')
@endsection
<div class="extra-dashboard-menu dn-lg" >
  <div class="ed_menu_list">
    <ul>
      <li><a class="{{request()->segment(2)=='dashboard'?'active':''}}" href="{{route('admin.dashboard.home')}}"><span class="flaticon-dashboard"></span> Dashboard</a></li>

      {{-- <li><a href="{{route('admin.edit.view')}}" class="{{request()->segment(2)=='edit-profile'?'active':''}}"><span class="flaticon-user"></span> My Profile</a></li>
      
      <li><a href="{{route('admin.list.tenant')}}" class="{{request()->segment(2)=='manage-organization'?'active':''}}"><span class="flaticon-user"></span> Manage Organization</a></li> --}}
      

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