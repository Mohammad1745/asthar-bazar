@extends('admin.layouts.master')
@section('title', __('News - '.TITLE_CORE))
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
                <div class="home_title">News</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('admin.account')}}">Account</a></li>
                        <li>News</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- News -->

    <div class="main_section content-toggle-0">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- News -->
                    <div class="col">
                        <div class="main_extra_title">News
                            <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap float-right">
                                <div class="button button_update trans_200 content-toggle-0 cursor-pointer" id="add-new-news-button"><span>add news</span></div>
                            </div></div>
                        <div class="main_container mt-5">
                            <!-- Category Items -->
                            <div class="order_items border-0">
                                <table id="news-table" class="table news-table table-bordered text-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Date')}}</th>
                                        <th class="all">{{__('Department')}}</th>
                                        <th class="all">{{__('Content')}}</th>
                                        <th class="all">{{__('Image')}}</th>
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
                                <div class="main_extra_title">Add News</div>
                                <div class="main_form_container">
                                    {{ Form::open(['route' => 'admin.news.store', 'method' => 'post', 'files' => 'true', 'id' => 'news_form', 'class' => 'main_form']) }}
                                    <div>
                                        <!-- Content -->
                                        <label for="content">Content <span class="text-danger">*</span></label>
                                        <textarea name="content" id="content" class="main_input" cols="30" rows="10" required="required">{{old('content')}}</textarea>
                                    </div>
                                    <div>
                                        <!-- Image -->
                                        <label for="image">Image (Recommended W:300px, H:200px) <span class="text-danger">*</span></label>
                                        <input name="image" type="file" id="input-file-now" class="dropify" data-default-file="" >
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <!-- Category Buttons -->
                            <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                                <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                    <div class="button button_continue trans_200 content-toggle-1 cursor-pointer" id="cancel-form-button"><span>Cancel</span></div>
                                    <div class="button button_update trans_200 content-toggle-1 cursor-pointer" id="submit-news-button"><span>Save</span></div>
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
    <script src="{{asset('assets/js/news.js')}}"></script>
    <script type='text/javascript' src='{{ asset('assets/plugins/dropify/dropify.min.js') }}'></script>
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
    <script>
        $('#news-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('admin.news.list')}}',
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
                {"data": "created_at"},
                {"data": "department"},
                {"data": "content"},
                {"data": "image"},
                {"data": "actions", orderable: false, searchable: false}
            ]
        });
    </script>
    <script>
        $('.content-toggle-1').hide();
        $(document).ready(function () {
            $('#add-new-news-button').on('click', function () {
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
