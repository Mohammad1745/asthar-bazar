@extends('auth.layouts.master')
@section('title', __('Reset Password - '.TITLE_CORE))
@section('content')

    <div class="main_section content-toggle-1" style="padding-top: 100px;">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Category -->
                    <div class="col">
                        <div class="main_container">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">{{__('Reset Password')}}</div>
                                <div class="main_form_container">
                                    {{ Form::open(['route' => 'forgetPasswordCodeProcess', 'method' => 'post', 'id' => 'auth_form', 'class' => 'main_form', 'autocomplete' => 'off']) }}
                                        <div class="">
                                            <label for="main_name">{{__('Reset Password Code')}}</label>
                                            <input name="reset_password_code" id="main_name" class="main_input" type="text" value="{{ old('reset_password_code') }}" autocomplete="off" required="required">
                                            @if (isset($errors) && $errors->has('reset_password_code'))
                                                <span class="text-danger"><strong>{{ $errors->first('reset_password_code') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="">
                                            <label for="main_name">{{__('New Password')}}</label>
                                            <input name="new_password" id="main_name" class="main_input" type="password" required="required">
                                            @if (isset($errors) && $errors->has('new_password'))
                                                <span class="text-danger"><strong>{{ $errors->first('new_password') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="">
                                            <label for="main_name">{{__('Confirm Password')}}</label>
                                            <input name="password_confirmation" id="main_name" class="main_input" type="password" required="required">
                                            @if (isset($errors) && $errors->has('password_confirmation'))
                                                <span class="text-danger"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="button_extend trans_200 cursor-pointer">
                                            <button class="btn" type="submit">{{__('Submit')}}</button>
                                        </div>
                                    {{ Form::close() }}
                                    <div class="mt-3 text-center">
                                        <a href="{{ route('signIn') }}" class="text-muted"><u>{{__('Sign In')}}</u></a>
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
