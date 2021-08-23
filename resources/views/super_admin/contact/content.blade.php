@extends('super_admin.layouts.master')
@section('title', __('Contacts - '.TITLE_CORE))
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
                <div class="home_title">Contact</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('superAdmin.account')}}">Account</a></li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact -->

    <div class="main_section content-toggle-0">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Contact -->
                    <div class="col">
                        <div class="main_extra_title">Contact</div>
                        <div class="main_container mt-5">
                            <!-- Category Items -->
                            <div class="contact_message_items border-0">
                                <table id="contact-message-table" class="table contact-message-table table-bordered text-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('First Name')}}</th>
                                        <th class="all">{{__('Last Name')}}</th>
                                        <th class="all">{{__('Email')}}</th>
                                        <th class="all">{{__('To')}}</th>
                                        <th class="all">{{__('Read')}}</th>
                                        <th class="all">{{__('Replied By')}}</th>
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
@endsection

@section('script')
    <script src="{{asset('assets/js/type.js')}}"></script>
    <script>
        $('#contact-message-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('superAdmin.contactMessage.list')}}',
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
                {"data": "first_name"},
                {"data": "last_name"},
                {"data": "email"},
                {"data": "to"},
                {"data": "read"},
                {"data": "replied_by"},
                {"data": "actions", orderable: false, searchable: false}
            ]
        });
    </script>
@endsection
