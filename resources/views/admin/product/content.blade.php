@extends('admin.layouts.master')
@section('title', __('Products - '.TITLE_CORE))
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
                <div class="home_title">Product</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('admin.department')}}">Department</a></li>
                        <li>Product</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Product -->

    <div class="main_section content-toggle-0">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Product -->
                    <div class="col">
                        <div class="main_extra_title">Product
                            <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap float-right">
                                <div class="button button_update trans_200 content-toggle-0 cursor-pointer" id="add-new-product-button"><span>add new product</span></div>
                            </div></div>
                        <div class="main_container mt-5">
                            <!-- Product Items -->
                            <div class="order_items border-0">
                                <table id="order-table" class="table order-table table-bordered text-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Title')}}</th>
                                        <th class="all">{{__('Category')}}</th>
                                        <th class="all">{{__('Variations')}}</th>
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

    <div class="main_section content-toggle-1 content-toggle-1" style="padding-top: 100px;">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Product -->
                    <div class="col">
                        <div class="main_container">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Add New Product</div>
                                <div class="main_form_container">
                                    {{ Form::open(['route' => 'admin.product.store', 'method' => 'post', 'id' => 'product_form', 'class' => 'main_form']) }}
                                    <div>
                                        <!-- Title -->
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title" class="main_input" value="{{old('title')}}" required="required">
                                    </div>
                                    <div>
                                        <!-- Category -->
                                        <label for="category_id"> Category </label>
                                        <select name="category_id" id="category_id" class="main_input">
                                            <option value="{{null}}">Select Parent Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <!-- Product Buttons -->
                            <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                                <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                    <div class="button button_continue trans_200 content-toggle-1 cursor-pointer" id="cancel-form-button"><span>Cancel</span></div>
                                    <div class="button button_update trans_200 content-toggle-1 cursor-pointer" id="submit-product-button"><span>Save</span></div>
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
    <script src="{{asset('assets/js/category.js')}}"></script>
    <script>
        $('#order-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('admin.product.list')}}',
            order:[1,'asc'],
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
                {"data": "category"},
                {"data": "variations"},
                {"data": "actions", orderable: false, searchable: false}
            ]
        });
    </script>
    <script>
        $('.content-toggle-1').hide();
        $(document).ready(function () {
            $('#add-new-product-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
                // $('.product_extra_title').html('Change Password');
            });
            $('#cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-product-button').on('click', function () {
                $('#product_form').submit();
            });
        });
    </script>
@endsection
