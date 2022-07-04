@extends('admin.layouts.app')
@section('title')
    <title>Admin | Edit profile</title>
@endsection
@section('left_part')
    @include('admin.include.left_part')
    {{-- for datepicker --}}
    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
@endsection
@section('content')
    <div class="wrapper">
        <div class="preloader"></div>
        @include('admin.include.nav'){{-- ......................NAV ..................... --}}
        @include('admin.include.left_part'){{-- ......................left-part ..................... --}}
        <!-- Our Dashbord -->
        <section class="our-dashbord dashbord bgc-alice-blue">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-2 dn-lg pl0"></div>
                    <div class="col-xl-10">
                        <div class="row">
                            @include('admin.include.mobile_dashboard'){{-- ,,,,,,,,,,Mobile Left_part,,,,,,,,,, --}}
                            <div class="col-lg-12 mb50">
                                <div class="breadcrumb_content">
                                    <h2 class="breadcrumb_title">My Profile</h2>
                                    <p class="">Ready to jump back in!</p>
                                </div>
                            </div>






                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <form class="contact_form profile mb30 frm1"
                                            action="{{ route('admin.update.admin') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h4 class="mb30 title">Profile Information</h4>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb25">
                                                        <input type="text" placeholder="Enter name" id="name"
                                                            class="form-control form_control" name="name"
                                                            value="{{ Auth::guard('admin')->user()->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb25">
                                                        <input type="text" placeholder="Enter email" id="email"
                                                            class="form-control form_control" name="email"
                                                            value="{{ Auth::guard('admin')->user()->email }}">
                                                    </div>
                                                </div>
                                                {{-- <input type="text" placeholder="upload photo"  id="photo" class="form-control form_control"  name="photo" value="{{@Auth::guard('admin')->user()->image}}"> --}}
                                                <div class="col-xl-12">
                                                    <div class="form-group mb0">
                                                        <button class="btn btn-thm update_btn">UPDATE PROFILE</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>







                                        <form class="contact_form profile mb30 frm2"
                                            action="{{ route('admin.update.admin') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h4 class="mb30 title">Change Password</h4>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group mb25">
                                                        <input type="password" placeholder="Enter old password" id="pass"
                                                            class="form-control form_control" name="old_password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb25">
                                                        <input type="password" placeholder="Enter new password"
                                                            class="form-control form_control" name="newPassword" id="new">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb30">
                                                        <input type="password" placeholder=" Enter confirm password"
                                                            class="form-control form_control" name="confirm" id="conf">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="form-group mb0">
                                                        <button class="btn btn-thm update_btn">CHANGE PASSWORD</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>








                                    <div class="col-lg-4">
                                        <form class="frm3" action="{{ route('admin.update.admin') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="my_dashboard_profile">
                                                <h4 class="mb20 title">Photo</h4>
                                                <div class="wrap-custom-file mb25">
                                                    <input type="file" name="img" id="image1" accept=".gif, .jpg, .png" />
                                                    <label for="image1">
                                                        <span class="flaticon-document">&nbsp;&nbsp;UPLOAD PROFILE
                                                            PHOTO</span>
                                                        <small class="file_title" style="margin-bottom: 10px;">*minimum
                                                            500px x 500px</small>
                                                    </label>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="form-group mb0">
                                                        <button class="btn btn-thm update_btn">CHANGE PHOTO</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @section('footer')
                        @include('admin.include.footer')
                    @endsection

                </div>
            </div>
        </div>
    </section>
    <a class="scrollToHome" href="#"><i class="fa fa-angle-up"></i></a>
</div>
@endsection
{{-- end content --}}
@section('script')
<script src="{{ url('/') }}/public/adminasset/js/jquery-3.6.0.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/jquery-migrate-3.0.0.min.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/popper.min.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/bootstrap.min.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/jquery.mmenu.all.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/ace-responsive-menu.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/bootstrap-select.min.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/snackbar.min.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/simplebar.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/parallax.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/scrollto.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/jquery-scrolltofixed-min.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/jquery.counterup.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/wow.min.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/progressbar.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/slider.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/timepicker.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/wow.min.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/smartuploader.js"></script>
<script src="{{ url('/') }}/public/adminasset/js/dashboard-script.js"></script>
<!-- Custom script for all pages -->
<script src="{{ url('/') }}/public/adminasset/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"
integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg=="
crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        jQuery.validator.addMethod("validate_email", function(value, element) {
            if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid email address.");
        $('.frm1').validate({
            rules: {
                email: {
                    required: true,
                    minlength: 6,
                    validate_email: true
                },
                name: {
                    required: true,
                    minlength: 2,
                    maxlength: 20,
                },
                newPassword: {
                    required: true,
                    minlength: 6,
                },
            },
            messages: {}
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('.frm2').validate({
            rules: {
                old_password: {
                    required: true,
                    minlength: 6,
                },
                newPassword: {
                    required: true,
                    minlength: 6,
                },
                confirm: {
                    required: true,
                    minlength: 6,
                    equalTo: '[name="newPassword"]'
                },
            },
            messages: {
                old_password: {
                    required: " Old password is mandatory",
                    min: "Enter minimum 6 characters"
                },
                newPassword: {
                    required: " New password is mandatory",
                    min: "Enter minimum 6 characters"
                },
                confirm: {
                    required: " Confirm password is mandatory",
                    min: "Enter minimum 6 characters",
                    equalTo: "New password and confirm password are not matching"
                },
            }
        });
    });
</script>
{{-- <script>
function fun(){
var i=document.getElementById('img').files[0];
//console.log(i);
var b=URL.createObjectURL(i);
$(".review_img").show();
$("#img2").attr("src",b);
}
</script> --}}
@endsection
