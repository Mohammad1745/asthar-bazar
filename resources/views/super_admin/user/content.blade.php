@extends('super_admin.layouts.master')
@section('title', __('Users - '.TITLE_CORE))
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
                <div class="home_title">Users</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('superAdmin.dashboard')}}">Dashboard</a></li>
                        <li>Users</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Users -->

    <div class="main_section content-toggle-0">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Users -->
                    <div class="col">
                        <div class="main_extra_title">Users
                            <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap float-right">
                                <div class="button button_update trans_200 content-toggle-0 cursor-pointer" id="add-new-user-button"><span>add new user</span></div>
                            </div></div>
                        <div class="main_container mt-5">
                            <!-- Category Items -->
                            <div class="order_items border-0">
                                <table id="user-table" class="table user-table table-bordered text-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('F.Name')}}</th>
                                        <th class="all">{{__('L.Name')}}</th>
                                        <th class="all">{{__('Type')}}</th>
                                        <th class="all">{{__('Wallet')}}</th>
                                        <th class="all">{{__('Status')}}</th>
                                        <th class="all">{{__('Actions')}}</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main_section content-toggle-1" style="padding-top: 100px;">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Category -->
                    <div class="col">
                        <div class="main_container">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Add New User</div>
                                <div class="main_form_container">
                                    {{ Form::open(['route' => 'superAdmin.user.store', 'method' => 'post', 'id' => 'user_form', 'class' => 'main_form']) }}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <!-- Name -->
                                            <label for="main_name">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" id="main_name" class="main_input" value="{{old('first_name')}}" required="required">
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Last Name -->
                                            <label for="main_last_name">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name" id="main_last_name" class="main_input" value="{{old('last_name')}}" required="required">
                                        </div>
                                    </div>
                                    <div class="">
                                        <!-- Country -->
                                        <label for="main_country">Country <span class="text-danger">*</span></label>
                                        <input type="text" name="country" id="main_country" class="main_input" value="{{old('country')}}" required="required">
                                    </div>
                                    <div>
                                        <!-- Address -->
                                        <label for="main_address">Address <span class="text-danger">*</span></label>
                                        <input type="text" name="address" id="main_address" class="main_input" value="{{old('address')}}" required="required">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <!-- Zipcode -->
                                            <label for="main_zipcode">Zipcode <span class="text-danger">*</span></label>
                                            <input type="text" name="zip_code" id="main_zipcode" class="main_input" value="{{old('zip_code')}}" required="required">
                                        </div>
                                        <div class="col-lg-8">
                                            <!-- City / Town -->
                                            <label for="main_city">City/Town <span class="text-danger">*</span></label>
                                            <input type="text" name="city" id="main_city" class="main_input" value="{{old('city')}}" required="required">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <!-- Phone Code -->
                                            <label for="main_phone">Phone Code <span class="text-danger">*</span></label>
                                            <input type="phone" name="phone_code" id="main_phone" class="main_input" value="{{old('phone_code')}}" required="required">
                                        </div>
                                        <div class="col-lg-8">
                                            <!-- Phone no -->
                                            <label for="main_phone">Phone No <span class="text-danger">*</span></label>
                                            <input type="phone" name="phone" id="main_phone" class="main_input" value="{{old('phone')}}" required="required">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <!-- Username -->
                                            <label for="main_email">Username <span class="text-danger">*</span></label>
                                            <input type="text" name="username" id="main_username" class="main_input" value="{{old('username')}}" required="required">
                                        </div>
                                        <div class="col-lg-8">
                                            <!-- Email -->
                                            <label for="main_email">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" name="email" id="main_email" class="main_input" value="{{old('email')}}" required="required">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="main_name">Password <span class="text-danger">*</span></label>
                                            <input name="password" id="main_name" class="main_input" type="password">
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="main_name">Confirm Password <span class="text-danger">*</span></label>
                                            <input name="password_confirmation" id="main_name" class="main_input" type="password">
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <!-- Category Buttons -->
                            <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                                <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                    <div class="button button_continue trans_200 content-toggle-1 cursor-pointer" id="cancel-form-button"><span>Cancel</span></div>
                                    <div class="button button_update trans_200 content-toggle-1 cursor-pointer" id="submit-user-button"><span>Save</span></div>
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
    <script src="{{asset('assets/js/type.js')}}"></script>
    <script>
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('superAdmin.user.list')}}',
            order:[2,'asc'],
            autoWidth:false,
            language: {
                paginate: {
                    next: 'Next &#8250;',
                    previous: '&#8249; Previous'
                },
                search: "_INPUT_",
                searchPlaceholder: "Search...",
            },
            columnDefs: [
                {"className": "text-center", "targets": "_all"}
            ],
            columns: [
                {"data": "first_name"},
                {"data": "last_name"},
                {"data": "role"},
                {"data": "wallet"},
                {"data": "verification_status"},
                {"data": "actions", orderable: false, searchable: false}
            ]
        });
    </script>
    <script>
        $('.content-toggle-1').hide();
        $(document).ready(function () {
            $('#add-new-user-button').on('click', function () {
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
