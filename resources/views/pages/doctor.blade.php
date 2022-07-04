@extends('layouts.app')

@section('title')
<title>Doctor</title>
@endsection

@section('style')
@include('includes.style')
<style type="text/css">.error{color: red}
.provider_custom{
  color: white;
}
.provider_custom:hover{
  color: black !important;
  text-decoration: none;
}

</style>
</style> 
@endsection





@section('body')
    
    @section('header')
    @include('includes.header')
    @endsection


    <!-- -- banner --  -->
    <div class="banner" style="  width: 100%;
  min-height: 65vh;
  margin-top: 80px;
  display: flex;
  background: url({{url('/')}}/storage/app/public/banner_min/{{$banner->image}});
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;">
      <div class="max-theme-width">
        <div class="list-main my-auto">
          <div class="list-item">
            <img src="{{asset('public/frontend/assets/img/home/banner/check.png')}}" alt="" />
            <span
              >{{@$banner->heading_one}}</span
            >
          </div>
          <div class="list-item">
            <img src="{{asset('public/frontend/assets/img/home/banner/check.png')}}" alt="" />
            <span>{{@$banner->heading_two}}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- -- Lab --  -->
    <div class="lab section-padding">
      <div class="max-theme-width">
        <div class="row display-flex align-items-center">
          <div class="col-md-6 col-12 my-3">
            <div class="lab-img">
              <img src="{{ URL::to('storage/app/public/about')}}/{{@$why->image}}" alt="" />
            </div>
          </div>
          <div class="col-md-6 col-12 my-3">
            <div class="lab-content">
              <p class="para">
                {{@$why->description}}
              </p>
              <div class="lists">
                <img src="{{asset('public/frontend/assets/img/doctor/check.png')}}" alt="" />
                <p class="text">
                  {{@$why->heading_one}}
                </p>
              </div>
              <div class="lists">
                <img src="{{asset('public/frontend/assets/img/doctor/check.png')}}" alt="" />
                <p class="text">
                 {{@$why->heading_two}}
                </p>
              </div>
              <div class="lists">
                <img src="{{asset('public/frontend/assets/img/doctor/check.png')}}" alt="" />
                <p class="text">
                  {{@$why->heading_three}}
                </p>
              </div>
              <div class="lists">
                <img src="{{asset('public/frontend/assets/img/doctor/check.png')}}" alt="" />
                <p class="text">
                  {{@$why->heading_four}}
                </p>
              </div>
              <div class="lists">
                <img src="{{asset('public/frontend/assets/img/doctor/check.png')}}" alt="" />
                <p class="text">
                  {{@$why->heading_five}}
                </p>
              </div>
              <div class="lists">
                <img src="{{asset('public/frontend/assets/img/doctor/check.png')}}" alt="" />
                <p class="text">
                  {{@$why->heading_six}}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- -- Provider --  -->
    <div class="provider section-padding">
      <div class="max-theme-width">
        <h4 class="heading">become a provider</h4>
        <div class="provider-img-box">
          @foreach(@$provider as $value)
          <div class="provider-left-box">
            <img src="{{ URL::to('storage/app/public/provider_min')}}/{{@$value->image}}" alt="" />
          </div>
          @endforeach
          
        </div>
      </div>
    </div>

    <!-- -- Common --  -->
    <div class="common section-padding">
      <div class="max-theme-width">
        <div class="row display-flex align-items-center reverse">

          <div class="col-md-6 col-12 my-3">
            <div class="common-content">
              <h4 class="heading">
                {{@$common->heading}}
              </h4>
              <p class="para">
                {{@$common->description}}
              </p>
              <p>
                @if(Session::has('suggestion'))
                  <div class="alert alert-success alert-dismissible" style="text-align: center; margin-top: 10px;">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                      <strong>
                          {!!Session::get('suggestion')!!}
                      </strong>
                  </div>
              @endif


              @if(Session::has('prescription'))
                  <div class="alert alert-success alert-dismissible" style="text-align: center; margin-top: 10px;">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                      <strong>
                          {!!Session::get('prescription')!!}
                      </strong>
                  </div>
              @endif

              @if(Session::has('register'))
                  <div class="alert alert-success alert-dismissible" style="text-align: center; margin-top: 10px;">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                      <strong>
                          {!!Session::get('register')!!}
                      </strong>
                  </div>
              @endif
              </p>
              <div class="btn-div my-3">
                <button class="btn common-btn"><a href="#contact-section" class="provider_custom">Become a provider</a></button>

                @if(Auth::check())
                <button class="btn common-btn custom-button" data-toggle="modal" data-target="#exampleModal" >researches & outcomes</button>
                @else
                <button class="btn common-btn custom-button" data-toggle="modal" data-target="#register_model" >researches & outcome</button>
                @endif
              </div>
              <div class="btn-div my-3">
                <button class="btn common-btn">Products info</a> <img src="{{asset('public/frontend/assets/img/doctor/play.png')}}" alt=""></button>

                
               @if(Auth::check())
                <button class="btn common-btn" data-toggle="modal" data-target="#prescription_model">prescription</button>
                @else
                 <button class="btn common-btn" data-toggle="modal" data-target="#register_model">prescription</button>
                @endif
                
              </div>
            </div>
          </div>
          <div class="col-md-6 col-12 my-3">
            <div class="common-img">
              <img src="{{ URL::to('storage/app/public/common_min')}}/{{@$common->image}}" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- -- contact --  -->
   <div class="contact-us section-padding" id="contact-section">
      <div class="max-theme-width">
        <h4 class="heading">CONTACT US</h4>
        <p class="para">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi
          harum aliquid id, nam excepturi eum.
        </p>
        <form id="contact" method="post" action="{{route('contact.us.submit')}}">
          @csrf
        <div class="form-card">
          @include('admin.includes.message')
          <div class="row">
            <div class="col-md-6 col-12">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="First Name" name="first_name"

                />
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Last Name" name="last_name"
                />
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Phone Number"  name="phone_number"
                />
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Email" name="email" />
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="form-group">
                <textarea
                  rows="10"
                  class="form-control"
                  placeholder="Type your message here" name="comment"
                ></textarea>
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="captcha">
                <img src="./assets/img/home/contact/captcha.png" alt="" />
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="btn-div">
                <button class="btn btn-submit">SUBMIT</button>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>

    @include('includes.footer')



