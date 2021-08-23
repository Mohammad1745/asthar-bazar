@extends('admin.layouts.master')
@section('title', __('Types - '.TITLE_CORE))
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
                <div class="home_title">Type</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('admin.department')}}">Department</a></li>
                        <li>Type</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Type -->

    <div class="main_section content-toggle-0">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Type -->
                    <div class="col">
                        <div class="main_extra_title">Type
                            <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap float-right">
                                <div class="button button_update trans_200 content-toggle-0 cursor-pointer" id="add-new-type-button"><span>add new type</span></div>
                            </div></div>
                        <div class="main_container mt-5">
                            <!-- Category Items -->
                            <div class="order_items border-0">
                                <table id="type-table" class="table type-table table-bordered text-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Title')}}</th>
                                        <th class="all">{{__('Product Variations')}}</th>
                                        <th class="all">{{__('Description')}}</th>
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
                                <div class="main_extra_title">Add New Type</div>
                                <div class="main_form_container">
                                    {{ Form::open(['route' => 'admin.type.store', 'method' => 'post', 'id' => 'type_form', 'class' => 'main_form']) }}
                                    <div>
                                        <!-- Title -->
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title" class="main_input" value="{{old('title')}}" required="required">
                                    </div>
                                    <div>
                                        <!-- Description -->
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" id="description" class="main_input" cols="30" rows="10" required="required">{{old('description')}}</textarea>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <!-- Category Buttons -->
                            <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                                <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                    <div class="button button_continue trans_200 content-toggle-1 cursor-pointer" id="cancel-form-button"><span>Cancel</span></div>
                                    <div class="button button_update trans_200 content-toggle-1 cursor-pointer" id="submit-type-button"><span>Save</span></div>
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
        $('#type-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('admin.type.list')}}',
            order:[0,'asc'],
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
                {"data": "product_variations"},
                {"data": "description"},
                {"data": "actions", orderable: false, searchable: false}
            ]
        });
    </script>
    <script>
        $('.content-toggle-1').hide();
        $(document).ready(function () {
            $('#add-new-type-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
            });
            $('#cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-type-button').on('click', function () {
                $('#type_form').submit();
            });
        });
    </script>
@endsection
