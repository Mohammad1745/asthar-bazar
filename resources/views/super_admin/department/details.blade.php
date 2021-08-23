@extends('super_admin.layouts.master')
@section('title', __('Department Details - '.TITLE_CORE))
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
                <div class="home_title">{{$departmentDetail->title}}</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('superAdmin.dashboard')}}">Dashboard</a></li>
                        <li><a href="{{route('superAdmin.department')}}">Department</a></li>
                        <li>Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Department -->

    <div class="main_section">

        <div class="section_container content-toggle-0">
            <div class="container">
                <div class="row">

                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Department</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Title</div>
                                        <div class="main_extra_total_value ml-auto">{{$departmentDetail->title}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Owner</div>
                                        <div class="main_extra_total_value ml-auto">{{$departmentDetail->owner_first_name.' '.$departmentDetail->owner_last_name}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="">Collections</a></div>
                                        <div class="main_extra_total_value ml-auto">{{$departmentDetail->collection_count}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="">Types</a></div>
                                        <div class="main_extra_total_value ml-auto">{{$departmentDetail->type_count}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="">Categories</a></div>
                                        <div class="main_extra_total_value ml-auto">{{$departmentDetail->category_count}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="#product-variation-list">Products</a></div>
                                        <div class="main_extra_total_value ml-auto">{{$departmentDetail->product_count}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="#product-variation-list">Variations</a></div>
                                        <div class="main_extra_total_value ml-auto">{{$departmentDetail->product_variation_count}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="#sale-record-list">Sale Record</a></div>
                                        <div class="main_extra_total_value ml-auto">{{$departmentDetail->sale_record_count}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Opened</div>
                                        <div class="main_extra_total_value ml-auto">{{dateOf($departmentDetail->created_at)}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Status</div>
                                        <div class="main_extra_total_value ml-auto">{{departmentStatus($departmentDetail->status)}}</div>
                                    </li>
                                    <li class="main_extra_total_value ml-auto text-justify">
                                        <div class="main_extra_total_title">{{$departmentDetail->description}}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                    <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                        <div class="button button_continue trans_200" id="update-department-button"><span class="cursor-pointer">Update</span></div>
                        @if ($departmentDetail->status==DEPARTMENT_INACTIVE_STATUS)
                            <div class="button button_update trans_200">
                                <a href="{{route('superAdmin.department.activate', encrypt($departmentDetail->id))}}" data-toggle="tooltip" onclick="return confirm('Are you sure to activate this ?');">Activate</a>
                            </div>
                        @else
                            <div class="button button_update trans_200">
                                <a href="{{route('superAdmin.department.deactivate', encrypt($departmentDetail->id))}}" data-toggle="tooltip" onclick="return confirm('Are you sure to deactivate this ?');">Deactivate</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="section_container content-toggle-0" style="margin-top: 100px;">
            <div class="container">
                <div class="row">

                    <!-- Transactions -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Transactions</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Transactions From</div>
                                        <div class="main_extra_total_value ml-auto">{{$departmentDetail->started_at}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Revenue</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$departmentDetail->revenue}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Revenue From Wallet</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$departmentDetail->revenue_from_wallet}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Manufacturing Cost</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$departmentDetail->manufacturing_cost}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Profit</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$departmentDetail->profit}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Customer Reward</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$departmentDetail->customer_reward}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Net Profit</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$departmentDetail->net_profit}}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Buttons -->
                <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                    <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                        <div class="button button_continue trans_200"><a href="{{route('superAdmin.department.paymentDone', encrypt($departmentDetail->id))}}">Payment Done</a></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Variation -->
        <div class="section_container main_extra_container content-toggle-0" id="product-variation-list" style="margin-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="main_extra_title">Product Variation</div>
                        <div class="main_container mt-5">
                            <!-- Product Items -->
                            <div class="order_items border-0">
                                <table id="product-variation-table" class="table product-variation-table table-bordered text-center mb-0" style="width: 100%; overflow-x: scroll;">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Title')}}</th>
                                        <th class="all">{{__('Product')}}</th>
                                        <th class="all">{{__('Type')}}</th>
                                        <th class="all">{{__('Manufacturing Cost')}}</th>
                                        <th class="all">{{__('Unit Price')}}</th>
                                        <th class="all">{{__('Weight Per Unit')}}</th>
                                        <th class="all">{{__('quantity')}}</th>
                                        <th class="all">{{__('Status')}}</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sale Record -->
        <div class="section_container content-toggle-0" id="sale-record-list" style="margin-top: 100px;">
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

        <!-- Edit Department -->
        <div class="section_container content-toggle-1">
            <div class="container">
                <div class="row">

                    <!-- Edit Department -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Category</div>
                                <div class="main_form_container">
                                    {{ Form::open(['route' => 'superAdmin.department.update', 'method' => 'post', 'id' => 'department_form', 'class' => 'main_form']) }}
                                    <input type="hidden" name="id" value="{{$departmentDetail->id}}">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <!-- Title -->
                                            <label for="title">Department Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" class="main_input" @if(is_null(old('title'))) value="{{$departmentDetail->title}}" @else value="{{old('title')}}" @endif required="required">
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- User -->
                                            <label for="owner_id">Department Owner <span class="text-danger">*</span></label>
                                            <select type="text" name="owner_id" id="owner_id" class="main_input">
                                                <option value="{{$departmentDetail->owner_id}}" selected>{{$departmentDetail->owner_first_name.' '.$departmentDetail->owner_last_name}}</option>
                                                @foreach($freshAdmins as $admin)
                                                    <option value="{{$admin->id}}">{{$admin->first_name.' '.$admin->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="">
                                        <!-- Description -->
                                        <label for="description">Department Description <span class="text-danger">*</span></label>
                                        <textarea name="description" id="description" class="main_input" required="required">@if(is_null(old('description'))){{$departmentDetail->description}}@else{{old('description')}}@endif</textarea>
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
                        <div class="button button_update trans_200" id="submit-department-button"><span class="cursor-pointer">Save</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/category_details.js')}}"></script>
    <script>
        $('#product-variation-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('superAdmin.department.productVariation.list', encrypt($departmentDetail->id))}}',
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
                {"data": "product_title"},
                {"data": "type_title"},
                {"data": "manufacturing_cost"},
                {"data": "unit_price"},
                {"data": "weight_per_unit"},
                {"data": "quantity"},
                {"data": "status"},
            ]
        });
    </script>
    <script>
        $('#sale-record-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('superAdmin.department.saleRecord.list', encrypt($departmentDetail->id))}}',
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
    <script>
        $('.content-toggle-1').hide();
        $(document).ready(function () {
            $('#update-department-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
            });
            $('#cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-department-button').on('click', function () {
                if($('#owner_id').val()!={{$departmentDetail->owner_id}}){
                    if(confirm('Alert! \nPlease confirm: You have changed the ownership?')){$('#department_form').submit();}
                }else{
                    $('#department_form').submit();
                }
            });
        });
    </script>
@endsection
