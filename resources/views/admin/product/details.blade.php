@extends('admin.layouts.master')
@section('title', __('Product Details - '.TITLE_CORE))
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
                <div class="home_title">{{$product->title}}</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('admin.department')}}">Department</a></li>
                        <li><a href="{{route('admin.product')}}">Product</a></li>
                        <li>Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Product -->

    <div class="main_section" style="padding-top: 100px;">

        <div class="section_container content-toggle-0">
            <div class="container">
                <div class="row">

                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Product</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Title</div>
                                        <div class="main_extra_total_value ml-auto">{{$product->title}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Category</div>
                                        <div class="main_extra_total_value ml-auto">{{$product->category['title']}}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Buttons -->
                <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                    <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                        <div class="button button_continue trans_200" id="add-product-variation-button"><span class="cursor-pointer">Add Variation</span></div>
                        <div class="button button_clear trans_200" id="update-product-button"><span class="cursor-pointer">Update</span></div>
                        <div class="button button_update trans_200">
                            <a href="{{route('admin.product.delete', encrypt($product->id))}}" data-toggle="tooltip" onclick="return confirm('Are you sure to delete this ?');">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section_container main_extra_container content-toggle-0">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="main_container">
                            <!-- Product Items -->
                            <div class="order_items border-0">
                                <table id="order-table" class="table order-table table-bordered text-center mb-0" style="width: 100%; overflow-x: scroll;">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Title')}}</th>
                                        <th class="all">{{__('Product')}}</th>
                                        <th class="all">{{__('Type')}}</th>
                                        <th class="all">{{__('quantity')}}</th>
                                        <th class="all">{{__('Unit Of Quantity')}}</th>
                                        <th class="all">{{__('Weight Per Unit')}}</th>
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
        <div class="main_section content-toggle-1 pt-0">

            <div class="section_container">
                <div class="container">
                    <div class="row">
                        <!-- Product -->
                        <div class="col">
                            <div class="main_container">
                                <div class="main_extra_content main_extra_total">
                                    <div class="main_extra_title">Edit Product</div>
                                    <div class="main_form_container main_form_container">
                                        {{ Form::open(['route' => 'admin.product.update', 'method' => 'post', 'id' => 'product_form', 'class' => 'main_form']) }}
                                        <input type="hidden" name="id" value="{{$product->id}}">
                                        <div>
                                            <!-- Title -->
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" class="main_input" @if(is_null(old('title'))) value="{{$product->title}}" @else value="{{old('title')}}" @endif required="required">
                                        </div>
                                        <div>
                                            <!-- Category -->
                                            <label for="category_id"> Category </label>
                                            <select name="category_id" id="category_id" class="main_input">
                                                <option value="{{null}}">Select Parent Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" @if ($category->id==$product->category_id) selected @endif>{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                <!-- Product Buttons -->
                                <div class="main_buttons d-flex flex-row align-items-start justify-content-start" style="margin-top: 32px;">
                                    <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                        <div class="button button_continue trans_200 cursor-pointer cancel-form-button"><span>Cancel</span></div>
                                        <div class="button button_update trans_200 cursor-pointer" id="submit-product-button"><span>Save</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main_section content-toggle-2 pt-0">

            <div class="section_container">
                <div class="container">
                    <div class="row">
                        <!-- Product -->
                        <div class="col">
                            <div class="main_container">
                                <div class="main_extra_content main_extra_total">
                                    <div class="main_extra_title">Add Variation of {{$product->title}}</div>
                                    <div class="main_form_container main_form_container">
                                        {{ Form::open(['route' => 'admin.product.storeVariation', 'method' => 'post', 'files' => 'true', 'id' => 'product_variation_form', 'class' => 'main_form']) }}
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <div>
                                            <!-- Title -->
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" class="main_input" value="{{old('title')}}" required="required">
                                        </div>
                                        <div>
                                            <!-- Type -->
                                            <label for="type_id"> Type <span class="text-danger">*</span></label>
                                            <select name="type_id" id="type_id" class="main_input">
                                                <option value="{{null}}">Select Type</option>
                                                @foreach($types as $type)
                                                    <option value="{{$type->id}}" >{{$type->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <!-- Title -->
                                                <label for="quantity">Quantity <span class="text-danger">*</span></label>
                                                <input type="number" name="quantity" min="0" id="quantity" class="main_input" value="{{old('quantity')}}" required="required">
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <!-- Title -->
                                                <label for="unit_of_quantity">Unit Of Quantity <span class="text-danger">*</span></label>
                                                <input type="text" name="unit_of_quantity" id="unit_of_quantity" class="main_input" value="{{old('unit_of_quantity')}}" required="required">
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <!-- Title -->
                                                <label for="weight_per_unit">Weight Per Unit (kg) <span class="text-danger">*</span></label>
                                                <input type="number" step="0.001" min="0" name="weight_per_unit" id="weight_per_unit" class="main_input" value="{{old('weight_per_unit')}}" required="required">
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <!-- Title -->
                                                <label for="manufacturing_cost">Manufacturing Cost <span class="text-danger">*</span></label>
                                                <input type="number" step="0.01" min="0" name="manufacturing_cost" id="manufacturing_cost" class="main_input" value="{{old('manufacturing_cost')}}" required="required">
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <!-- Title -->
                                                <label for="price">Regular Price <span class="text-danger">*</span></label>
                                                <input type="number" step="0.01" min="0" name="regular_price" id="regular_price" class="main_input" value="{{old('regular_price')}}" required="required">
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <!-- Title -->
                                                <label for="status">Status <span class="text-danger">*</span></label>
                                                <select name="status" id="status" class="main_input">
                                                    <option value="1" >Active</option>
                                                    <option value="0" >Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <!-- Image -->
                                            <label for="image">Image (Recommended W:300px, H:200px) <span class="text-danger">*</span></label>
                                            <input name="image" type="file" id="input-file-now" class="dropify" data-default-file="" >
                                        </div>
                                        <div>
                                            <!-- Description -->
                                            <label for="description">Description <span class="text-danger">*</span></label>
                                            <textarea name="description" id="description" class="main_input" cols="30" rows="10" required="required"> {{old('description')}} </textarea>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                <!-- Product Buttons -->
                                <div class="main_buttons d-flex flex-row align-items-start justify-content-start" style="margin-top: 32px;">
                                    <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                        <div class="button button_continue trans_200 cursor-pointer cancel-form-button"><span>Cancel</span></div>
                                        <div class="button button_update trans_200 cursor-pointer" id="submit-product-variation-button"><span>Save</span></div>
                                    </div>
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
    <script src="{{asset('assets/js/category_details.js')}}"></script>
    <script type='text/javascript' src='{{ asset('assets/plugins/dropify/dropify.min.js') }}'></script>
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
    <script>
        $('#order-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('admin.product.variationList', encrypt($product->id))}}',
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
                {"data": "product"},
                {"data": "type"},
                {"data": "quantity"},
                {"data": "unit_of_quantity"},
                {"data": "weight_per_unit"},
                {"data": "status"},
                {"data": "actions", orderable: false, searchable: false}
            ]
        });
    </script>
    <script>
        $('.content-toggle-1').hide();
        $('.content-toggle-2').hide();
        $(document).ready(function () {
            $('#update-product-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
            });
            $('#add-product-variation-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-2').show();
            });
            $('.cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-product-button').on('click', function () {
                $('#product_form').submit();
            });
            $('#submit-product-variation-button').on('click', function () {
                $('#product_variation_form').submit();
            });
        });
    </script>
@endsection
