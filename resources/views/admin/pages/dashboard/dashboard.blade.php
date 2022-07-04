@extends('admin.layouts.app')
@section('title')
    <title>Admin | Dashboard</title>
@endsection
@section('left_part')
    @include('admin.include.left_part')
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
                                    <h2 class="breadcrumb_title">Hello, {{ Auth::guard('admin')->user()->name }}!</h2>
                                    <p>Ready to jump back in!</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="ff_one">
                                    <div class="icon"><span class="flaticon-house"></span></div>
                                    <div class="detais">
                                        <div class="timer">15</div>
                                        <h4>My Properties</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="ff_one">
                                    <div class="icon"><span class="flaticon-view"></span></div>
                                    <div class="detais">
                                        <div class="timer">22</div>
                                        <h4>Total Views</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="ff_one">
                                    <div class="icon"><span class="flaticon-mail-inbox-app"></span></div>
                                    <div class="detais">
                                        <div class="timer">921</div>
                                        <h4>Inbox</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="ff_one">
                                    <div class="icon"><span class="flaticon-heartbeat"></span></div>
                                    <div class="detais">
                                        <div class="timer">148</div>
                                        <h4>Total Favorites</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-8">
                                <div class="application_statics">
                                    <h4>Total Views</h4>
                                    <canvas id="myChartweave" width="100" height="50"></canvas>
                                    <canvas class="dn" id="myChart"></canvas>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="recent_job_activity">
                                    <h4 class="title">Recent Activities</h4>
                                    <div class="grid">
                                        <ul>
                                            <li class="list-inline-item">
                                                <div class="icon"><span class="flaticon-house"></span></div>
                                            </li>
                                            <li class="list-inline-item">
                                                <p>Your listing <span class="text-thm">Luxury Family Home</span> has
                                                    been approved!.</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="grid">
                                        <ul>
                                            <li class="list-inline-item">
                                                <div class="icon"><span class="flaticon-house"></span></div>
                                            </li>
                                            <li class="list-inline-item">
                                                <p>Kathy Brown left a review on <span class="text-thm">Renovated
                                                        Apartment</span></p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="grid">
                                        <ul>
                                            <li class="list-inline-item">
                                                <div class="icon"><span class="flaticon-house"></span></div>
                                            </li>
                                            <li class="list-inline-item">
                                                <p>Someone favorites your <span class="text-thm">Gorgeous Villa
                                                        Bay</span> View listing!</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="grid">
                                        <ul>
                                            <li class="list-inline-item">
                                                <div class="icon"><span class="fa fa-heart-o"></span></div>
                                            </li>
                                            <li class="list-inline-item">
                                                <p>Your listing <span class="text-thm">Luxury Family Home</span> has
                                                    been approved!.</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="grid">
                                        <ul>
                                            <li class="list-inline-item">
                                                <div class="icon"><span class="flaticon-house"></span></div>
                                            </li>
                                            <li class="list-inline-item">
                                                <p>Kathy Brown left a review on <span class="text-thm">Renovated
                                                        Apartment</span></p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="grid">
                                        <ul>
                                            <li class="list-inline-item">
                                                <div class="icon"><span class="flaticon-house"></span></div>
                                            </li>
                                            <li class="list-inline-item">
                                                <p>Someone favorites your <span class="text-thm">Gorgeous Villa
                                                        Bay</span> View listing!</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="grid mb0">
                                        <ul class="pb0 mb0 bb_none">
                                            <li class="list-inline-item">
                                                <div class="icon"><span class="flaticon-house"></span></div>
                                            </li>
                                            <li class="list-inline-item">
                                                <p>Your listing <span class="text-thm">Luxury Family Home</span> has
                                                    been approved!.</p>
                                            </li>
                                        </ul>
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
@include('admin.include.script')
@endsection
