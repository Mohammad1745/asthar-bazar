@extends('super_admin.layouts.master')
@section('title', __('User Details - '.TITLE_CORE))
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
                <div class="home_title">{{$userDetail->title}}</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('superAdmin.dashboard')}}">Dashboard</a></li>
                        <li><a href="{{route('superAdmin.user')}}">User</a></li>
                        <li>Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- User -->

    <div class="main_section">

        <div class="section_container content-toggle-0">
            <div class="container">
                <div class="row">

                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">User - {{userRoll($userDetail->role)}}</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Name</div>
                                        <div class="main_extra_total_value ml-auto">{{$userDetail->first_name.' '.$userDetail->last_name}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Username</div>
                                        <div class="main_extra_total_value ml-auto">{{$userDetail->username}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Email</div>
                                        <div class="main_extra_total_value ml-auto">{{$userDetail->email}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Phone</div>
                                        <div class="main_extra_total_value ml-auto">{{$userDetail->phone_code.$userDetail->phone}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Address</div>
                                        <div class="main_extra_total_value ml-auto">{{$userDetail->address}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Zip Code</div>
                                        <div class="main_extra_total_value ml-auto">{{$userDetail->zip_code}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">City</div>
                                        <div class="main_extra_total_value ml-auto">{{$userDetail->city}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Country</div>
                                        <div class="main_extra_total_value ml-auto">{{$userDetail->country}}</div>
                                    </li>
                                    @if ($userDetail->role==USER_ROLE)
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="main_extra_total_title">Wallet Capacity</div>
                                            <div class="main_extra_total_value ml-auto">{{$userDetail->wallet_capacity}}</div>
                                        </li>
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="main_extra_total_title">Wallet Amount</div>
                                            <div class="main_extra_total_value ml-auto">৳ {{$userDetail->wallet_amount}}</div>
                                        </li>
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="main_extra_total_title">Wallet Expires</div>
                                            <div class="main_extra_total_value ml-auto">{{$userDetail->wallet_expires_at}}</div>
                                        </li>
                                    @endif
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Joined</div>
                                        <div class="main_extra_total_value ml-auto">{{dateOf($userDetail->created_at)}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Status</div>
                                        <div class="main_extra_total_value ml-auto">{{userStatus($userDetail->verification_status)}}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Buttons -->
                <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                    <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                        <div class="button button_continue trans_200" id="update-user-button"><span class="cursor-pointer">Update</span></div>
                        @if ($userDetail->role!=SUPER_ADMIN_ROLE)
                            @if ($userDetail->verification_status==USER_DELETE_STATUS)
                                <div class="button button_update trans_200">
                                    <a href="{{route('superAdmin.user.restore', encrypt($userDetail->id))}}" data-toggle="tooltip" onclick="return confirm('Are you sure to restore this ?');">Restore</a>
                                </div>
                            @else
                                <div class="button button_update trans_200">
                                    <a href="{{route('superAdmin.user.delete', encrypt($userDetail->id))}}" data-toggle="tooltip" onclick="return confirm('Are you sure to delete this ?');">Delete</a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="section_container content-toggle-1">
            <div class="container">
                <div class="row">

                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Category</div>
                                <div class="main_form_container">
                                    {{ Form::open(['route' => 'superAdmin.user.update', 'method' => 'post', 'id' => 'user_form', 'class' => 'main_form']) }}
                                    <input type="hidden" name="id" value="{{$userDetail->id}}">
                                    <div>
                                        <!-- Title -->
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title" class="main_input" @if(is_null(old('title'))) value="{{$userDetail->title}}" @else value="{{old('title')}}" @endif required="required">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <!-- Name -->
                                            <label for="main_name">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" id="main_name" class="main_input" @if(is_null(old('first_name'))) value="{{$userDetail->first_name}}" @else value="{{old('first_name')}}" @endif required="required">
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Last Name -->
                                            <label for="main_last_name">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name" id="main_last_name" class="main_input" @if(is_null(old('last_name'))) value="{{$userDetail->last_name}}" @else value="{{old('last_name')}}" @endif required="required">
                                        </div>
                                    </div>
                                    <div class="">
                                        <!-- Country -->
                                        <label for="main_country">Country <span class="text-danger">*</span></label>
                                        <input type="text" name="country" id="main_country" class="main_input" @if(is_null(old('country'))) value="{{$userDetail->country}}" @else value="{{old('country')}}" @endif required="required">
                                    </div>
                                    <div>
                                        <!-- Address -->
                                        <label for="main_address">Address <span class="text-danger">*</span></label>
                                        <input type="text" name="address" id="main_address" class="main_input" @if(is_null(old('address'))) value="{{$userDetail->address}}" @else value="{{old('address')}}" @endif required="required">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <!-- Zipcode -->
                                            <label for="main_zipcode">Zipcode <span class="text-danger">*</span></label>
                                            <input type="text" name="zip_code" id="main_zipcode" class="main_input" @if(is_null(old('zip_code'))) value="{{$userDetail->zip_code}}" @else value="{{old('zip_code')}}" @endif required="required">
                                        </div>
                                        <div class="col-lg-8">
                                            <!-- City / Town -->
                                            <label for="main_city">City/Town <span class="text-danger">*</span></label>
                                            <input type="text" name="city" id="main_city" class="main_input" @if(is_null(old('city'))) value="{{$userDetail->city}}" @else value="{{old('city')}}" @endif required="required">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <!-- Phone Code -->
                                            <label for="main_phone">Phone Code <span class="text-danger">*</span></label>
                                            <input type="phone" name="phone_code" id="main_phone" class="main_input" @if(is_null(old('phone_code'))) value="{{$userDetail->phone_code}}" @else value="{{old('phone_code')}}" @endif required="required">
                                        </div>
                                        <div class="col-lg-8">
                                            <!-- Phone no -->
                                            <label for="main_phone">Phone No <span class="text-danger">*</span></label>
                                            <input type="phone" name="phone" id="main_phone" class="main_input" @if(is_null(old('phone'))) value="{{$userDetail->phone}}" @else value="{{old('phone')}}" @endif required="required">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <!-- Username -->
                                            <label for="main_email">Username <span class="text-danger">*</span></label>
                                            <input type="text" name="username" id="main_username" class="main_input" @if(is_null(old('username'))) value="{{$userDetail->username}}" @else value="{{old('username')}}" @endif required="required">
                                        </div>
                                        <div class="col-lg-8">
                                            <!-- Email -->
                                            <label for="main_email">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" name="email" id="main_email" class="main_input" @if(is_null(old('email'))) value="{{$userDetail->email}}" @else value="{{old('email')}}" @endif required="required">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="main_name">Password</label>
                                            <input name="password" id="main_name" class="main_input" type="password">
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="main_name">Confirm Password</label>
                                            <input name="password_confirmation" id="main_name" class="main_input" type="password">
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Buttons -->
                <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                    <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                        <div class="button button_continue trans_200" id="cancel-form-button"><span class="cursor-pointer">Cancel</span></div>
                        <div class="button button_update trans_200" id="submit-user-button"><span class="cursor-pointer">Save</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/category_details.js')}}"></script>
    <script>
        $('.content-toggle-1').hide();
        $(document).ready(function () {
            $('#update-user-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
            });
            $('#cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-user-button').on('click', function () {
                $('#user_form').submit();
            });
        });
    </script>
@endsection
