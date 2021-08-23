@extends('user.layouts.master')
@section('title', __('Cart - '.TITLE_CORE))
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
                <div class="home_title">Cart</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart -->

    <div class="main_section">
        <div class="section_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="main_container">

                            <!-- main Bar -->
                            <div class="main_bar">
                                <ul class="main_bar_list item_list d-flex flex-row align-items-center justify-content-start">
                                    <li>Product</li>
                                    <li>Department</li>
                                    <li>Type</li>
                                    <li>Price</li>
                                    <li>Quantity</li>
                                    <li>Total</li>
                                </ul>
                            </div>

                            <!-- Cart Items -->
                            <div class="main_items">
                                <ul class="main_items_list">
                                    @foreach($cartDetails as $item)
                                        <!-- Cart Item -->
                                        <li class="main_item item_list d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                                            <div class="item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                                                <div><div class="item_image"><img src="{{asset(productVariationImageViewPath().$item->image)}}" height="60" width="100" alt=""></div></div>
                                                <div class="item_name">
                                                    <a href="{{route('shop.department.productVariation', encrypt($item->product_variation_id))}}" target="_blank">
                                                        {{$item->product_title.' - '.$item->title}}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="item_color text-lg-center item_text"><span>Department: </span>{{$item->department_title}}</div>
                                            <div class="item_color text-lg-center item_text"><span>Type: </span>{{$item->type_title}}</div>
                                            <div class="item_price text-lg-center item_text"><span>Price: </span>৳ {{$item->unit_price}}</div>
                                            <div class="item_quantity_container">
                                                <div class="item_quantity ml-lg-auto mr-lg-auto text-center">
                                                    <span class="item_text item_num" id="item-quantity-{{$item->id}}">{{$item->quantity}}</span>
                                                    <div class="qty_sub qty_button trans_200 text-center" data-id="{{$item->id}}"><span>-</span></div>
                                                    <div class="qty_add qty_button trans_200 text-center" data-id="{{$item->id}}"><span>+</span></div>
                                                </div>
                                            </div>
                                            <div class="item_total text-lg-center item_text"><span>Total: </span>৳ {{$item->price}}</div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Cart Buttons -->
                            <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                                <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                    <div class="button button_continue trans_200"><a href="{{ route('shop') }}">continue shopping</a></div>
                                    <div class="button button_clear trans_200"><a href="{{ route('cart.clear') }}">clear cart</a></div>
                                    <div class="button button_update trans_200" id="update-cart-button"><span class="cursor-pointer">update cart</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section_container main_extra_container">
            <div class="container">
                <div class="row">

                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_coupon pb-0">
                                <div class="main_extra_title">Coupon code</div>
                                <div class="coupon_form_container">
                                    <form action="#" id="coupon_form" class="coupon_form">
                                        <input type="text" class="coupon_input" required="required">
                                        <button class="coupon_button trans_200">apply code</button>
                                    </form>
                                </div>
                            </div>
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Cart Total</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Subtotal</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$cart->price}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Coupon</div>
                                        <div class="main_extra_total_value ml-auto">৳ 0</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Total</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$cart->price}}</div>
                                    </li>
                                </ul>
                                <div class="button_extend trans_200"><a href="{{route('cart.checkout')}}">proceed to checkout</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hidden Form To Update Cart -->
    {{ Form::open(['route' => 'cart.update', 'method' => 'post', 'id' => 'update-cart-form', 'class' => 'hidden']) }}
        @foreach($cartDetails as $item)
            <input name="id[]" value="{{$item->id}}" >
            <input name="product_variation_id[]" value="{{$item->product_variation_id}}" >
            <input name="quantity[]" id="quantity-{{$item->id}}" value="{{$item->quantity}}" >
        @endforeach
    {{ Form::close() }}
@endsection

@section('script')
    <script src="{{asset('assets/js/cart.js')}}"></script>
    <script>
        $('.hidden').hide();
        $(document).ready(function () {
            $('.qty_button').on('click', function () {
                let id = $(this).data('id');
                let value = $('#item-quantity-' + id).html();
                $('#quantity-' + id).val(value);
            });
            $('#update-cart-button').on('click', function () {
                $('#update-cart-form').submit();
            });
        });
    </script>
@endsection
