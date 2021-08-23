@extends('super_admin.layouts.master')
@section('title', __('News Details - '.TITLE_CORE))
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
                <div class="home_title">{{$news->title}}</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('superAdmin.account')}}">Account</a></li>
                        <li><a href="{{route('superAdmin.news')}}">News</a></li>
                        <li>Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart -->

    <div class="main_section">

        <div class="section_container content-toggle-0">
            <div class="container">
                <div class="row">

                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">News</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Data</div>
                                        <div class="main_extra_total_value ml-auto">{{$news->created_at}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Published By</div>
                                        <div class="main_extra_total_value ml-auto">{{$news->department}}</div>
                                    </li>
                                    <li class="main_extra_total_value ml-auto text-justify">
                                        <div class="main_extra_total_title"><img src="{{asset(newsImageViewPath().$news->image)}}" style="height: 100%; width: 100%"></div>
                                    </li>
                                    <li class="main_extra_total_value ml-auto text-justify">
                                        <div class="main_extra_total_title">{{$news->content}}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($news->user_id==authUser()->id)
                    <!-- Cart Buttons -->
                    <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                        <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                            <div class="button button_continue trans_200" id="update-news-button"><span class="cursor-pointer">Update</span></div>
                            <div class="button button_update trans_200">
                                <a href="{{route('superAdmin.news.delete', encrypt($news->id))}}" data-toggle="tooltip" onclick="return confirm('Are you sure to delete this ?');">Delete</a>
                            </div>
                        </div>
                    </div>
                @endif
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
                                <div class="category_form_container mt-5">
                                    {{ Form::open(['route' => 'superAdmin.news.update', 'method' => 'post', 'files' => 'true', 'id' => 'news_form', 'class' => 'main_form']) }}
                                    <input type="hidden" name="id" value="{{$news->id}}">
                                    <div>
                                        <!-- Content -->
                                        <label for="content">Content <span class="text-danger">*</span></label>
                                        <textarea name="content" id="content" class="main_input" cols="30" rows="10" required="required">@if(is_null(old('content'))){{$news->content}}@else{{old('content')}}@endif</textarea>
                                    </div>
                                    <div>
                                        <!-- Image -->
                                        <label for="image">Image (Recommended W:300px, H:200px) <span class="text-danger">*</span></label>
                                        <input name="image" type="file" id="input-file-now" class="dropify" data-default-file="{{asset(newsImageViewPath().$news->image)}}" >
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
                        <div class="button button_update trans_200" id="submit-news-button"><span class="cursor-pointer">Save</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/news_details.js')}}"></script>
    <script type='text/javascript' src='{{ asset('assets/plugins/dropify/dropify.min.js') }}'></script>
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
    <script>
        $('.content-toggle-1').hide();
        $(document).ready(function () {
            $('#update-news-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
            });
            $('#cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-news-button').on('click', function () {
                $('#news_form').submit();
            });
        });
    </script>
@endsection
