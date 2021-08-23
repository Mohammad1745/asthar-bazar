@extends('user.layouts.master')
@section('title', __('Order - '.TITLE_CORE))
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
                <div class="home_title">Order</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('account')}}">Account</a></li>
                        <li>Order</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Order -->

    <div class="main_section">
        <div class="section_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="main_container">

                            <!-- Order Items -->
                            <div class="main_items border-0">
                                <table id="order-table" class="table order-table table-bordered text-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Order Id')}}</th>
                                        <th class="all">{{__('Date')}}</th>
                                        <th class="all">{{__('Weight')}}</th>
                                        <th class="all">{{__('Price')}}</th>
                                        <th class="all">{{__('Payment')}}</th>
                                        <th class="all">{{__('Order')}}</th>
                                        <th class="all">{{__('Actions')}}</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>

{{--                            <!-- Order Buttons -->--}}
{{--                            <div class="main_buttons d-flex flex-row align-items-start justify-content-start">--}}
{{--                                <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">--}}
{{--                                    <div class="button button_continue trans_200"><a href="{{ route('shop') }}">continue shopping</a></div>--}}
{{--                                    <div class="button button_clear trans_200"><a href="}">clear order</a></div>--}}
{{--                                    <div class="button button_update trans_200" id="update-order-button"><span class="cursor-pointer">update order</span></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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
        $('#order-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('order.list')}}',
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
                {"data": "order_code"},
                {"data": "created_at"},
                {"data": "total_weight", searchable: false},
                {"data": "total_price"},
                {"data": "payment_status", searchable: false},
                {"data": "shipping_status", searchable: false},
                {"data": "actions", orderable: false, searchable: false}
            ]
        });
    </script>
@endsection
