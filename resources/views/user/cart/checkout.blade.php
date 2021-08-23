@extends('user.layouts.master')
@section('title', __('Checkout - '.TITLE_CORE))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/master.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/checkout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/checkout_responsive.css')}}">
@endsection
@section('content')

    <!-- Home -->

    <div class="home">
        <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{asset('assets/images/categories.jpg')}}" data-speed="0.8"></div>
        <div class="home_container">
            <div class="home_content">
                <div class="home_title">Checkout</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('cart')}}">Cart</a></li>
                        <li>Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout -->

    <div class="checkout">
        <div class="section_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="checkout_container d-flex flex-xxl-row flex-column align-items-start justify-content-start">

                            <!-- Billing -->
                            <div class="billing checkout_box">
                                <div class="checkout_title">Billing Address</div>
                                <div class="checkout_form_container">
                                    {{ Form::open(['route' => 'order.placeOrder', 'method' => 'post', 'id' => 'checkout_form', 'class' => 'checkout_form']) }}
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <!-- Name -->
                                                <label for="checkout_name">First Name <span class="text-danger">*</span></label>
                                                <input type="text" name="first_name" id="checkout_name" class="checkout_input" @if(is_null(old('first_name'))) value="{{$user->first_name}}" @else value="{{old('first_name')}}" @endif required="required">
                                            </div>
                                            <div class="col-lg-6">
                                                <!-- Last Name -->
                                                <label for="checkout_last_name">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" name="last_name" id="checkout_last_name" class="checkout_input" @if(is_null(old('last_name'))) value="{{$user->last_name}}" @else value="{{old('last_name')}}" @endif required="required">
                                            </div>
                                        </div>
                                        <div>
                                            <!-- Country -->
                                            <label for="checkout_country">Country <span class="text-danger">*</span></label>
                                            <input type="text" name="country" id="checkout_country" class="checkout_input" @if(is_null(old('country'))) value="{{$user->country}}" @else value="{{old('country')}}" @endif required="required">
                                        </div>
                                        <div>
                                            <!-- Address -->
                                            <label for="checkout_address">Address <span class="text-danger">*</span></label>
                                            <input type="text" name="address" id="checkout_address" class="checkout_input" @if(is_null(old('address'))) value="{{$user->address}}" @else value="{{old('address')}}" @endif required="required">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <!-- Zipcode -->
                                                <label for="checkout_zipcode">Zipcode <span class="text-danger">*</span></label>
                                                <input type="text" name="zip_code" id="checkout_zipcode" class="checkout_input" @if(is_null(old('zip_code'))) value="{{$user->zip_code}}" @else value="{{old('zip_code')}}" @endif required="required">
                                            </div>
                                            <div class="col-lg-8">
                                                <!-- City / Town -->
                                                <label for="checkout_city">City/Town <span class="text-danger">*</span></label>
                                                <input type="text" name="city" id="checkout_city" class="checkout_input" @if(is_null(old('city'))) value="{{$user->city}}" @else value="{{old('city')}}" @endif required="required">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <!-- Phone Code -->
                                                <label for="checkout_phone">Phone Code <span class="text-danger">*</span></label>
                                                <input type="phone" name="phone_code" id="checkout_phone" class="checkout_input" @if(is_null(old('phone_code'))) value="{{$user->phone_code}}" @else value="{{old('phone_code')}}" @endif required="required">
                                            </div>
                                            <div class="col-lg-8">
                                                <!-- Phone no -->
                                                <label for="checkout_phone">Phone No <span class="text-danger">*</span></label>
                                                <input type="phone" name="phone" id="checkout_phone" class="checkout_input" @if(is_null(old('phone'))) value="{{$user->phone}}" @else value="{{old('phone')}}" @endif required="required">
                                            </div>
                                        </div>
                                        <div>
                                            <!-- Email -->
                                            <label for="checkout_email">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" name="email" id="checkout_email" class="checkout_input" @if(is_null(old('email'))) value="{{$user->email}}" @else value="{{old('email')}}" @endif required="required">
                                        </div>
                                        <div class="checkout_extra">
                                            <ul>
{{--                                                @if (wallet()->amount>=1)--}}
                                                    <li class="billing_info d-flex flex-row align-items-center justify-content-start">
                                                        <label class="checkbox_container">
                                                            <input type="checkbox" id="cb_2" name="wallet_payment_checkbox" class="billing_checkbox">
                                                            <span class="checkbox_mark"></span>
                                                            <span class="checkbox_text">Apply Wallet Payment</span>
                                                        </label>
                                                    </li>
{{--                                                @endif--}}
                                                <li class="billing_info d-flex flex-row align-items-center justify-content-start">
                                                    <label class="checkbox_container">
                                                        <input type="checkbox" id="cb_1" name="tc_checkbox" class="billing_checkbox">
                                                        <span class="checkbox_mark"></span>
                                                        <span class="checkbox_text">Terms and conditions <span class="text-danger">*</span></span>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="hidden">
                                            <input type="number" name="coupon" min="0" step="0.01" value="0">
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            </div>

                            <!-- Cart Total -->
                            <div class="cart_total">
                                <div class="cart_total_inner checkout_box">
                                    <div class="checkout_title">Cart total</div>
                                    <ul class="cart_extra_total_list">
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="cart_extra_total_title">Subtotal</div>
                                            <div class="cart_extra_total_value ml-auto">৳ {{cart()->price}}</div>
                                        </li>
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="cart_extra_total_title">Coupon</div>
                                            <div class="cart_extra_total_value ml-auto">৳ 0</div>
                                        </li>
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="cart_extra_total_title">Total</div>
                                            <div class="cart_extra_total_value ml-auto">৳ {{cart()->price}}</div>
                                        </li>
                                    </ul>

                                    <div class="row">
                                        <!-- Payment Options -->
                                        <div class="payment col-md-6 col-sm-12">
                                            <div class="cart_extra_title">Payment</div>
                                            <div class="payment_options">
                                                <label class="payment_option clearfix">bKash
                                                    <input type="radio" name="radio" checked>
                                                    <span class="checkmark"></span>
                                                </label>
{{--                                                <label class="payment_option clearfix">Cash on delivery--}}
{{--                                                    <input type="radio" name="radio">--}}
{{--                                                    <span class="checkmark"></span>--}}
{{--                                                </label>--}}
{{--                                                <label class="payment_option clearfix">Credit card--}}
{{--                                                    <input type="radio" name="radio">--}}
{{--                                                    <span class="checkmark"></span>--}}
{{--                                                </label>--}}
{{--                                                <label class="payment_option clearfix">Direct bank transfer--}}
{{--                                                    <input type="radio" checked="checked" name="radio">--}}
{{--                                                    <span class="checkmark"></span>--}}
{{--                                                </label>--}}
                                            </div>
                                        </div>
                                        <div class="shipping col-md-6 col-sm-12">
                                            <div class="cart_extra_title">Shipping</div>
                                            <ul>
                                                <li class="shipping_option d-flex flex-row align-items-center justify-content-start">
                                                    <label class="radio_container">
                                                        <input type="radio" id="radio_1" name="shipping_radio" class="shipping_radio" checked>
                                                        <span class="radio_mark"></span>
                                                        <span class="radio_text">SA Paribahan</span>
                                                    </label>
{{--                                                    <div class="shipping_price ml-auto">$4.99</div>--}}
                                                </li>
{{--                                                <li class="shipping_option d-flex flex-row align-items-center justify-content-start">--}}
{{--                                                    <label class="radio_container">--}}
{{--                                                        <input type="radio" id="radio_2" name="shipping_radio" class="shipping_radio">--}}
{{--                                                        <span class="radio_mark"></span>--}}
{{--                                                        <span class="radio_text">Standard delivery</span>--}}
{{--                                                    </label>--}}
{{--                                                    <div class="shipping_price ml-auto">$1.99</div>--}}
{{--                                                </li>--}}
{{--                                                <li class="shipping_option d-flex flex-row align-items-center justify-content-start">--}}
{{--                                                    <label class="radio_container">--}}
{{--                                                        <input type="radio" id="radio_3" name="shipping_radio" class="shipping_radio" checked>--}}
{{--                                                        <span class="radio_mark"></span>--}}
{{--                                                        <span class="radio_text">Personal Pickup</span>--}}
{{--                                                    </label>--}}
{{--                                                    <div class="shipping_price ml-auto">Free</div>--}}
{{--                                                </li>--}}
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Order Text -->
                                    <div class="order_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra temp or so dales. Phasellus sagittis auctor gravida. Integ er bibendum sodales arcu id te mpus. Ut consectetur lacus.</div>

                                    <div class="checkout_button trans_200"><button class="btn" id="place-order-button">place order</button></div>
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
    <script src="{{asset('assets/js/checkout.js')}}"></script>
    <script>
        $('.hidden').hide();
        $(document).ready(function () {
            $('#place-order-button').on('click', function () {
                $('#checkout_form').submit();
            });
        });
    </script>
@endsection