<div class="modal fade" id="prescription_model" tabindex="-1" role="dialog" aria-labelledby="prescription_id" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="prescription_id">Please Provide Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      @csrf  
      <div class="modal-body">
        <div class="modal-body">
         <form method="post" action="{{route('send.prescription')}}" enctype="multipart/form-data">
              @csrf
           <div class="form-card">
            @include('admin.includes.message')
             
            <div class="row">
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="First Name" name="first_name" required

                  />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Last Name" name="last_name" required
                  />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Phone Number"  name="phone_number" required
                  />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Email" name="email" required />
                </div>
              </div>
              <div class="col-md-12 col-12">
                <div class="form-group">
                  <textarea
                    rows="10"
                    class="form-control"
                    placeholder="Type your message here" name="comment" required
                  ></textarea>
                </div>
              </div>

              <div class="col-md-12 col-12">
                <div class="form-group">
                  <input type="file" class="form-control"  name="prescription" required />
                </div>
              </div>
        </div>
        </div>
        <div class="modal-footer">
          
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
      </form>
  </div>
</div>
</div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please give your suggestion/feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{route('send.suggestions')}}">
      @csrf  
      <div class="modal-body">
        <div class="col-md-12 col-12">
              <div class="form-group">
                <textarea
                  rows="10"
                  class="form-control"
                  placeholder="Type your suggestion/feedback here" name="suggestion" required
                ></textarea>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send Message</button>
      </div>
    </form>
    </div>
  </div>
</div>



{{-- LOGIN --}}

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginlable" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginlable">Login Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="window.location.reload();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{route('custom.login')}}" id="login_form">
      @csrf  
      <div class="modal-body">
         @if(Session::has('login_error'))
                  <div class="alert alert-success alert-dismissible" style="text-align: center; margin-top: 10px;">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                      <strong>
                          {!!Session::get('login_error')!!}
                      </strong>
                  </div>
              @endif
        
        <div class="col-md-12 col-12">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Email" name="email"  />
                </div>
              </div>

              <div class="col-md-12 col-12">
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
              </div>



      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
    </div>
  </div>
</div>


