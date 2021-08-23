@extends('auth.layouts.master')
@section('title', __('Sign Up - '.TITLE_CORE))
@section('content')

    <div class="main_section content-toggle-1" style="padding-top: 100px;">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Category -->
                    <div class="col">
                        <div class="main_container">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">{{__('Sign Up')}}</div>
                                <div class="main_form_container">
                                    {{ Form::open(['route' => 'signUpProcess', 'method' => 'post', 'id' => 'auth_form', 'class' => 'main_form']) }}
                                        <div class="">
                                            <label for="main_name">{{__('First Name')}}</label>
                                            <input name="first_name" id="main_name" class="main_input" type="text" value="{{old('first_name')}}">
                                            @if (isset($errors) && $errors->has('first_name'))
                                                <span class="text-danger"><strong>{{ $errors->first('first_name') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="">
                                            <label for="main_name">{{__('Last Name')}}</label>
                                            <input name="last_name" id="main_name" class="main_input" type="text" value="{{old('last_name')}}">
                                            @if (isset($errors) && $errors->has('last_name'))
                                                <span class="text-danger"><strong>{{ $errors->first('last_name') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="">
                                            <label for="main_name">{{__('Username')}}</label>
                                            <input name="username" id="main_name" class="main_input" type="text" value="{{old('username')}}">
                                            @if (isset($errors) && $errors->has('username'))
                                                <span class="text-danger"><strong>{{ $errors->first('username') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="">
                                            <label for="main_name">{{__('Email')}}</label>
                                            <input name="email" id="main_name" class="main_input" type="email" value="{{old('email')}}">
                                            @if (isset($errors) && $errors->has('email'))
                                                <span class="text-danger"><strong>{{ $errors->first('email') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="">
                                            <label for="main_name">{{__('Password')}}</label>
                                            <input name="password" id="main_name" class="main_input" type="password">
                                            @if (isset($errors) && $errors->has('password'))
                                                <span class="text-danger"><strong>{{ $errors->first('password') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="">
                                            <label for="main_name">{{__('Confirm Password')}}</label>
                                            <input name="password_confirmation" id="main_name" class="main_input" type="password">
                                            @if (isset($errors) && $errors->has('password_confirmation'))
                                                <span class="text-danger"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="">
                                            <label for="main_name">{{__('Referral Code')}} - <span class="text-muted">Register With Referral Code To Get One Year Golden Wallet Subscription For Free!(Optional)</span></label>
                                            <input name="referral_code" id="main_name" class="main_input" type="password">
                                            @if (isset($errors) && $errors->has('referral_code'))
                                                <span class="text-danger"><strong>{{ $errors->first('referral_code') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="button_extend trans_200 cursor-pointer">
                                            <button class="btn" type="submit">{{__('Sign Up')}}</button>
                                        </div>
                                    {{ Form::close() }}
                                    <div class="mt-3 text-center">
                                        Already have an account? <a href="{{ route('signIn') }}" class="text-muted"><u>{{__('Sign In')}}</u></a>
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
