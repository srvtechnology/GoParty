@extends('admin.layouts.app')
@section('title')
<title>Goparty | Admin | Login</title>
@endsection
@section('head')
@include('admin.include.head')
<style type="text/css">
body {
overflow: hidden;
}
.login_form.inner_page{
       width: 35%;
    margin: 10% auto;
}
@media (max-width: 500px){
.login_form.inner_page{
    width: 100%;
   /* margin: 14% auto;*/
}
}
</style>
@endsection
@section('content')
<div class="wrapper">
    <div class="preloader"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="login_form inner_page bgc-white mb30">
                <form method="POST" action="{{ route('admin.login') }}" aria-label="{{ __('Login') }}" class="form-horizontal m-t-20">
                    @csrf
                    <h4 class="title">Sign in</h4>
                    <div class="mb-2 mr-sm-2">
                        <label for="formGroupExampleInput" class="form-label mb0">Login</label>
                        <input id="email" type="email" class="form-control input-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ @Cookie::get('fintech_admin_user_email') == null ? old('email'): @Cookie::get('fintech_admin_user_email')}}" required autofocus placeholder="Username">
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red;">{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group mb5">
                        <input id="password" type="password" class="form-control input-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password" value="{{ @Cookie::get('fintech_admin_user_password') }}">
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red;">{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="form-check-input" name="remember" id="checkbox-signup" type="checkbox" {{ old('remember') ? 'checked' : '' }} @if(@Cookie::get('fintech_admin_user_email') != null) checked @endif>
                        <label for="exampleCheck2">Remember me</label>
                       {{--  <a class="btn-fpswd float-right text-thm" href="{{route('admin.enter.mail.page')}}">Forgot Password</a> --}}
                    </div>
                    <button type="submit" class="btn btn-log btn-block btn-thm mt20">Sign in</button>
                    
                </form>
            </div>
        </div>
        
    </div>
    <div class="row mt50">
        <div class="col-lg-12 text-center">
            <p class="mb0">Copyright © 2021 CreativeLayers. All Right Reserved.</p>
        </div>
    </div>
</div>
</div>
</div>
</section>
<a class="scrollToHome" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<!-- Wrapper End -->
@section('script')
@include('admin.include.script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
jQuery.validator.addMethod("validate_email", function(value, element) {
if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
return true;
} else {
return false;
}
}, "Please enter a valid email address.");
$('#login_form').validate({
rules:{
email:{
required:true,
validate_email:true
},
password:{
required:true,
}
},
messages:{
email:{
required:"Please enter a email address.",
},
password:{
required:"Please enter a password. ",
}
}
});
});
</script>
@endsection