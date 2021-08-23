@extends('auth.layouts.master')
@section('title', __('Sign In - '.TITLE_CORE))
@section('content')

    <div class="main_section content-toggle-1" style="padding-top: 100px;">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <!-- Category -->
                    <div class="col">
                        <div class="main_container">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">{{__('Sign In')}}</div>
                                <div class="main_form_container">
                                    {{ Form::open(['route' => 'signInProcess', 'method' => 'post', 'id' => 'auth_form', 'class' => 'main_form']) }}
                                        <div class="">
                                            <label for="main_name">{{__('Email/Username')}}</label>
                                            <input name="email_username" id="main_name" class="main_input" type="text" value="{{old('email_username')}}" required="required">
                                            @if (isset($errors) && $errors->has('email_username'))
                                                <span class="text-danger"><strong>{{ $errors->first('email_username') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="">
                                            <label for="main_name">{{__('Password')}}</label>
                                            <input name="password" id="main_name" class="main_input" type="password" required="required">
                                            @if (isset($errors) && $errors->has('password'))
                                                <span class="text-danger"><strong>{{ $errors->first('password') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="button_extend trans_200 cursor-pointer">
                                            <button class="btn" type="submit">{{__('Sign In')}}</button>
                                        </div>
                                    {{ Form::close() }}
                                    <div class="mt-3 text-center">
                                        <a href="{{ route('forgetPassword') }}" class="text-muted"><u>{{__('Forgot Password')}}?</u></a>
                                         | Doesn't have account yet? <a href="{{ route('signUp') }}" class="text-muted"><u>{{__('Create One')}}</u></a>
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
