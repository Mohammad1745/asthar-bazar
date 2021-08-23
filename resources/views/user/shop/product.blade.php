@extends('user.layouts.master')
@section('title', $product->title.' - '.$productVariation->title.' - Shop - '.TITLE_CORE)
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/product.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/product_responsive.css')}}">
@endsection
@section('content')
    <!-- Home -->

    <div class="home">
        <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{asset('assets/images/categories.jpg')}}" data-speed="0.8"></div>
        <div class="home_container">
            <div class="home_content">
                <div class="home_title">{{$product->title}}</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="{{route('shop.department', [encrypt($department->id), encrypt(null), encrypt(null)])}}">{{$department->title}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->

    <div class="product">
        <!-- Product Content -->
        <div class="section_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="product_content_container d-flex flex-lg-row flex-column align-items-start justify-content-start">
                            <div class="product_content order-lg-1 order-2">
                                <div class="product_content_inner">
                                    <div class="product_image_row">
                                        <div class="product_image_3 product_image"><img src="{{asset(productVariationImageViewPath().$productVariation->image)}}" alt="" height="100%" width="100%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="product_sidebar order-lg-2 order-1">
                                <form action="#" id="product_form" class="product_form">
                                    <div class="product_name">{{$product->title.' - '.$productVariation->title.' ('.$type->title.')'}}</div>
                                    <div class="product_price">৳ {{$productVariation->unit_price.'/'.$productVariation->unit_of_quantity}}</div>
                                    <div class="product_color @if($productVariation->quantity<=0) text-danger @endif">Weight: {{$productVariation->weight_per_unit}}kg</div>
                                    <div class="product_color @if($productVariation->quantity<=0) text-danger @endif">Available: {{$productVariation->quantity.' '.$productVariation->unit_of_quantity}}(s)</div>
                                    @if($productVariation->quantity>0) <a class="btn cart_button trans_200" href="{{route('cart.addProductVariation', encrypt($productVariation->id))}}">add to cart</a>
                                    @else <br><span class="font-weight-bold text-uppercase trans_200 text-info">Product Not Available</span>
                                    @endif
                                    <div class="similar_products_button trans_200"><a href="{{ route('cart') }}">view cart</a></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="product_color">{{$productVariation->description}}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/product.js')}}"></script>
@endsection