<div class="modal fade" id="register_model" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="register">Please register</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="window.location.reload();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      @csrf  
      <div class="modal-body">
        <div class="modal-body">
          <div class="modal-body">
           <div class="form-card">
            @include('admin.includes.message')
             <form method="post" action="{{route('custom.register')}}" enctype="multipart/form-data" id="register_form">
              @csrf
            <div class="row">
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="First Name" name="first_name" 

                  />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Last Name" name="last_name" 
                  />
                </div>
              </div>
              <div class="col-md-12 col-12">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Phone Number"  name="phone_number" 
                  />
                </div>
              </div>
              <div class="col-md-12 col-12">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Email" name="email" id="email" />
                </div>
              </div>

              <div class="col-md-12 col-12">
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="Password" name="password" id="password"  />
                </div>
              </div>

              <div class="col-md-12 col-12">
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="Cofirm Password" name="password_confirmation"  />
                </div>
              </div>
              
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <h5 style="font-size: 13px;">If you are a existing user.<a href="#" id="loginModal_button">Click Here To Login .</a></h5>
        <button type="submit" class="btn btn-primary">Register</button>
      </div>
    
    </div>
    </form>
  </div>
</div>








{{-- <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="prescription_model" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="prescription_model">Please Provide The Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="modal-body">
            <form method="post" action="{{route('send.prescription')}}" enctype="multipart/form-data">
              @csrf
           <div class="form-card">
            @include('admin.includes.message')
             
            <div class="row">
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="First Name" name="first_name" required

                  />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Last Name" name="last_name" required
                  />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Phone Number"  name="phone_number" required
                  />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Email" name="email" required />
                </div>
              </div>
              <div class="col-md-12 col-12">
                <div class="form-group">
                  <textarea
                    rows="10"
                    class="form-control"
                    placeholder="Type your message here" name="comment" required
                  ></textarea>
                </div>
              </div>

              <div class="col-md-12 col-12">
                <div class="form-group">
                  <input type="file" class="form-control"  name="prescription" required />
                </div>
              </div>
        </div>
        </div>
        <div class="modal-footer">
          
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
</div>
</div> --}}









@endsection
@section('script')
@include('includes.script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function(){
      jQuery.validator.addMethod("validate_email", function(value, element) {
            if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter your email properly");
       $("#contact").validate({
         rules: {
            first_name:{
                required:true,
            },
            last_name:{
                required:true,
            },
            email:{
                required:true,
                validate_email:true,
            },
            comment:{
                required:true,
            },
            phone_number:{
                required:true,
                // minlenght:10,
                // maxlenght:10,
            },
         },
            
        messages: {
            first_name:{
              required:'please enter first name',
            }, 
            last_name:{
              required:'Please enter last name',
            },
            email:{
              required:'Please enter email',
            },
            comment:{
              required:'Please enter comment',
            },
            phone_number:{
              required:'Please enter phone number',
            },
         },
      });
    })
</script>



<script>
    $(document).ready(function(){
      jQuery.validator.addMethod("validate_email", function(value, element) {
            if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter your email properly");
       $("#register_form").validate({
         rules: {
            first_name:{
                required:true,
            },
            last_name:{
                required:true,
            },
            email:{
                required:true,
                validate_email:true,
                remote: {
                          url:  '{{route('custom.register.check.mail')}}',
                          type: "POST",
                          data: {
                            email: function() {
                              return $( "#email").val() ;
                            },
                            _token: '{{ csrf_token() }}',
                          }
                   }
            },
            
            phone_number:{
                required:true,
            },
            password:{
                  required: true,
                  // minlength: 8
            },
            password_confirmation:{
                    required: true,
                    // minlength: 8,
                    equalTo: "#password"
            },
         },
            
        messages: {
            first_name:{
              required:'please enter first name',
            }, 
            last_name:{
              required:'Please enter last name',
            },
            email:{
              required:'Please enter email',
              remote:'Someone already used this email.Try another.'
            },
            comment:{
              required:'Please enter comment',
            },
            phone_number:{
              required:'Please enter phone number',
            },
         },
      });
    })
</script>


<script>
    $(document).ready(function(){
      jQuery.validator.addMethod("validate_email", function(value, element) {
            if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter your email properly");
       $("#login_form").validate({
         rules: {
            
            email:{
                required:true,
                validate_email:true,
            },
            
            password:{
                  required: true,
                  // minlength: 8
            },
            
         },
            
        messages: {
            
            email:{
              required:'Please enter email',
            },
            password:{
              required:'Please enter password',
            },
         },
      });
    })
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#loginModal_button').on('click',function(){
      $('#register_model').modal('hide');
      // alert('sayan');
      $('#loginModal').modal('show');
    });
  });
</script>


<script type="text/javascript">
  $(document).ready(function(){
     @if(Session::has('login_error'))
     $('#loginModal').modal('show');
     @endif
  })
</script>



@endsection
