@extends('admin.layouts.master')
@section('title', __('Collection Item Details - '.TITLE_CORE))
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
                <div class="home_title text-capitalize">{{$collectionItem->collection_title}} Collections</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li><a href="{{route('admin.collection')}}">Collection</a></li>
                        <li><a href="{{route('admin.collection.details', encrypt($collectionItem->collection_id))}}">Details</a></li>
                        <li>Item</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Collection Item -->

    <div class="main_section ">
        <div class="section_container content-toggle-0">
            <div class="container">
                <div class="row">

                    <!-- Item Details -->
                    <div class="col-xxl-12">
                        <div class="main_extra">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Details</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Product</div>
                                        <div class="main_extra_total_value ml-auto">{{$collectionItem->product_title}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Variation</div>
                                        <div class="main_extra_total_value ml-auto">{{$collectionItem->title}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Type</div>
                                        <div class="main_extra_total_value ml-auto">{{$collectionItem->type_title}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Regular Price</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$collectionItem->regular_price}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Discount</div>
                                        <div class="main_extra_total_value ml-auto">{{$collectionItem->discount}}%</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Unit Price</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$collectionItem->unit_price}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Expire Date</div>
                                        <div class="main_extra_total_value ml-auto">{{$collectionItem->expires_at}}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        @if ($collectionItem->collection_title!='new')
                            <!-- Item Buttons -->
                            <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                                <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                    <div class="button button_continue trans_200" id="update-collection-item-button"><span class="cursor-pointer">Update</span></div>
                                    <div class="button button_update trans_200">
                                        <a href="{{route('admin.collection.deleteItem', encrypt($collectionItem->id))}}" data-toggle="tooltip" onclick="return confirm('Are you sure to delete this ?');">Delete</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Item Form -->

        <div class="main_section content-toggle-1 pt-0">
            <div class="section_container">
                <div class="container">
                    <div class="row">
                        <!-- Collection -->
                        <div class="col">
                            <div class="main_container">
                                <div class="main_extra_content main_extra_total">
                                    <div class="main_extra_title">Edit Item of {{$collectionItem->collection_title}}</div>
                                    <div class="main_form_container main_form_container">
                                        {{ Form::open(['route' => 'admin.collection.updateItem', 'method' => 'post', 'id' => 'collection_item_form', 'class' => 'main_form']) }}
                                        <input type="hidden" name="id" value="{{$collectionItem->id}}">
                                        <input type="hidden" name="collection_id" value="{{$collectionItem->collection_id}}">
                                        <div>
                                            <!-- Variation -->
                                            <label for="product_variation_id"> Item <span class="text-danger">*</span></label>
                                            <select name="product_variation_id" id="product_variation_id" class="main_input">
                                                <option value="{{null}}">Select Item</option>
                                                @foreach($productVariations as $productVariation)
                                                    <option value="{{$productVariation->id}}" @if($collectionItem->product_variation_id==$productVariation->id) selected @endif >
                                                        {{$productVariation->product_title.' - '.$productVariation->title.' ('.$productVariation->type_title.')'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <!-- Discount -->
                                                <label for="discount">Discount(%) <span class="text-danger">*</span></label>
                                                <input type="number" min="0" step="0.01" name="discount" id="discount" class="main_input" @if(is_null(old('discount'))) value="{{$collectionItem->discount}}" @else value="{{old('discount')}}" @endif required="required">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <!-- Expires At -->
                                                <label for="expires_at">Expires At <span class="text-danger">*</span></label>
                                                <input type="date" name="expires_at" id="expires_at" class="main_input" @if(is_null(old('expires_at'))) value="{{$collectionItem->expires_at}}" @else value="{{old('expires_at')}}" @endif required="required">
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                <!-- Collection Item Buttons -->
                                <div class="main_buttons d-flex flex-row align-items-start justify-content-start" style="margin-top: 32px;">
                                    <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                        <div class="button button_continue trans_200 cursor-pointer cancel-form-button"><span>Cancel</span></div>
                                        <div class="button button_update trans_200 cursor-pointer" id="submit-collection-item-button"><span>Save</span></div>
                                    </div>
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
    <script src="{{asset('assets/js/variation.js')}}"></script>
    <script>
        $('.content-toggle-1').hide();
        $(document).ready(function () {
            $('#update-collection-item-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
            });
            $('.cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-collection-item-button').on('click', function () {
                $('#collection_item_form').submit();
            });
        });
    </script>
@endsection
