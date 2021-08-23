@extends('super_admin.layouts.master')
@section('title', __('Dashboard - '.TITLE_CORE))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/master.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/content.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/content_responsive.css')}}">
@endsection
@section('content')

    <!-- Home -->

    <div class="home">
        <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{asset('assets/images/categories.jpg')}}" data-speed="0.8"></div>
        <div class="home_container">
            <div class="home_content">
                <div class="home_title">Dashboard</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li>Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard -->

    <div class="main_section">

        <div class="section_container">
            <div class="container">
                <div class="row">

                    <!-- Content -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Dashboard</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="">User</a></div>
                                        <div class="main_extra_total_value ml-auto">10 (demo)</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="">Department</a></div>
                                        <div class="main_extra_total_value ml-auto">10 (demo)</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="">Orders</a></div>
                                        <div class="main_extra_total_value ml-auto">10 (demo)</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="">Products</a></div>
                                        <div class="main_extra_total_value ml-auto">10 (demo)</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="">Sale Record</a></div>
                                        <div class="main_extra_total_value ml-auto">10 (demo)</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="">Revenue</a></div>
                                        <div class="main_extra_total_value ml-auto">৳ 10 (demo)</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/account.js')}}"></script>
@endsection
