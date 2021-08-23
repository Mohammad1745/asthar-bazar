@extends('admin.layouts.master')
@section('title', __('Product Variation Details - '.TITLE_CORE))
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
                <div class="home_title">{{$productVariation->product_title.' '.$productVariation->title}}</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('admin.department')}}">Department</a></li>
                        <li><a href="{{route('admin.product')}}">Product</a></li>
                        <li><a href="{{route('admin.product.details', encrypt($productVariation->product_id))}}">Details</a></li>
                        <li>Variation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Variation -->

    <div class="main_section ">

        <div class="main_section content-toggle-0">

            <div class="section_container">
                <div class="container">
                    <div class="row">

                        <!-- Shipping & Delivery -->
                        <div class="col-xxl-12">
                            <div class="main_extra">
                                <div class="product_image_3">
                                    <img src="{{asset(productVariationImageViewPath().$productVariation->image)}}" alt="" height="100%" width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-xxl-12">
                            <div class="main_extra main_extra_1">
                                <div>{{$productVariation->description}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="main_container">

                                <!-- Cart Buttons -->
                                <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                                    <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                        <div class="button button_continue trans_200" id="update-product-variation-button"><span class="cursor-pointer">Update</span></div>
                                        <div class="button button_update trans_200">
                                            <a href="{{route('admin.product.deleteVariation', encrypt($productVariation->id))}}" data-toggle="tooltip" onclick="return confirm('Are you sure to delete this ?');">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section_container content-toggle-0">
            <div class="container">
                <div class="row">

                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Details</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Product</div>
                                        <div class="main_extra_total_value ml-auto">{{$productVariation->product_title}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Variation</div>
                                        <div class="main_extra_total_value ml-auto">{{$productVariation->title}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Type</div>
                                        <div class="main_extra_total_value ml-auto">{{$productVariation->type_title}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Manufacturing Cost</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$productVariation->manufacturing_cost}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Regular Price</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$productVariation->regular_price}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Unit Price</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$productVariation->unit_price}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Quantity</div>
                                        <div class="main_extra_total_value ml-auto">{{$productVariation->quantity}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Unit of Quantity</div>
                                        <div class="main_extra_total_value ml-auto">{{$productVariation->unit_of_quantity}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Weight Per Unit</div>
                                        <div class="main_extra_total_value ml-auto">{{$productVariation->weight_per_unit}}kg</div>
                                    </li>
                                    @if (!$productVariation->status)
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="main_extra_total_title">Available</div>
                                            <div class="main_extra_total_value ml-auto">{{$productVariation->available_at}}</div>
                                        </li>
                                    @endif
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Status</div>
                                        <div class="main_extra_total_value ml-auto">
                                            @if ($productVariation->status) Available
                                            @else Not Available
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main_section content-toggle-1 pt-0">

            <div class="section_container">
                <div class="container">
                    <div class="row">
                        <!-- Product -->
                        <div class="col">
                            <div class="main_container">
                                <div class="main_extra_content main_extra_total">
                                    <div class="main_extra_title">Edit</div>
                                    <div class="main_form_container main_form_container">
                                        {{ Form::open(['route' => 'admin.product.updateVariation', 'method' => 'post', 'files' => 'true', 'id' => 'product_variation_form', 'class' => 'main_form']) }}
                                        <input type="hidden" name="id" value="{{$productVariation->id}}">
                                        <div>
                                            <!-- Title -->
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" class="main_input" @if(is_null(old('title'))) value="{{$productVariation->title}}" @else  value="{{old('title')}}" @endif required="required">
                                        </div>
                                        <div>
                                            <!-- Type -->
                                            <label for="type_id"> Type <span class="text-danger">*</span></label>
                                            <select name="type_id" id="type_id" class="main_input">
                                                <option value="{{null}}">Select Type</option>
                                                @foreach($types as $type)
                                                    <option value="{{$type->id}}" @if($type->id == $productVariation->type_id) selected @endif >{{$type->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <!-- Title -->
                                                <label for="quantity">Quantity <span class="text-danger">*</span></label>
                                                <input type="number" name="quantity" min="0" id="quantity" class="main_input" @if(is_null(old('quantity'))) value="{{$productVariation->quantity}}" @else value="{{old('quantity')}}" @endif required="required">
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <!-- Title -->
                                                <label for="unit_of_quantity">Unit Of Quantity <span class="text-danger">*</span></label>
                                                <input type="text" name="unit_of_quantity" id="unit_of_quantity" class="main_input" @if(is_null(old('unit_of_quantity'))) value="{{$productVariation->unit_of_quantity}}" @else value="{{old('unit_of_quantity')}}" @endif required="required">
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <!-- Title -->
                                                <label for="weight_per_unit">Weight Per Unit (kg) <span class="text-danger">*</span></label>
                                                <input type="number" step="0.001" min="0" name="weight_per_unit" id="weight_per_unit" class="main_input" @if(is_null(old('weight_per_unit'))) value="{{$productVariation->weight_per_unit}}" @else value="{{old('weight_per_unit')}}" @endif required="required">
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <!-- Title -->
                                                <label for="manufacturing_cost">Manufacturing Cost <span class="text-danger">*</span></label>
                                                <input type="number" step="0.01" min="0" name="manufacturing_cost" id="manufacturing_cost" class="main_input" @if(is_null(old('manufacturing_cost'))) value="{{$productVariation->manufacturing_cost}}" @else value="{{old('manufacturing_cost')}}" @endif required="required">
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <!-- Title -->
                                                <label for="price">Regular Price <span class="text-danger">*</span></label>
                                                <input type="number" step="0.01" min="0" name="regular_price" id="regular_price" class="main_input" @if(is_null(old('regular_price'))) value="{{$productVariation->regular_price}}" @else value="{{old('regular_price')}}" @endif required="required">
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <!-- Title -->
                                                <label for="status">Status <span class="text-danger">*</span></label>
                                                <select name="status" id="status" class="main_input">
                                                    <option value="1" @if ($productVariation->status) selected @endif>Active</option>
                                                    <option value="0" @if (!$productVariation->status) selected @endif >Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <!-- Available At -->
                                            <label for="available_at">Available At <span class="text-danger">*</span></label>
                                            <input type="date" name="available_at" id="available_at" class="main_input" @if(is_null(old('available_at'))) value="{{$productVariation->available_at}}" @else  value="{{old('available_at')}}" @endif required="required">
                                        </div>
                                        <div>
                                            <!-- Image -->
                                            <label for="image">Image (Recommended W:300px, H:200px) <span class="text-danger">*</span></label>
                                            <input name="image" type="file" id="input-file-now" class="dropify" data-default-file="{{asset(productVariationImageViewPath().$productVariation->image)}}">
                                        </div>
                                        <div>
                                            <!-- Description -->
                                            <label for="description">Description <span class="text-danger">*</span></label>
                                            <textarea name="description" id="description" class="main_input" cols="30" rows="10" required="required">@if(is_null(old('description'))){{$productVariation->description}}@else{{old('description')}}@endif</textarea>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                <!-- Product Buttons -->
                                <div class="main_buttons d-flex flex-row align-items-start justify-content-start" style="margin-top: 32px;">
                                    <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                        <div class="button button_continue trans_200 cursor-pointer cancel-form-button"><span>Cancel</span></div>
                                        <div class="button button_update trans_200 cursor-pointer" id="submit-product-variation-button"><span>Save</span></div>
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
    <script type='text/javascript' src='{{ asset('assets/plugins/dropify/dropify.min.js') }}'></script>
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
    <script>
        $('.content-toggle-1').hide();
        $(document).ready(function () {
            $('#update-product-variation-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
            });
            $('.cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-product-variation-button').on('click', function () {
                $('#product_variation_form').submit();
            });
        });
    </script>
@endsection
