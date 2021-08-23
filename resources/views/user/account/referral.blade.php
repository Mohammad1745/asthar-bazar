@extends('user.layouts.master')
@section('title', __('Referrals - '.TITLE_CORE))
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
                <div class="home_title">Referral</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('account')}}">Account</a></li>
                        <li>Referral</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Referrals -->

    <div class="main_section" style="padding-top: 100px;">

        <div class="section_container">
            <div class="container">
                <div class="row">

                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Referral</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Referral Code</div>
                                        <div class="main_extra_total_value ml-auto">
                                            @if(isset($referralCode)) <span title="Click to Copy" class="copy-button cursor-pointer">{{$referralCode->code}}</span>
                                            @else <a href="{{route('account.generateReferralCode')}}">Generate Code</a>
                                            @endif
                                        </div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">My Referrals</div>
                                        <div class="main_extra_total_value ml-auto">{{$referralUsersCount}}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section_container" style="margin-top: 100px;">
            <div class="container">
                <div class="row">

                    <!-- Description -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Why?</div>
                                <div class="main_extra_total_title text-justify mt-5">
                                    Anyone registered with your referral code will be your referral. Whenever he/she purchases any thing from us, you will
                                    receive a portion of our profit as you have helped us to reach that person. You will receive that on your <a href="" class="text-uppercase">wallet</a>.
                                    You may purchase our product with that.
                                    <br><br><span>কেন?</span>
                                    <spna class="bengali-content"><br>
                                        আপনার রেফারেল কোড ব্যাবহার করে কেউ রেজিস্ট্রেশন করলে তিনি আপনার রেফারেল হবে। তিনি আমাদের থেকে কোন জিনিস কিনলে আমাদের প্রফিটের একটি অংশ
                                        আপনি পাবেন যেহেতু আপনার মাধ্যমে তিনি আমাদের সাথে যুক্ত হয়েছেন।এটা আপনার <a href="" class="text-uppercase">wallet</a> এ জমা হবে।
                                        পরবর্তিতে আপনি তা ব্যাবহার করে আমাদের থেকে কেনা কাটা করতে পারবেন।
                                    </spna>
                                </div>
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
    <script>
        $('document').ready(function () {
            //Copy to clipboard
            $('.copy-button').on('click', function () {
                let $temp = $("<input>");
                $("body").append($temp);
                $temp.val($(this).text()).select();
                document.execCommand("copy");
                $temp.remove();
                alert('Copied to clipboard!');
            });
        });
    </script>
@endsection
