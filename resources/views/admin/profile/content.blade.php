@extends('admin.layouts.master')
@section('title', __('Profile - '.TITLE_CORE))
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
                <div class="home_title">Profile</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('admin.account')}}">Account</a></li>
                        <li>Profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile -->

    <div class="main_section">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Profile -->
                    <div class="col">
                        <div class="main_container">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Profile</div>
                                <ul class="main_extra_total_list content-toggle-0">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Name</div>
                                        <div class="main_extra_total_value ml-auto">{{$user->first_name.' '.$user->last_name}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Username</div>
                                        <div class="main_extra_total_value ml-auto">{{$user->username}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Email</div>
                                        <div class="main_extra_total_value ml-auto">{{$user->email}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Phone</div>
                                        <div class="main_extra_total_value ml-auto">{{$user->phone_code.$user->phone}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Address</div>
                                        <div class="main_extra_total_value ml-auto">{{$user->address}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Zip Code</div>
                                        <div class="main_extra_total_value ml-auto">{{$user->zip_code}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">City</div>
                                        <div class="main_extra_total_value ml-auto">{{$user->city}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Country</div>
                                        <div class="main_extra_total_value ml-auto">{{$user->country}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Joined</div>
                                        <div class="main_extra_total_value ml-auto">{{dateOf($user->created_at)}}</div>
                                    </li>
                                </ul>
                                <div class="main_form_container content-toggle-1">
                                    {{ Form::open(['route' => 'admin.profile.update', 'method' => 'post', 'id' => 'profile_form', 'class' => 'main_form']) }}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <!-- Name -->
                                            <label for="checkout_name">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" id="checkout_name" class="main_input" @if(is_null(old('first_name'))) value="{{$user->first_name}}" @else value="{{old('first_name')}}" @endif required="required">
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Last Name -->
                                            <label for="checkout_last_name">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name" id="checkout_last_name" class="main_input" @if(is_null(old('last_name'))) value="{{$user->last_name}}" @else value="{{old('last_name')}}" @endif required="required">
                                        </div>
                                    </div>
                                    <div>
                                        <!-- Country -->
                                        <label for="checkout_country">Country <span class="text-danger">*</span></label>
                                        <input type="text" name="country" id="checkout_country" class="main_input" @if(is_null(old('country'))) value="{{$user->country}}" @else value="{{old('country')}}" @endif required="required">
                                    </div>
                                    <div>
                                        <!-- Address -->
                                        <label for="checkout_address">Address <span class="text-danger">*</span></label>
                                        <input type="text" name="address" id="checkout_address" class="main_input" @if(is_null(old('address'))) value="{{$user->address}}" @else value="{{old('address')}}" @endif required="required">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <!-- Zipcode -->
                                            <label for="checkout_zipcode">Zipcode <span class="text-danger">*</span></label>
                                            <input type="text" name="zip_code" id="checkout_zipcode" class="main_input" @if(is_null(old('zip_code'))) value="{{$user->zip_code}}" @else value="{{old('zip_code')}}" @endif required="required">
                                        </div>
                                        <div class="col-lg-8">
                                            <!-- City / Town -->
                                            <label for="checkout_city">City/Town <span class="text-danger">*</span></label>
                                            <input type="text" name="city" id="checkout_city" class="main_input" @if(is_null(old('city'))) value="{{$user->city}}" @else value="{{old('city')}}" @endif required="required">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <!-- Phone Code -->
                                            <label for="checkout_phone">Phone Code <span class="text-danger">*</span></label>
                                            <input type="phone" name="phone_code" id="checkout_phone" class="main_input" @if(is_null(old('phone_code'))) value="{{$user->phone_code}}" @else value="{{old('phone_code')}}" @endif required="required">
                                        </div>
                                        <div class="col-lg-8">
                                            <!-- Phone no -->
                                            <label for="checkout_phone">Phone No <span class="text-danger">*</span></label>
                                            <input type="phone" name="phone" id="checkout_phone" class="main_input" @if(is_null(old('phone'))) value="{{$user->phone}}" @else value="{{old('phone')}}" @endif required="required">
                                        </div>
                                    </div>
                                    <div>
                                        <!-- Email -->
                                        <label for="checkout_email">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="checkout_email" class="main_input" @if(is_null(old('email'))) value="{{$user->email}}" @else value="{{old('email')}}" @endif required="required">
                                    </div>
                                    {{ Form::close() }}
                                </div>
                                <div class="main_form_container content-toggle-2">
                                    {{ Form::open(['route' => 'admin.profile.updatePassword', 'method' => 'post', 'id' => 'password_form', 'class' => 'main_form']) }}
                                    <div>
                                        <!-- Password -->
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" class="main_input" required="required">
                                    </div>
                                    <div>
                                        <!-- Confirm Password -->
                                        <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="main_input" required="required">
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <!-- Profile Buttons -->
                            <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                                <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                    <div class="button button_update trans_200 content-toggle-0 cursor-pointer" id="update-profile-button"><span>Update Profile</span></div>
                                    <div class="button button_update trans_200 content-toggle-0 cursor-pointer" id="change-password-button"><span>Change Password</span></div>
                                    <div class="button button_continue trans_200 content-toggle-1 content-toggle-2 cursor-pointer" id="cancel-form-button"><span>Cancel</span></div>
                                    <div class="button button_update trans_200 content-toggle-1 cursor-pointer" id="submit-profile-button"><span>Save</span></div>
                                    <div class="button button_update trans_200 content-toggle-2 cursor-pointer" id="submit-password-button"><span>Save</span></div>
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
    <script src="{{asset('assets/js/profile.js')}}"></script>
    <script>
        $('.content-toggle-1').hide();
        $('.content-toggle-2').hide();
        $(document).ready(function () {
            $('#update-profile-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
            });
            $('#change-password-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-2').show();
                $('.profile_extra_title').html('Change Password');
            });
            $('#cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-profile-button').on('click', function () {
                $('#profile_form').submit();
            });
            $('#submit-password-button').on('click', function () {
                $('#password_form').submit();
            });
        });
    </script>
@endsection
