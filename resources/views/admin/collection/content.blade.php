@extends('admin.layouts.master')
@section('title', __('Collections - '.TITLE_CORE))
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
                <div class="home_title">Collection</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li>Collections</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Collection -->

    <div class="main_section content-toggle-0">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Collection -->
                    <div class="col">
                        <div class="main_extra_title">Collection
                            <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap float-right">
                                <div class="button button_update trans_200 content-toggle-0 cursor-pointer" id="add-new-collection-button"><span>add new collection</span></div>
                            </div></div>
                        <div class="main_container mt-5">
                            <!-- Collection Items -->
                            <div class="collection_items border-0">
                                <table id="collection-table" class="table collection-table table-bordered text-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Title')}}</th>
                                        <th class="all">{{__('Items')}}</th>
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
                    <!-- Collection -->
                    <div class="col">
                        <div class="main_container">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Add New Collection</div>
                                <div class="main_form_container">
                                    {{ Form::open(['route' => 'admin.collection.store', 'method' => 'post', 'id' => 'collection_form', 'class' => 'main_form']) }}
                                    <div>
                                        <!-- Title -->
                                        <label for="title">Title (lowercase) <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title" class="main_input" value="{{old('title')}}" required="required">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <!-- Discount -->
                                            <label for="discount">Discount(%) <span class="text-danger">*</span></label>
                                            <input type="number" min="0" step="0.01" name="discount" id="discount" class="main_input" value="{{old('discount')}}" required="required">
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <!-- Expires At -->
                                            <label for="expires_at">Expires At <span class="text-danger">*</span></label>
                                            <input type="date" name="expires_at" id="expires_at" class="main_input" value="{{old('expires_at')}}" required="required">
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <!-- Collection Buttons -->
                            <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                                <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                    <div class="button button_continue trans_200 content-toggle-1 cursor-pointer" id="cancel-form-button"><span>Cancel</span></div>
                                    <div class="button button_update trans_200 content-toggle-1 cursor-pointer" id="submit-collection-button"><span>Save</span></div>
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
    <script src="{{asset('assets/js/order.js')}}"></script>
    <script>
        $('#collection-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('admin.collection.list')}}',
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
                {"data": "items", searchable: false},
                {"data": "actions", orderable: false, searchable: false}
            ]
        });
    </script>
    <script>
        $('.content-toggle-1').hide();
        $(document).ready(function () {
            $('#add-new-collection-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
                // $('.collection_extra_title').html('Change Password');
            });
            $('#cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-collection-button').on('click', function () {
                $('#collection_form').submit();
            });
        });
    </script>
@endsection
