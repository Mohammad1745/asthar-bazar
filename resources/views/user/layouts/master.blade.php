<!DOCTYPE html>
<html lang="en" dir="" style="height: 100%">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Asthar Bazar - Online Groceries & Fish Store">
    <meta name="keywords" content="astha, asthar bazar, maswala, shop, online shop, groceries, fish, shrimp, fresh, fresh product" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel ="icon" href="{{asset('assets/images/logo.png')}}" type = "image/x-icon">

    <!-- Google Font-->
    <link href="http://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/bootstrap-4.1.3/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/OwlCarousel2-2.2.1/animate.css')}}">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" href="{{asset('assets/styles/custom/datatables.css')}}">

    @yield('style')

    <link rel="stylesheet" href="{{asset('assets/styles/custom/developed.css')}}">

</head>

<body>

<div class="super_container">

    @include('user.layouts.header')
    <div class="float-message">
        <div class="alert-float alert align-top" id="alert" style="display: none;">
            <button type="button" class="close" id="alertRemove" aria-hidden="true">x</button>
            <span class="message"></span>
        </div>
        @if(Session::has('success'))
            <div class="alert-float alert alert-success alert-dismissable text-dark text-center h-auto" style="font-size: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert-float alert alert-danger alert-dismissable text-dark text-center h-auto" style="font-size: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{Session::get('error')}}
            </div>
        @endif
        @if(Session::has('dismiss'))
            <div class="alert-float alert alert-danger alert-dismissable text-dark text-center h-auto" style="font-size: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{Session::get('dismiss')}}
            </div>
        @endif
        @if(!empty($errors) && count($errors) > 0)
            <div class="alert-float alert alert-danger alert-dismissable text-dark text-center h-auto" style="font-size: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{$errors->first()}}
            </div>
        @endif
    </div>
    @yield('content')
    @include('user.layouts.footer')
</div>

<script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('assets/styles/bootstrap-4.1.3/popper.js')}}"></script>
<script src="{{asset('assets/styles/bootstrap-4.1.3/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('assets/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('assets/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('assets/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('assets/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('assets/plugins/easing/easing.js')}}"></script>
<script src="{{asset('assets/plugins/parallax-js-master/parallax.min.js')}}"></script>
<script src="{{asset('assets/plugins/Isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/plugins/Isotope/fitcolumns.js')}}"></script>

<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

@yield('script')

<script>
    $('document').ready(function () {
        setTimeout(function () {
            $('.alert').fadeOut('slow');
        },1500);
    });
</script>
    @include('user.layouts.calculator')
</body>
</html>
