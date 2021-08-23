@extends('user.layouts.master')
@section('title', __('News Details - '.TITLE_CORE))
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
                <div class="home_title">News</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('account')}}">Account</a></li>
                        <li>News</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart -->

    <div class="main_section">

        <div class="section_container content-toggle-0">
            <div class="container">
                <div class="row">
                    <!-- Shipping & Delivery -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">News</div>
                                @foreach($allNews as $news)
                                    <ul class="main_extra_total_list">
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="main_extra_total_title">Date</div>
                                            <div class="main_extra_total_value ml-auto">{{date_format($news->created_at, 'Y-m-d')}}</div>
                                        </li>
                                        <li class="main_extra_total_value ml-auto text-justify">
                                            <div class="main_extra_total_title"><img src="{{asset(newsImageViewPath().$news->image)}}" style="height: 100%; width: 100%"></div>
                                        </li>
                                        <li class="main_extra_total_value ml-auto text-justify">
                                            <div class="main_extra_total_title">{{$news->content}}</div>
                                        </li>
                                    </ul>
                                    <br><hr>
                                @endforeach
                                {{$allNews->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/news_details.js')}}"></script>
@endsection
