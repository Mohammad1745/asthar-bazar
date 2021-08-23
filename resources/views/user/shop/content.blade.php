@extends('user.layouts.master')
@if(isset($currentDepartment))
    @section('title', $currentDepartment->title . ' - Shop - Maswala - Fresh & Frozen Fish & Shrimp Shop')
@else
    @section('title', __('Shop - '.TITLE_CORE))
@endif
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/master.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/shop.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/shop_responsive.css')}}">
@endsection
@section('content')
    <!-- Home -->

    <div class="home">
        <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{asset('assets/images/categories.jpg')}}" data-speed="0.8"></div>
        <div class="home_container">
            <div class="home_content">
                <div class="home_title">@if(isset($currentDepartment)) {{$currentDepartment->title}} @else Shop @endif</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        @if(isset($currentDepartment))
                            <li><a href="">{{$currentDepartment->title}}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->

    <div class="products">
        <!-- Sorting & Filtering -->
        <div class="products_bar">
            <div class="section_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="products_bar_content d-flex flex-column flex-xxl-row align-items-start align-items-xxl-center justify-content-start">
                                <div class="product_categories">
                                    <ul class="d-flex flex-row align-items-start justify-content-start flex-wrap">
                                        @foreach ($departments as $department)
                                            <li class="cursor-pointer @if(isset($currentDepartment)&&$currentDepartment->title == $department->title) active @endif">
                                                <a href="{{route('shop.department', [encrypt($department->id), encrypt(null), encrypt(null)])}}">{{$department->title}}</a>
                                            </li>
                                        @endforeach
                                        @foreach ($upcomingDepartments as $department)
                                            <li class="cursor-pointer" title="Upcoming Department">
                                                <span id="upcoming-department">{{$department->title}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if(isset($currentDepartment))
{{--                                    <div class="product_categories">--}}
{{--                                        <ul class="d-flex flex-row align-items-start justify-content-start flex-wrap">--}}
{{--                                            <li class="cursor-pointer active"><a href="#">All</a></li>--}}
{{--                                            <li class="cursor-pointer"><a href="#">Hot Products</a></li>--}}
{{--                                            <li class="cursor-pointer"><a href="#">New Products</a></li>--}}
{{--                                            <li class="cursor-pointer"><a href="#">Sale Products</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
                                    <div class="products_bar_side ml-xxl-auto d-flex flex-row align-items-center justify-content-start">
                                        <div class="products_dropdown mr-3">
                                            <div class="isotope_sorting_text"><span>Default Sorting</span><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                            <ul>
                                                <li class="cursor-pointer item_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'>Default</li>
                                                <li class="cursor-pointer item_sorting_btn" data-isotope-option='{ "sortBy": "name" }'>Name</li>
                                                <li class="cursor-pointer item_sorting_btn" data-isotope-option='{ "sortBy": "price" }'>Price</li>
                                            </ul>
                                        </div>
                                        <div class="products_dropdown text-right ml-3 mr-3">
                                            <div class="isotope_filter_text"><span>{{$currentCategory['title']}}</span><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                            <ul>
                                                <li class="cursor-pointer item_filter_btn">
                                                    <a href="{{route('shop.department', [encrypt($currentDepartment->id), encrypt(null), encrypt($currentType['id'])])}}">All</a>
                                                </li>
                                                @foreach($categories as $category)
                                                    <li class="cursor-pointer item_filter_btn">
                                                        <a href="{{route('shop.department', [encrypt($currentDepartment->id), encrypt($category->id), encrypt($currentType['id'])])}}">{{$category->title}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="products_dropdown text-right ml-3 mr-3">
                                            <div class="isotope_filter_text"><span>{{$currentType['title']}}</span><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                            <ul>
                                                <li class="cursor-pointer item_filter_btn">
                                                    <a href="{{route('shop.department', [encrypt($currentDepartment->id), encrypt($currentCategory['id']), encrypt(null)])}}">All</a>
                                                </li>
                                                @foreach($types as $type)
                                                    <li class="cursor-pointer item_filter_btn">
                                                        <a style="width: 100%;" href="{{route('shop.department', [encrypt($currentDepartment->id), encrypt($currentCategory['id']), encrypt($type->id)])}}">{{$type->title}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                                <div class="product_price">{{$productVariation->unit_price.'tk-'.$productVariation->unit_of_quantity}}@if($productVariation->unit_price!=$productVariation->regular_price) <span><del>{{'৳'.$productVariation->regular_price}}</del></span> @endif</div>
                                                @if($productVariation->quantity>0)<div class="product_button ml-auto mr-auto trans_200"><a href="{{route('cart.addProductVariation', encrypt($productVariation->id))}}">add to cart</a></div>
                                                @else <br><span class="font-weight-bold text-uppercase trans_200 text-info">Not Available</span>
                                                @endif
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
@endsection

@section('script')
    <script src="{{asset('assets/js/categories.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#upcoming-department').on('click', function () {
                alert('Department is arriving soon!');
            });
        });
    </script>
@endsection
