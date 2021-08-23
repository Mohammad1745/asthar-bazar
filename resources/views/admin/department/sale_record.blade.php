@extends('admin.layouts.master')
@section('title', __('Sale Record - '.TITLE_CORE))
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
                <div class="home_title">Sale Record</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('admin.department')}}">Department</a></li>
                        <li>Sale Record</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Sale Record -->

    <div class="main_section content-toggle-0">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Sale Record -->
                    <div class="col">
                        <div class="main_extra_title">Sale Record</div>
                        <div class="main_container mt-5">
                            <!-- Category Items -->
                            <div class="order_items border-0">
                                <table id="sale-record-table" class="table sale-record-table table-bordered text-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Product')}}</th>
                                        <th class="all">{{__('Variation')}}</th>
                                        <th class="all">{{__('Type')}}</th>
                                        <th class="all">{{__('Quantity')}}</th>
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
        $('#sale-record-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('admin.department.saleRecord.list')}}',
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
                {"data": "product_title"},
                {"data": "product_variation_title"},
                {"data": "type_title"},
                {"data": "quantity"},
            ]
        });
    </script>
@endsection
