@extends('admin.layouts.app')


@section('title')
<title>Activarmor | Change Password</title>
@endsection

@section('style')
@include('admin.includes.style')
@endsection

@section('content')
<!-- Top Bar Start -->
@include('admin.includes.header')
<!-- Top Bar End -->


<!-- ========== Left Sidebar Start ========== -->
@include('admin.includes.sidebar')
<!-- Left Sidebar End -->



<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Change Password</h4>
                    <ol class="breadcrumb pull-right">
                        <li class="active"><a href="{{route('admin.dashboard')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                     @include('admin.includes.message')  
                    <div>

                        <!-- Personal-Information -->
                        <div class="panel panel-default panel-fill">
                            <div class="panel-heading">
                                <h3 class="panel-title">Change Password</h3>
                            </div>
                            <div class="panel-body rm02 rm04">
                                <form role="form" action="{{route('admin.change.password.confirm')}}"  method="POST" id="change_password" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="category_name">Old Password</label>
                                        <input type="password" placeholder="Old Password" id="oldpassword" class="form-control" name="oldpassword" required>
                                        <div id="err_category"></div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="Email">New Password</label>
                                        <input type="password" placeholder="New Password" id="password" class="form-control" name="password" required>
                                    </div>

                                     <div class="form-group ">
                                        <label for="Email">Confirm New Password</label>
                                        <input type="password" placeholder="Confirm New Password" id="confirm_password" class="form-control" name="confirm_password" required>
                                    </div>
                                


                                    <div class="clearfix"></div>
                                    <div class="col-lg-12"> <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button></div>
                                </form>

                            </div>
                        </div>
                        <!-- Personal-Information -->

                    </div>
                </div>
            </div>
            <!-- End row -->

        </div>
        <!-- container -->

    </div>
    <!-- content -->

    @include('admin.includes.footer')
</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->

@endsection

@section('script')
@include('admin.includes.script')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
             <script type="text/javascript">
                 $(function(){
                  $('#change_password').validate({
                  rules:{
                    oldpassword:{
                      required:true,
                      remote: {
                       url:  '{{route('admin.change.password.check')}}',
                       type: "get",
                       data: {
                       oldpassword: function(){
                          return $( "#oldpassword" ).val();
                        },
                       }
                      },
                    },
                     password : {
                      required:true,
                      // minlength : 4
                    },
                    confirm_password : {
                      required:true,
                      // minlength : 4,
                      equalTo : '[name="password"]'
                     },
                  },
                  messages:{
                    oldpassword:{
                      required:'Please enter your old password',
                      remote:'Enter your old password correctly'
                    },
                    password:{
                      required:'Please enter your new password'
                    },
                    confirm_password:{
                      required:'Please enter your confirm password'
                    },
                  }
                })
              })
             </script>
@endsection
