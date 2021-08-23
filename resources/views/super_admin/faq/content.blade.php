@extends('super_admin.layouts.master')
@section('title', __('FAQ - '.TITLE_CORE))
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
                <div class="home_title">FAQ</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('superAdmin.dashboard')}}">Dashboard</a></li>
                        <li>FAQ</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ -->

    <div class="main_section">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Product -->
                    <div class="col">
                        <div class="main_container">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">FAQ</div>
                                <div class="main_form_container">
                                    {{ Form::open(['route' => 'superAdmin.faq.update', 'method' => 'post', 'files' => 'true', 'id' => 'faq_form', 'class' => 'main_form']) }}
                                    <div>
                                        <!-- About Us -->
                                        <label for="about_us">About Us <span class="text-danger"></span></label>
                                        <textarea name="about_us" id="about_us" class="main_input" cols="30" rows="10" required="required">@if(!is_null(old('about_us'))){{old('about_us')}}@elseif(isset($faq['about_us'])){{$faq['about_us']}}@else{{''}}@endif</textarea>
                                    </div>
                                    <div>
                                        <!-- About Us -->
                                        <label for="about_us_bn">বাংলা <span class="text-danger"></span></label>
                                        <textarea name="about_us_bn" id="about_us_bn" class="main_input" cols="30" rows="10" required="required">@if(!is_null(old('about_us_bn'))){{old('about_us_bn')}}@elseif(isset($faq['about_us_bn'])){{$faq['about_us_bn']}}@else{{''}}@endif</textarea>
                                    </div>
                                    <div>
                                        <!-- Offerings -->
                                        <label for="offerings">Offerings <span class="text-danger"></span></label>
                                        <textarea name="offerings" id="offerings" class="main_input" cols="30" rows="10" required="required">@if(!is_null(old('offerings'))){{old('offerings')}}@elseif(isset($faq['offerings'])){{$faq['offerings']}}@else{{''}}@endif</textarea>
                                    </div>
                                    <div>
                                        <!-- Offerings -->
                                        <label for="offerings_bn">বাংলা <span class="text-danger"></span></label>
                                        <textarea name="offerings_bn" id="offerings_bn" class="main_input" cols="30" rows="10" required="required">@if(!is_null(old('offerings_bn'))){{old('offerings_bn')}}@elseif(isset($faq['offerings_bn'])){{$faq['offerings_bn']}}@else{{''}}@endif</textarea>
                                    </div>
                                    <div>
                                        <!-- Payment Information -->
                                        <label for="payment_information">Payment Information <span class="text-danger"></span></label>
                                        <textarea name="payment_information" id="payment_information" class="main_input" cols="30" rows="10" required="required">@if(!is_null(old('payment_information'))){{old('payment_information')}}@elseif(isset($faq['payment_information'])){{$faq['payment_information']}}@else{{''}}@endif</textarea>
                                    </div>
                                    <div>
                                        <!-- Payment Information -->
                                        <label for="payment_information_bn">বাংলা <span class="text-danger"></span></label>
                                        <textarea name="payment_information_bn" id="payment_information_bn" class="main_input" cols="30" rows="10" required="required">@if(!is_null(old('payment_information_bn'))){{old('payment_information_bn')}}@elseif(isset($faq['payment_information_bn'])){{$faq['payment_information_bn']}}@else{{''}}@endif</textarea>
                                    </div>
                                    <div>
                                        <!-- Delivery Information -->
                                        <label for="delivery_information">Delivery Information <span class="text-danger"></span></label>
                                        <textarea name="delivery_information" id="delivery_information" class="main_input" cols="30" rows="10" required="required">@if(!is_null(old('delivery_information'))){{old('delivery_information')}}@elseif(isset($faq['delivery_information'])){{$faq['delivery_information']}}@else{{''}}@endif</textarea>
                                    </div>
                                    <div>
                                        <!-- Delivery Information -->
                                        <label for="delivery_information_bn">বাংলা <span class="text-danger"></span></label>
                                        <textarea name="delivery_information_bn" id="delivery_information_bn" class="main_input" cols="30" rows="10" required="required">@if(!is_null(old('delivery_information_bn'))){{old('delivery_information_bn')}}@elseif(isset($faq['delivery_information_bn'])){{$faq['delivery_information_bn']}}@else{{''}}@endif</textarea>
                                    </div>
                                    <div>
                                        <!-- Order Guideline -->
                                        <label for="order_guideline">Order Guideline <span class="text-danger"></span></label>
                                        <textarea name="order_guideline" id="order_guideline" class="main_input" cols="30" rows="10" required="required">@if(!is_null(old('order_guideline'))){{old('order_guideline')}}@elseif(isset($faq['order_guideline'])){{$faq['order_guideline']}}@else{{''}}@endif</textarea>
                                    </div>
                                    <div>
                                        <!-- Order Guideline -->
                                        <label for="order_guideline_bn">বাংলা <span class="text-danger"></span></label>
                                        <textarea name="order_guideline_bn" id="order_guideline_bn" class="main_input" cols="30" rows="10" required="required">@if(!is_null(old('order_guideline_bn'))){{old('order_guideline_bn')}}@elseif(isset($faq['order_guideline_bn'])){{$faq['order_guideline_bn']}}@else{{''}}@endif</textarea>
                                    </div>
                                    <div>
                                        <!-- Terms & Conditions -->
                                        <label for="terms_and_conditions">Terms & Conditions <span class="text-danger"></span></label>
                                        <textarea name="terms_and_conditions" id="terms_and_conditions" class="main_input" cols="30" rows="10" required="required">@if(!is_null(old('terms_and_conditions'))){{old('terms_and_conditions')}}@elseif(isset($faq['terms_and_conditions'])){{$faq['terms_and_conditions']}}@else{{''}}@endif</textarea>
                                    </div>
                                    <div>
                                        <!-- Terms & Conditions -->
                                        <label for="terms_and_conditions_bn">বাংলা <span class="text-danger"></span></label>
                                        <textarea name="terms_and_conditions_bn" id="terms_and_conditions_bn" class="main_input" cols="30" rows="10" required="required">@if(!is_null(old('terms_and_conditions_bn'))){{old('terms_and_conditions_bn')}}@elseif(isset($faq['terms_and_conditions_bn'])){{$faq['terms_and_conditions_bn']}}@else{{''}}@endif</textarea>
                                    </div>
                                    <div>
                                        <!-- Privacy Policy -->
                                        <label for="privacy_policy">Privacy Policy <span class="text-danger"></span></label>
                                        <textarea name="privacy_policy" id="privacy_policy" class="main_input" cols="30" rows="10" required="required">@if(!is_null(old('privacy_policy'))){{old('privacy_policy')}}@elseif(isset($faq['privacy_policy'])){{$faq['privacy_policy']}}@else{{''}}@endif</textarea>
                                    </div>
                                    <div>
                                        <!-- Privacy Policy -->
                                        <label for="privacy_policy_bn">বাংলা <span class="text-danger"></span></label>
                                        <textarea name="privacy_policy_bn" id="privacy_policy_bn" class="main_input" cols="30" rows="10" required="required">@if(!is_null(old('privacy_policy_bn'))){{old('privacy_policy_bn')}}@elseif(isset($faq['privacy_policy_bn'])){{$faq['privacy_policy_bn']}}@else{{''}}@endif</textarea>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <!-- Product Buttons -->
                            <div class="main_buttons d-flex flex-row align-items-start justify-content-start" style="margin-top: 32px;">
                                <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                    <div class="button button_update trans_200 cursor-pointer" id="submit-faq-button"><span>Save</span></div>
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
    <script src="{{asset('assets/js/variation.js')}}"></script>
    <script type='text/javascript' src='{{ asset('assets/plugins/dropify/dropify.min.js') }}'></script>
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#submit-faq-button').on('click', function () {
                $('#faq_form').submit();
            });
        });
    </script>
@endsection
