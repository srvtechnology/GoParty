@extends('admin.layouts.app')


@section('title')
<title>Activarmor | Change Profile</title>
@endsection

@section('style')
@include('admin.includes.style')
<link href="{{ URL::asset('public/frontend/croppie/croppie.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('public/frontend/croppie/croppie.min.css') }}" rel="stylesheet" />
<style type="text/css">
   .error{
      color: red;
   }
   .uplodimgfilimg {
    margin-left: 20px;
    padding-top: 20px;
  }
  .uplodimgfilimg em {
      width: 58px;
      height: 58px;
      position: relative;
      display: inline-block;
      overflow: hidden;
      border-radius: 4px;
  }

   .uplodimgfilimg em img{
      position: absolute;
      max-width: 100%;
      max-height: 100%;
    }
</style>
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
                    <h4 class="pull-left page-title">Change Profile</h4>
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
                                <h3 class="panel-title">Change Profile</h3>
                            </div>
                            <div class="panel-body rm02 rm04">
                                <form role="form"  method="POST" action="{{route('admin.manage.profile.update')}}" id="profile_form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="category_name">Name</label>
                                        <input type="text" placeholder="Name" id="oldpassword" class="form-control" name="name" required value="{{auth()->guard('admin')->user()->name}}">
                                        <div id="err_category"></div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="Email">Email</label>
                                        <input type="text" placeholder="Email" id="email" class="form-control" name="email" required value="{{auth()->guard('admin')->user()->email}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="Email">Profile Image</label>
                                        <div class="uplodimgfil">
                                            {{-- <input type="file" name="icon" id="icon" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" onchange="fun1()" /> --}}
                                            <input name="image" type="file" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" onChange="fun();" id="icon" accept="image/*" />

                                           {{--  <input type="file" id="icon" name="image"  class="inputfile inputfile-1">
                                             <input type="hidden" name="profile_picture" id="profile_picture"> --}}
                                            <label for="icon">Upload Profile Picture<img src="{{ URL::to('public/admin/assets/images/clickhe.png')}}" alt=""></label>
                                        </div>
                                       <div id="err_icon"></div>
                                  </div>

                                  <div class="uplodimgfilimg">
                                    <em>
                                  <img src="{{ URL::to('storage/app/public/admin_image')}}/{{auth()->guard('admin')->user()->image}}" alt="" id="img2">
                                  </em>
                                </div>  
                                            


                                    <div class="clearfix"></div>
                                    <div class="col-lg-12"> <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button></div>
                                </form>
                <div class="modal" tabindex="-1" role="dialog" id="croppie-modal">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title">Crop Image</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <div class="row">
                                      <div class="col-12">
                                          <div class="croppie-div" style="width: 100%;"></div>
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="crop-img">Save changes</button>
                                  <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Close</button>
                              </div>
                          </div>
                      </div>
                  </div>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
 <script>
        function fun(){
        var i=document.getElementById('icon').files[0];
        //console.log(i);
        var b=URL.createObjectURL(i);
        $("#img2").attr("src",b);
    }
</script>         
             <script type="text/javascript">
                 $(function(){
                  jQuery.validator.addMethod("validate_email", function(value, element) {
            if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "{{__('Please enter your email properly')}}");
                  $('#profile_form').validate({
                  rules:{
                    name:{
                      required:true
                    },
                     email : {
                      required:true,
                      validate_email:true,
                      email:true,
                      remote: {
                       url:  '{{route('admin.manage.profile.checkemail')}}',
                       type: "get",
                       data: {
                       email: function(){
                              return $( "#email" ).val();
                        },
                        id:'{{auth()->guard('admin')->user()->id}}'
                          }
                        },
                    },
                    
                  },
                  messages:{
                    name:{
                      required:'Please enter your name'
                    },
                    email:{
                      required:'Please enter your email',
                      email:'Please enter your email properly',
                      remote:'Email already exits.Try another.'
                    },
                  }
                })
              })
             </script> 
@endsection
