@extends('admin.layouts.master')
@section('title', __('Dashboard - '.TITLE_CORE))

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/home.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/home_responsive.css')}}">
@endsection

@section('content')

    <!-- Home -->

    <div class="home">

        <!-- Home Slider -->
        <div class="home_slider_container">
            <div class="owl-carousel owl-theme home_slider">

                <!-- Slide -->
                @for($i=0; $i<3; $i++)
                    <div class="owl-item">
                        <div class="background_image" style="background-image:url({{$sliderImage}})"></div>
                        <div class="home_content_container">
                            <div class="home_content">
                                <div class="home_discount d-flex flex-row align-items-end justify-content-start">
                                    <div class="home_discount_num">{{$newCollectionDiscount}}</div>
                                    <div class="home_discount_text">Discount on the</div>
                                </div>
                                <div class="home_title">New Collection</div>
{{--                                <div class="button button_1 home_button trans_200"><a href="categories.html">Shop NOW!</a></div>--}}
                            </div>
                        </div>
                    </div>
                @endfor

            </div>

            <!-- Home Slider Navigation -->
            <div class="home_slider_nav home_slider_prev trans_200"><div class=" d-flex flex-column align-items-center justify-content-center"><img src="{{asset('assets/images/prev.png')}}" alt=""></div></div>
            <div class="home_slider_nav home_slider_next trans_200"><div class=" d-flex flex-column align-items-center justify-content-center"><img src="{{asset('assets/images/next.png')}}" alt=""></div></div>

        </div>
    </div>

    <!-- Products -->

    <div class="products">
        <div class="section_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="products_container grid">

                            @if (count($productVariations)==0)
                                No Product Found
                            @else
                                @foreach($productVariations as $productVariation)
                                <!-- Product -->
                                    <div class="product grid-item @if(isset($productVariation['collection_item'])) new @endif">
                                        <div class="product_inner box-shadow">
                                            <div class="product_image">
                                                <a href="{{route('shop.department.productVariation', encrypt($productVariation->id))}}" target="_blank">
                                                    <img src="{{asset(productVariationImageViewPath().$productVariation->image)}}" height="200" width="300" alt="">
                                                </a>
                                                @if(isset($productVariation['collection_item'])) <div class="product_tag">{{$productVariation['collection_item']['collection_title']}}</div> @endif
                                            </div>
                                            <div class="product_content text-center">
                                                <div class="product_title">
                                                    <a href="{{route('shop.department.productVariation', encrypt($productVariation->id))}}" target="_blank">{{$productVariation->product_title.' - '.$productVariation->title.' ('.$productVariation->type_title.')'}}</a>
                                                </div>
                                                <div class="product_price">{{$productVariation->unit_price.'tk/'.$productVariation->unit_of_quantity}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter -->

{{--    <div class="newsletter">--}}
{{--        <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{asset('assets/images/newsletter.jpg')}}" data-speed="0.8"></div>--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-8 offset-lg-2">--}}
{{--                    <div class="newsletter_content text-center">--}}
{{--                        <div class="newsletter_title_container">--}}
{{--                            <div class="newsletter_title">subscribe to our newsletter</div>--}}
{{--                            <div class="newsletter_subtitle">we won't spam, we promise!</div>--}}
{{--                        </div>--}}
{{--                        <div class="newsletter_form_container">--}}
{{--                            <form action="#" id="newsletter_form" class="newsletter_form">--}}
{{--                                <input type="email" class="newsletter_input" placeholder="your e-mail here" required="required">--}}
{{--                                <button class="newsletter_button">submit</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection

@section('script')
    <script src="{{asset('assets/js/custom.js')}}"></script>
@endsection
