@extends('super_admin.layouts.master')
@section('title', __('Departments - '.TITLE_CORE))
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
                <div class="home_title">Departments</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('superAdmin.dashboard')}}">Dashboard</a></li>
                        <li>Departments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Departments -->

    <div class="main_section content-toggle-0">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Departments -->
                    <div class="col">
                        <div class="main_extra_title">Departments
                            <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap float-right">
                                <div class="button button_update trans_200 content-toggle-0 cursor-pointer" id="add-new-department-button"><span>add new department</span></div>
                            </div></div>
                        <div class="main_container mt-5">
                            <!-- Category Items -->
                            <div class="order_items border-0">
                                <table id="department-table" class="table department-table table-bordered text-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Title')}}</th>
                                        <th class="all">{{__('Revenue')}}</th>
                                        <th class="all">{{__('Profit')}}</th>
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
                                    {{ Form::open(['route' => 'superAdmin.department.store', 'method' => 'post', 'id' => 'department_form', 'class' => 'main_form']) }}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <!-- Title -->
                                            <label for="title">Department Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" class="main_input" value="{{old('title')}}" required="required">
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- User -->
                                            <label for="main_owner_id">Department Owner <span class="text-danger">*</span></label>
                                            <select type="text" name="owner_id" id="main_owner_id" class="main_input">
                                                @foreach($freshAdmins as $admin)
                                                    <option value="{{$admin->id}}">{{$admin->first_name.' '.$admin->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="">
                                        <!-- Description -->
                                        <label for="description">Department Description <span class="text-danger">*</span></label>
                                        <textarea name="description" id="description" class="main_input" required="required">{{old('description')}}</textarea>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <!-- Category Buttons -->
                            <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                                <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                    <div class="button button_continue trans_200 content-toggle-1 cursor-pointer" id="cancel-form-button"><span>Cancel</span></div>
                                    <div class="button button_update trans_200 content-toggle-1 cursor-pointer" id="submit-department-button"><span>Save</span></div>
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
        $('#department-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('superAdmin.department.list')}}',
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
                {"data": "title"},
                {"data": "revenue"},
                {"data": "profit"},
                {"data": "status"},
                {"data": "actions", orderable: false, searchable: false}
            ]
        });
    </script>
    <script>
        $('.content-toggle-1').hide();
        $(document).ready(function () {
            $('#add-new-department-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
            });
            $('#cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-department-button').on('click', function () {
                $('#department_form').submit();
            });
        });
    </script>
@endsection
