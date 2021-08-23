@extends('admin.layouts.master')
@section('title', __('Category Details - '.TITLE_CORE))
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
                <div class="home_title">{{$category->title}}</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('admin.department')}}">Department</a></li>
                        <li><a href="{{route('admin.category')}}">Category</a></li>
                        <li>Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Category -->

    <div class="main_section">

        <div class="section_container content-toggle-0">
            <div class="container">
                <div class="row">

                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Category</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Title</div>
                                        <div class="main_extra_total_value ml-auto">{{$category->title}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Parent Category</div>
                                        <div class="main_extra_total_value ml-auto text-right">
                                            @if(sizeof($category->parent)) @foreach($category->parent as $parent) {{$parent.'/'}} @endforeach @else ----- @endif
                                        </div>
                                    </li>
                                    <li class="main_extra_total_value ml-auto text-justify">
                                        <div class="main_extra_total_title">{{$category->description}}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Buttons -->
                <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                    <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                        <div class="button button_continue trans_200" id="update-category-button"><span class="cursor-pointer">Update</span></div>
                        <div class="button button_update trans_200">
                            <a href="{{route('admin.category.delete', encrypt($category->id))}}" data-toggle="tooltip" onclick="return confirm('Are you sure to delete this ?');">Delete</a>
                        </div>
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
                                <div class="category_form_container">
                                    {{ Form::open(['route' => 'admin.category.update', 'method' => 'post', 'id' => 'category_form', 'class' => 'main_form']) }}
                                    <input type="hidden" name="id" value="{{$category->id}}">
                                    <div>
                                        <!-- Title -->
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title" class="main_input" @if(is_null(old('title'))) value="{{$category->title}}" @else value="{{old('title')}}" @endif required="required">
                                    </div>
                                    <div>
                                        <!-- Parent Category -->
                                        <label for="checkout_email"> Parent Category </label>
                                        <select name="parent_id" id="parent_id" class="main_input">
                                            <option value="{{null}}">Select Parent Category</option>
                                            @foreach($categories as $categoryX)
                                                @if($categoryX->id!=$category->id)
                                                    <option value="{{$categoryX->id}}" @if ($category->parent_id==$categoryX->id) selected @endif>{{$categoryX->title}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <!-- Description -->
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" id="description" class="main_input" cols="30" rows="10" required="required"> @if(is_null(old('description'))) {{$category->description}} @else value="{{old('description')}}" @endif </textarea>
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
                        <div class="button button_update trans_200" id="submit-category-button"><span class="cursor-pointer">Save</span></div>
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
            $('#update-category-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
            });
            $('#cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-category-button').on('click', function () {
                $('#category_form').submit();
            });
        });
    </script>
@endsection
