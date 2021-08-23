@extends('super_admin.layouts.master')
@section('title', __('Message Details - '.TITLE_CORE))
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
                <div class="home_title">Message</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('superAdmin.account')}}">Account</a></li>
                        <li><a href="{{route('superAdmin.contact')}}">Contact</a></li>
                        <li>Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Message -->

    <div class="main_section">

        <div class="section_container content-toggle-0">
            <div class="container">
                <div class="row">

                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Message</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Name</div>
                                        <div class="main_extra_total_value ml-auto">{{$message->first_name.' '.$message->last_name}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Email</div>
                                        <div class="main_extra_total_value ml-auto">{{$message->email}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">To</div>
                                        <div class="main_extra_total_value ml-auto">{{$message->to}}</div>
                                    </li>
                                    @if (!is_null($message->replied_by))
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="main_extra_total_title">Replied By</div>
                                            <div class="main_extra_total_value ml-auto">{{$message->replied_by}}</div>
                                        </li>
                                    @endif
                                    <li class="main_extra_total_value ml-auto text-justify">
                                        <div class="main_extra_total_title">{{$message->message}}</div>
                                    </li>
                                    @if (!is_null($message->replied_by))
                                        <li class="main_extra_total_value ml-auto text-justify">
                                            <div class="main_extra_total_title">{{$message->reply}}</div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                @if (is_null($message->replied_by))
                    <!-- Buttons -->
                    <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                        <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                            <div class="button button_continue trans_200" id="reply-contact-message-button"><span class="cursor-pointer">Reply</span></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="section_container content-toggle-1">
            <div class="container">
                <div class="row">

                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Reply</div>
                                <div class="main_form_container">
                                    {{ Form::open(['route' => 'superAdmin.contactMessage.reply', 'method' => 'post', 'id' => 'contact_message_form', 'class' => 'main_form']) }}
                                    <input type="hidden" name="message_id" value="{{$message->id}}">
                                    <div>
                                        <!-- Message -->
                                        <label for="message">Message</label>
                                        <textarea name="message" id="message" class="main_input" cols="30" rows="10" required="required">{{old('message')}}</textarea>
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
                        <div class="button button_update trans_200" id="submit-contact-message-button"><span class="cursor-pointer">Send</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/category_details.js')}}"></script>
    <script>
        $('.content-toggle-1').hide();
        $(document).ready(function () {
            $('#reply-contact-message-button').on('click', function () {
                // $('.content-toggle-0').hide();
                $('.content-toggle-1').show();
            });
            $('#cancel-form-button').on('click', function () {
                location.reload();
            });
            $('#submit-contact-message-button').on('click', function () {
                $('#contact_message_form').submit();
            });
        });
    </script>
@endsection
