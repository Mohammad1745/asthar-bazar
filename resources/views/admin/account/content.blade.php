@extends('admin.layouts.master')
@section('title', __('Account - '.TITLE_CORE))
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
                <div class="home_title">Account</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li>Account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart -->

    <div class="main_section">

        <div class="section_container">
            <div class="container">
                <div class="row">

                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Account</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="{{route('admin.profile')}}">Profile</a></div>
                                        <div class="main_extra_total_value ml-auto">{{$profilePercentage}}%</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="{{route('admin.account.transactions')}}">Transactions</a></div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$revenue}}</div>
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
