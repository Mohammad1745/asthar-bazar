@extends('user.layouts.master')
@section('title', __('Contact - '.TITLE_CORE))
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
                <div class="home_title">Contact</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact -->

    <div class="main_section">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Contact -->
                    <div class="col">
                        <div class="main_container">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Contact</div>
                                <div class="main_form_container">
                                    {{ Form::open(['route' => 'contactMessage.store', 'method' => 'post', 'id' => 'contact_form', 'class' => 'main_form']) }}
                                    <div>
                                        <!-- Country -->
                                        <label for="to">To <span class="text-danger">*</span></label>
                                        <input type="text" name="to" id="to" class="main_input"value="{{old('to')}}" required="required">
                                    </div>
                                    <div>
                                        <!-- Address -->
                                        <label for="message">Message <span class="text-danger">*</span></label>
                                        <textarea type="text" name="message" id="message" class="main_input" required="required">{{old('message')}}</textarea>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <!-- Contact Buttons -->
                            <div class="main_buttons d-flex flex-row align-items-start justify-content-start">
                                <div class="main_buttons_inner ml-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                    <div class="button button_update trans_200 cursor-pointer" id="submit-contact-button"><span>Send</span></div>
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
    <script src="{{asset('assets/js/profile.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#submit-contact-button').on('click', function () {
                $('#contact_form').submit();
            });
        });
    </script>
@endsection
