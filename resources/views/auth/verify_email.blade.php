@extends('auth.layouts.master')
@section('title', __('Verify Email - '.TITLE_CORE))
@section('content')

    <div class="main_section content-toggle-1" style="padding-top: 100px;">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Category -->
                    <div class="col">
                        <div class="main_container">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">{{__('Verify Email ')}} <span style="font-size: 14px;">(Check Your Email For The Code.)</span></div>
                                <div class="main_form_container">

                                    {{ Form::open(['route' => 'verifyEmailProcess', 'method' => 'post', 'id' => 'auth_form', 'class' => 'main_form']) }}
                                        <div>
                                            <label for="main_name">{{__('Verification Code')}}</label>
                                            <input name="verification_code" id="main_name" class="main_input" type="text" value="{{ old('verification_code') }}" required="required">
                                            @if (isset($errors) && $errors->has('verification_code'))
                                                <span class="text-danger"><strong>{{ $errors->first('verification_code') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="button_extend trans_200 cursor-pointer">
                                            <button class="btn" type="submit">{{__('Submit')}}</button>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
