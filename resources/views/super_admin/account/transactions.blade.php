@extends('super_admin.layouts.master')
@section('title', __('Transactions - '.TITLE_CORE))
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
                <div class="home_title">Transactions</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('superAdmin.account')}}">Account</a></li>
                        <li>Transactions</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions -->

    <div class="main_section">

        <div class="section_container">
            <div class="container">
                <div class="row">

                    <!-- Details -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Transactions</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Revenue</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$transactions['revenue']}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Revenue(Wallet)</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$transactions['revenue_from_wallet']}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Manufacturing Cost</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$transactions['manufacturing_cost']}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Profit</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$transactions['profit']}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Customer Reward</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$transactions['customer_reward']}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Net Profit</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$transactions['net_profit']}}</div>
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
