<!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />

    <!-- -- Icon CDN --  -->
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
      crossorigin="anonymous"
    />

    @if(Route::is('index'))
    
    <link href="{{ URL::to('public/frontend/assets/css/index.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('public/frontend/assets/css/main.css')}}" rel="stylesheet" type="text/css">

    @endif

    @if(Route::is('patient.page'))
  
    <link href="{{ URL::to('public/frontend/assets/css/index.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('public/frontend/assets/css/main.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('public/frontend/assets/css/doctor.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('public/frontend/assets/css/patients.css')}}" rel="stylesheet" type="text/css">
    @endif

    @if(Route::is('doctor.page'))
    <link href="{{ URL::to('public/frontend/assets/css/main.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('public/frontend/assets/css/doctor.css')}}" rel="stylesheet" type="text/css">
    


    @endif

    @if(Route::is('contact.page'))
    <link href="{{ URL::to('public/frontend/assets/css/main.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('public/frontend/assets/css/contact.css')}}" rel="stylesheet" type="text/css">
    @endif
     