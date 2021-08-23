@extends('user.layouts.master')
@section('title', __('Wallet - '.TITLE_CORE))
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
                <div class="home_title">Wallet</div>
                <div class="breadcrumbs">
                    <ul class="d-flex flex-row align-items-center justify-content-start">
                        <li><a href="{{route('account')}}">Account</a></li>
                        <li>Wallet</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Wallet -->

    <div class="main_section" style="padding-top: 100px;">

        <div class="section_container">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">Wallet</div>
                                <ul class="main_extra_total_list">
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title"><a href="#subscription-package-list" class="text-success">Subscribed Package</a></div>
                                        <div class="main_extra_total_value ml-auto">{{$wallet['subscription']['package']}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Size</div>
                                        <div class="main_extra_total_value ml-auto">{{$wallet['capacity']}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Cash</div>
                                        <div class="main_extra_total_value ml-auto">৳ {{$wallet['amount']}}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="main_extra_total_title">Expire Date</div>
                                        <div class="main_extra_total_value ml-auto">{{$wallet['expires_at']}}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section_container" style="margin-top: 100px;">
            <div class="container">
                <div class="row">

                    <!-- Description -->
                    <div class="col-xxl-12">
                        <div class="main_extra main_extra_1">
                            <div class="main_extra_content main_extra_total">
                                <div class="main_extra_title">How?</div>
                                <div class="main_extra_total_title text-justify mt-5">
                                    Whenever you or your referral purchases any thing from us, a portion of our profit will be saved in your <span class="text-uppercase">wallet</span>. You may purchase our product with that.
                                    We have amazing Wallet Subscription Packages for you. We are offering Bronze package completely free for you. You may subscribe to other packages for larger wallet. Every wallet has 1 year
                                    lifespan. For users registered with referral code will be offered Golden wallet subscription free for first 12 months. After expiring, your wallet will be automatically renewed to existing
                                    package or smaller depending on amount of money present on your wallet. Or, You may subscribe to another before expire date.
                                    <br><br>
                                    <span class="cursor-pointer" id="translate-button">অনুবাদ করুন</span>
                                    <span id="translation">
                                        <span>কিভাবে?</span><br><br>
                                        আপনি অথবা আপনার রেফারেল আমাদের থেকে কোন জিনিস কিনলে আমাদের প্রফিটের একটি অংশ আপনার <span class="text-uppercase">wallet</span> এ জমা হবে। পরবর্তিতে আপনি তা ব্যাবহার করে আমাদের থেকে কেনা কাটা করতে পারবেন। আমাদের
                                        কাছে আপনার জন্য দুর্দান্ত ওয়ালেট সাবস্ক্রিপশন প্যাকেজ রয়েছে। আমরা আপনার জন্য সম্পূর্ণ বিনামূল্যে ব্রোঞ্জ প্যাকেজ অফার করছি। বড় ওয়ালেটের জন্য আপনি অন্যান্য প্যাকেজগুলিতে সাবস্ক্রাইব করতে পারেন। প্রতিটি ওয়ালেটের মেয়াদ 1 বছর।রেফারেল কোড সহ
                                        নিবন্ধিত ব্যবহারকারীদের প্রথম 12 মাসের জন্য বিনামূল্যে গোল্ডেন ওয়ালেট সাবস্ক্রিপশন দেওয়া হবে। মেয়াদ শেষ হওয়ার পরে, আপনার মানিব্যাগটি স্বয়ংক্রিয়ভাবে চলমান অথবা ছোট প্যাকেজে পুনর্নবীকরণ হবে আপনার ওয়ালেটে উপস্থিত অর্থের উপর নির্ভর করে।
                                        অথবা, মেয়াদ শেষ হওয়ার আগে আপনি অন্য প্যাকেজে সাবস্ক্রাইব করতে পারেন।
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section_container" id="subscription-package-list" style="margin-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="main_container">

                            <div class="main_extra_title">Wallet Subscription Packages</div>
                            <div class="main_items border-0 mt-5">
                                <table id="wallet-subscription-table" class="table wallet-subscription-table table-bordered text-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="all">{{__('Package')}}</th>
                                        <th class="all">{{__('Charge(Yearly)')}}</th>
                                        <th class="all">{{__('Capacity')}}</th>
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
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js/account.js')}}"></script>
    <script>
        $('#translation').hide();
        $(document).ready(function (){
            $('#translate-button').on('click', function () {
                $('#translate-button').hide();
                $('#translation').fadeIn();
            });
        });
    </script>
    <script>
        $('#wallet-subscription-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('account.walletSubscriptionPackageList')}}',
            order:[2,'asc'],
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
                {"data": "package"},
                {"data": "charge"},
                {"data": "capacity"},
                {"data": "actions", orderable: false, searchable: false}
            ]
        });
    </script>
@endsection
