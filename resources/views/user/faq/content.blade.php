@extends('user.layouts.master')
@section('title', __($faq_title.' - '.TITLE_CORE))
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
                <div class="home_title">{{$faq_title}}</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li>FAQ</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart -->

    <div class="main_section">

        <div class="section_container content-toggle-0">
            <div class="container">
                <div class="row">
                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">{{$faq_title}}</div>
                                <ul class="main_extra_total_list">
                                    <li class="main_extra_total_value ml-auto text-justify">
                                        <div class="main_extra_total_title">{{$faq}}<br><br><span class="cursor-pointer" id="translate-button">অনুবাদ করুন</span></div>
                                    </li>
                                    <li  id="translation" class="main_extra_total_value ml-auto text-justify">
                                        <div class="main_extra_total_title">{{$faqBn}}</div>
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
    <script src="{{asset('assets/js/news_details.js')}}"></script>
    <script>
        $('#translation').hide();
        $(document).ready(function (){
            $('#translate-button').on('click', function () {
                $('#translate-button').hide();
                $('#translation').fadeIn();
            });
        });
    </script>
@endsection
