@extends('admin.layouts.master')
@section('title', __('Order Details - '.TITLE_CORE))
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
                <div class="home_title">Details</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('admin.department')}}">Department</a></li>
                        <li><a href="{{route('admin.order')}}">Order</a></li>
                        <li>Details</li>
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

                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Order</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Name</div>
                                        <div class="main_extra_total_value ml-auto">{{$order->first_name.' '.$order->last_name}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Email</div>
                                        <div class="main_extra_total_value ml-auto">{{$order->email}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Phone</div>
                                        <div class="main_extra_total_value ml-auto">{{$order->phone_code.$order->phone}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Address</div>
                                        <div class="main_extra_total_value ml-auto">{{$order->address}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Zip Code</div>
                                        <div class="main_extra_total_value ml-auto">{{$order->zip_code}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">City</div>
                                        <div class="main_extra_total_value ml-auto">{{$order->city}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Country</div>
                                        <div class="main_extra_total_value ml-auto">{{$order->country}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Quantity</div>
                                        <div class="main_extra_total_value ml-auto">{{$order->quantity}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Weight</div>
                                        <div class="main_extra_total_value ml-auto">{{$order->total_weight}}kg</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Sub-total</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$order->subtotal}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Charges</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$order->charges}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Paid</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$order->paid}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Payment Method</div>
                                        <div class="main_extra_total_value ml-auto">{{$order->payment_method}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Shipping Method</div>
                                        <div class="main_extra_total_value ml-auto">{{$order->shipping_method}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Payment Status</div>
                                        <div class="main_extra_total_value ml-auto">{{paymentStatus($order->payment_status)}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Order Status</div>
                                        <div class="main_extra_total_value ml-auto">{{deliveryStatus($order->shipping_status)}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Total</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$order->total_price}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Due</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$order->total_price-$order->paid}}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section_container content-toggle-0" style="margin-top: 100px;">
            <div class="container">
                <div class="row">

                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Charges</div>
                                <ul class="main_extra_total_list">
                                    @foreach($orderCharges as $charge)
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="main_extra_total_title">{{$charge->title}}</div>
                                            <div class="main_extra_total_value ml-auto">৳ {{$charge->amount}}</div>
                                        </li>
                                    @endforeach
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Total</div>
                                        <div class="main_extra_total_value ml-auto">{{$order->charges}}</div>
                                    </li>
                                </ul>
                            </div>

                            @if(count($orderCharges)==0)
                                <!-- Buttons -->
                                <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                                    <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                        <div class="button button_continue trans_200" id="add-charge-button"><span class="cursor-pointer">add charges</span></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section_container content-toggle-1" style="margin-top: 100px;">
            <div class="container">
                <div class="row">
                    <!-- Charges -->
                    <div class="col">
                        <div class="main_container">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Add Charge</div>
                                <div class="main_form_container">
                                    {{ Form::open(['route' => 'admin.order.storeCharge', 'method' => 'post', 'id' => 'charge_form', 'class' => 'main_form']) }}
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <!-- Title -->
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title[]" id="title" class="main_input" value="{{old('title')}}" required="required">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <!-- Title -->
                                            <label for="amount">Amount <span class="text-danger">*</span></label>
                                            <input type="number" min="0" step="0.01" name="amount[]" id="amount" class="main_input" value="{{old('amount')}}" required="required">
                                        </div>
                                    </div>
                                    <span id="more-charge-field"></span>
                                    <span class="cursor-pointer text-dark" id="add-more-charge-field">Add More...</span>
                                    <span class="cursor-pointer text-danger float-right" id="remove-field">Remove</span>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <!-- main Buttons -->
                            <div class="main_buttons d-flex flex-row align-items-start justify-content-start" style="margin-top: 32px;">
                                <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                    <div class="button button_continue trans_200 content-toggle-1 cursor-pointer" id="cancel-form-button"><span>Cancel</span></div>
                                    <div class="button button_update trans_200 content-toggle-1 cursor-pointer" id="submit-charge-button"><span>Save</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section_container" style="margin-top: 100px;">
            <div class="container">
                <div class="row">

                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Payments</div>
                                <ul class="main_extra_total_list">
                                    @foreach($orderPayments as $payment)
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="main_extra_total_title">{{$payment->title}}</div>
                                            <div class="main_extra_total_value ml-auto">৳ {{$payment->amount}}</div>
                                        </li>
                                    @endforeach
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Total</div>
                                        <div class="main_extra_total_value ml-auto">{{$order->paid}}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section_container main_extra_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="main_container">

                            <!-- Product Bar -->
                            <div class="main_bar">
                                <ul class="main_bar_list item_list d-flex flex-row align-items-center justify-content-start">
                                    <li>Product</li>
                                    <li>Department</li>
                                    <li>Type</li>
                                    <li>Price</li>
                                    <li>Quantity</li>
                                    <li>Weight</li>
                                    <li>Total</li>
                                </ul>
                            </div>

                            <!-- Product Items -->
                            <div class="main_items">
                                <ul class="main_items_list">
                                @foreach($orderDetails as $item)
                                    <!-- Product Item -->
                                        <li class="main_item item_list d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                                            {{--                                            <div class="item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">--}}
                                            {{--                                                <div class="item_name">{{$item->product_title.' - '.$item->product_variation_title}}</div>--}}
                                            {{--                                            </div>--}}
                                            <div class="item_color text-lg-center item_text item_name">{{$item->product_title.' - '.$item->product_variation_title}}</div>
                                            <div class="item_color text-lg-center item_text"><span>Department: </span>{{$item->department_title}}</div>
                                            <div class="item_color text-lg-center item_text"><span>Type: </span>{{$item->type_title}}</div>
                                            <div class="item_price text-lg-center item_text"><span>Price: </span>৳ {{$item->unit_price}}</div>
                                            <div class="item_price text-lg-center item_text"><span>Price: </span>{{$item->quantity.$item->unit_of_quantity}}</div>
                                            <div class="item_color text-lg-center item_text"><span>Weight: </span>{{$item->weight}}kg</div>
                                            <div class="item_total text-lg-center item_text"><span>Total: </span>৳ {{$item->price}}</div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Order Buttons -->
                            <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                                <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                    @if($order->payment_status==PAYMENT_PENDING_STATUS)<div class="button button_continue trans_200">
                                        <a href="{{route('admin.order.donePayment', encrypt($order->id))}}" data-toggle="tooltip" onclick="return confirm('Please, confirm \'Payment Done\' ?');">Payment Done</a></div>
                                    @endif
                                    @if($order->payment_status==PAYMENT_DONE_STATUS&&$order->shipping_status!=DELIVERY_COMPLETED_STATUS)<div class="button button_continue trans_200">
                                        <a href="{{route('admin.order.completeOrder', encrypt($order->id))}}" data-toggle="tooltip" onclick="return confirm('Please, confirm \'Order Complete\' ?');">Order Complete</a></div>
                                    @endif
                                    <div class="button button_update trans_200" id="update-order-button"><a href="{{route('admin.order')}}">close</a></div>
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
    <script src="{{asset('assets/js/order_details.js')}}"></script>
    <script>
        $('.content-toggle-1').hide();
        $('#remove-field').hide();
        $(document).ready(function () {
            $('#add-charge-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
            });
            $('#add-more-charge-field').on('click', function () {
                let extraField = '<div class="row">\n' +
                    '               <div class="col-sm-12 col-md-6">\n' +
                    '                   <label for="title">Title <span class="text-danger">*</span></label>\n' +
                    '                   <input type="text" name="title[]" id="title" class="main_input" value="" required="required">\n' +
                    '               </div>\n' +
                    '               <div class="col-sm-12 col-md-6">\n' +
                    '                   <label for="amount">Amount <span class="text-danger">*</span></label>\n' +
                    '                   <input type="number" min="0" step="0.01" name="amount[]" id="amount" class="main_input" value="" required="required">\n' +
                    '               </div>\n' +
                    '           </div>';
                $('#more-charge-field').append(extraField);
                $('#remove-field').show();
            });
            $('#remove-field').on('click', function () {
                $('#more-charge-field').find('.row').last().remove();
            });
            $('#cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-charge-button').on('click', function () {
                if(confirm('Please confirm, all charges added. You can\'t add more!')){ $('#charge_form').submit(); }
            });
        });
    </script>
@endsection
