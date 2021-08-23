@extends('admin.layouts.master')
@section('title', __('Collection Details - '.TITLE_CORE))
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
                <div class="home_title text-capitalize">{{$collection->title}}</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li><a href="{{route('admin.collection')}}">Collection</a></li>
                        <li>Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Collection -->

    <div class="main_section" style="padding-top: 100px;">

        <div class="section_container content-toggle-0">
            <div class="container">
                <div class="row">

                    <!-- Details -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Collection</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Title</div>
                                        <div class="main_extra_total_value ml-auto">{{$collection->title}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Discount</div>
                                        <div class="main_extra_total_value ml-auto">{{$collection->discount}}%</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Expire Date</div>
                                        <div class="main_extra_total_value ml-auto">{{$collection->expires_at}}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Collection Buttons -->
                <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                    <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                        @if($collection->title=='new')
                            <div class="button button_continue trans_200"><a href="{{route('admin.collection.refreshItem', encrypt($collection->id))}}">Refresh Items</a></div>
                        @else
                            <div class="button button_continue trans_200" id="add-collection-item-button"><span class="cursor-pointer">Add Item</span></div>
                        @endif
                        <div class="button button_clear trans_200" id="update-collection-button"><span class="cursor-pointer">Update</span></div>
                        @if($collection->title!='new')
                            <div class="button button_update trans_200">
                                <a href="{{route('admin.collection.delete', encrypt($collection->id))}}" data-toggle="tooltip" onclick="return confirm('Are you sure to delete this ?');">Delete</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Item List -->

        <div class="section_container main_extra_container content-toggle-0 content-toggle-00">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="main_container">
                            <!-- Collection Items -->
                            <div class="collection_items border-0">
                                <table id="collection-item-table" class="table collection-item-table table-bordered text-center mb-0" style="width: 100%; overflow-x: scroll;">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Title')}}</th>
                                        <th class="all">{{__('Regular Price')}}</th>
                                        <th class="all">{{__('Discount')}}</th>
                                        <th class="all">{{__('Net Price')}}</th>
                                        <th class="all">{{__('Expire Date')}}</th>
                                        <th class="all">{{__('Actions')}}</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Collection Update Form -->

        <div class="main_section content-toggle-1 pt-0">
            <div class="section_container">
                <div class="container">
                    <div class="row">
                        <!-- Collection -->
                        <div class="col">
                            <div class="main_container">
                                <div class="main_extra_content main_extra_total">
                                    <div class="main_extra_title">Edit Collection</div>
                                    <div class="main_form_container main_form_container">
                                        {{ Form::open(['route' => 'admin.collection.update', 'method' => 'post', 'id' => 'collection_form', 'class' => 'main_form']) }}
                                        <input type="hidden" name="id" value="{{$collection->id}}">
                                        <div>
                                            <!-- Title -->
                                            <label for="title">Title (lowercase) <span class="text-danger">*</span></label>
                                            <input type="hidden" name="title" value="{{$collection->title}}">
                                            <input type="text"  id="title" class="main_input" value="{{$collection->title}}" required="required" @if($collection->title=='new') disabled @endif>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <!-- Discount -->
                                                <label for="discount">Discount(%) <span class="text-danger">*</span></label>
                                                <input type="number" min="0" step="0.01" name="discount" id="discount" class="main_input" @if(is_null(old('discount'))) value="{{$collection->discount}}" @else value="{{old('discount')}}" @endif required="required">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <!-- Expires At -->
                                                <label for="expires_at">Expires At <span class="text-danger">*</span></label>
                                                <input type="date" name="expires_at" id="expires_at" class="main_input" @if(is_null(old('expires_at'))) value="{{$collection->expires_at}}" @else value="{{old('expires_at')}}" @endif required="required">
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                <!-- Collection Buttons -->
                                <div class="main_buttons d-flex flex-row align-items-start justify-content-start" style="margin-top: 32px;">
                                    <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                        <div class="button button_continue trans_200 cursor-pointer cancel-form-button"><span>Cancel</span></div>
                                        <div class="button button_update trans_200 cursor-pointer" id="submit-collection-button"><span>Save</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Store Item Form -->

        <div class="main_section content-toggle-2 pt-0">
            <div class="section_container">
                <div class="container">
                    <div class="row">
                        <!-- Collection -->
                        <div class="col">
                            <div class="main_container">
                                <div class="main_extra_content main_extra_total">
                                    <div class="main_extra_title">Add Item of {{$collection->title}}</div>
                                    <div class="main_form_container main_form_container">
                                        {{ Form::open(['route' => 'admin.collection.storeItem', 'method' => 'post', 'id' => 'collection_item_form', 'class' => 'main_form']) }}
                                        <input type="hidden" name="collection_id" value="{{$collection->id}}">
                                        <div>
                                            <!-- Variation -->
                                            <label for="product_variation_id"> Item <span class="text-danger">*</span></label>
                                            <select name="product_variation_id" id="product_variation_id" class="main_input">
                                                <option value="{{null}}">Select Item</option>
                                                @foreach($productVariations as $productVariation)
                                                    <option value="{{$productVariation->id}}" >{{$productVariation->product_title.' - '.$productVariation->title.' ('.$productVariation->type_title.')'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <!-- Discount -->
                                                <label for="discount">Discount(%) <span class="text-danger">*</span></label>
                                                <input type="number" min="0" step="0.01" name="discount" id="discount" class="main_input" @if(is_null(old('discount'))) value="{{$collection->discount}}" @else value="{{old('discount')}}" @endif required="required">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <!-- Expires At -->
                                                <label for="expires_at">Expires At <span class="text-danger">*</span></label>
                                                <input type="date" name="expires_at" id="expires_at" class="main_input" @if(is_null(old('expires_at'))) value="{{$collection->expires_at}}" @else value="{{old('expires_at')}}" @endif required="required">
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                <!-- Collection Buttons -->
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
    <script src="{{asset('assets/js/category_details.js')}}"></script>
    <script>
        $('#collection-item-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('admin.collection.itemList', encrypt($collection->id))}}',
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
                {"data": "regular_price"},
                {"data": "discount"},
                {"data": "net_price"},
                {"data": "expires_at"},
                {"data": "actions", orderable: false, searchable: false}
            ]
        });
    </script>
    <script>
        $('.content-toggle-1').hide();
        $('.content-toggle-2').hide();
        $(document).ready(function () {
            $('#update-collection-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
            });
            $('#add-collection-item-button').on('click', function () {
                $('.content-toggle-0').hide();
                $('.content-toggle-2').show();
            });
            $('.cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-collection-button').on('click', function () {
                $('#collection_form').submit();
            });
            $('#submit-collection-item-button').on('click', function () {
                $('#collection_item_form').submit();
            });
        });
    </script>
@endsection
