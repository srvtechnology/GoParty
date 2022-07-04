@extends('layouts.app')

@section('title')
<title>Patient</title>
@endsection

@section('style')
@include('includes.style')
<style type="text/css">.error{color: red}</style>
</style> 
@endsection





@section('body')
    
    @section('header')
    @include('includes.header')
    @endsection

    <!-- -- banner --  -->
    <div class="banner"  style="background: url({{url('/')}}/storage/app/public/banner_min/{{$banner->image}});width: 100%;
  min-height: 65vh;
  margin-top: 80px;
  display: flex;
  
  background-position: top;
  background-size: cover;
  background-repeat: no-repeat;">
      <div class="max-theme-width">
          <div class="list-main my-auto">
            <div class="list-item">
              <img src="{{asset('public/frontend/assets/img/home/banner/check.png')}}" alt="" />
              <span>{{@$banner->heading_one}}</span>
            </div>
            <div class="list-item">
              <img src="{{asset('public/frontend/assets/img/home/banner/check.png')}}" alt="" />
              <span>{{@$banner->heading_two}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- -- Empowers patients --  -->
    <div class="empower-patient section-padding">
      <div class="max-theme-width">
        <div class="row display-flex align-items-center">
          <div class="col-md-6 col-12 my-3">
            <div class="left-img">
              <img
              src="{{ URL::to('storage/app/public/empower_min')}}/{{@$empower[0]->image}}"
              alt=""
            />
            </div>
          </div>
          <div class="col-md-6 col-12 my-3">
              <div class="content">
                <h4 class="heading">{{@$empower[0]->heading}}</h4>
                <p class="para">{{@$empower[0]->description}}</p>
              </div>
          </div>
        </div> 
        <div class="row reverse display-flex align-items-center my-3">
          <div class="col-md-6 col-12 my-3">
              <div class="content">
                <h4 class="heading">{{@$empower[1]->heading}}</sup></h4>
                <p class="para">{{@$empower[1]->description}}</p>
              </div>
          </div>
          <div class="col-md-6 col-12 my-3">
            <div class="right-img">
              <img src="{{ URL::to('storage/app/public/empower_min')}}/{{@$empower[1]->image}}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- -- Common Uses --  -->
    <div class="common-uses section-padding">
      <div class="max-theme-width">
        <h4 class="heading">Common Uses for AactivArmor<sup>TM</sup></h4> 
        <div class="main-lists">
          <div class="row">
            @foreach(@$uses as $value)
            <div class="col-md-6 col-12">
              <div class="lists">
                <img src="{{asset('public/frontend/assets/img/patients/check.png')}}" alt="">
                <p class="text">{{@$value->title}}</p>
              </div>
            </div>
            @endforeach
            
          </div>
        </div>
      </div>
    </div>

   <!-- -- contact --  -->
   <div class="contact-us section-padding">
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
    <!-- -- footer --  -->
   @include('includes.footer')
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
@endsection