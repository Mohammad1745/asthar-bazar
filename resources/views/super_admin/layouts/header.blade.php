<!-- Header -->

<header class="header">
    <div class="container header_content d-flex flex-row align-items-center justify-content-start">

        <!-- Hamburger -->
        <div class="hamburger menu_mm"><i class="fa fa-bars menu_mm" aria-hidden="true"></i></div>

        <!-- Logo -->
        <div class="header_logo">
            <img src="{{asset('assets/images/logo.png')}}" height="60" width="60" class="rounded-circle" alt="Name" style="border: solid 2px #bbe432;">
        </div>

        <nav class="ml-auto header_nav">
            <ul class="d-flex flex-row align-items-center justify-content-start">
                <li><a href="{{ route('superAdmin.dashboard') }}" class=" @if(isset($menu)&&$menu=='dashboard') active @endif" style="text-decoration: underline">dashboard</a></li>
                @if(isset($base)&&$base=='dashboard')
                    <li><a href="{{ route('superAdmin.user') }}" class=" @if(isset($menu)&&$menu=='user') active @endif">users</a></li>
                    <li><a href="{{ route('superAdmin.department') }}" class=" @if(isset($menu)&&$menu=='department') active @endif">departments</a></li>
                    <li><a href="">records</a></li>
                    <li><a href="{{ route('superAdmin.faq') }}" class=" @if(isset($menu)&&$menu=='faq') active @endif">faq</a></li>
                @endif
                <li><a href="{{route('superAdmin.account')}}" class=" @if(isset($menu)&&$menu=='account') active @endif" style="text-decoration: underline">account</a></li>
                @if(isset($base)&&$base=='account')
                    <li><a href="{{route('superAdmin.profile')}}" class=" @if(isset($menu)&&$menu=='profile') active @endif">profile</a></li>
                    <li><a href="{{route('superAdmin.news')}}" class=" @if(isset($menu)&&$menu=='news') active @endif">news</a></li>
                    <li><a href="{{route('superAdmin.contact')}}" class=" @if(isset($menu)&&$menu=='contact') active @endif">contact</a></li>
                    <li><a href="{{route('signOut')}}">Sign Out</a></li>
                @endif
            </ul>
        </nav>
        <!-- Header Extra -->
        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
            <!-- Cart -->
            <div class="cart d-flex flex-row align-items-center justify-content-start">
                <div class="cart_text ml-auto">{{$user->first_name.' '.$user->last_name}}</div>
            </div>
        </div>
    </div>
</header>

<!-- Menu -->

<div class="menu d-flex flex-column align-items-start justify-content-start menu_mm trans_400 overflow-scroll-y-100">
    <div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
    <div class="menu_search">
        <form action="#" class="header_search_form menu_mm">
            <input type="search" class="search_input menu_mm" placeholder="Search" required="required">
            <button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
                <i class="fa fa-search menu_mm" aria-hidden="true"></i>
            </button>
        </form>
    </div>
    <nav class="menu_nav">
        <ul class="menu_mm">
            <li><a href="{{ route('superAdmin.dashboard') }}" class=" @if(isset($menu)&&$menu=='dashboard') active @endif">dashboard</a></li>
            @if(isset($base)&&$base=='dashboard')
                <li class="ml-2"><a href="{{ route('superAdmin.user') }}" class=" @if(isset($menu)&&$menu=='user') active @endif">users</a></li>
                <li class="ml-2"><a href="{{ route('superAdmin.department') }}" class=" @if(isset($menu)&&$menu=='department') active @endif">departments</a></li>
                <li class="ml-2"><a href="">records</a></li>
                <li class="ml-2"><a href="{{ route('superAdmin.faq') }}" class=" @if(isset($menu)&&$menu=='faq') active @endif">faq</a></li>
            @endif
            <li><a href="{{route('superAdmin.account')}}" class=" @if(isset($menu)&&$menu=='account') active @endif">account</a></li>
            @if(isset($base)&&$base=='account')
                <li class="ml-2"><a href="{{route('superAdmin.profile')}}" class=" @if(isset($menu)&&$menu=='profile') active @endif">profile</a></li>
                <li class="ml-2"><a href="{{route('superAdmin.news')}}" class=" @if(isset($menu)&&$menu=='news') active @endif">news</a></li>
                <li class="ml-2"><a href="{{route('superAdmin.contact')}}" class=" @if(isset($menu)&&$menu=='contact') active @endif">contact</a></li>
                <li class="ml-2"><a href="{{route('signOut')}}">Sign Out</a></li>
            @endif
        </ul>
    </nav>
    <div class="menu_extra">
        <div class="menu_social">
            <ul>
                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Sidebar -->

<div class="sidebar overflow-scroll-y-100">
    <!-- Logo -->
    <div class="sidebar_logo">
        <img src="{{asset('assets/images/logo.png')}}" height="150" width="150" class="rounded-circle" alt="Name" style="border: solid 2px #bbe432;">
    </div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar_nav">
        <ul>
            <li><a href="{{ route('superAdmin.dashboard') }}" class=" @if(isset($menu)&&$menu=='dashboard') active @endif"> dashboard<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
            @if(isset($base)&&$base=='dashboard')
                <li class="ml-2"><a href="{{ route('superAdmin.user') }}" class=" @if(isset($menu)&&$menu=='user') active @endif">users<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li class="ml-2"><a href="{{ route('superAdmin.department') }}" class=" @if(isset($menu)&&$menu=='department') active @endif">departments<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li class="ml-2"><a href="">records<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li class="ml-2"><a href="{{ route('superAdmin.faq') }}" class=" @if(isset($menu)&&$menu=='faq') active @endif">faq<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
            @endif
            <li><a href="{{route('superAdmin.account')}}" class=" @if(isset($menu)&&$menu=='account') active @endif">account<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
            @if(isset($base)&&$base=='account')
                <li class="ml-2"><a href="{{route('superAdmin.profile')}}" class=" @if(isset($menu)&&$menu=='profile') active @endif">profile<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li class="ml-2"><a href="{{route('superAdmin.news')}}" class=" @if(isset($menu)&&$menu=='news') active @endif">news<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li class="ml-2"><a href="{{route('superAdmin.contact')}}" class=" @if(isset($menu)&&$menu=='contact') active @endif">contact<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li class="ml-2"><a href="{{route('signOut')}}">Sign Out<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
            @endif
        </ul>
    </nav>

    <!-- Search -->
    <div class="search">
        <form action="#" class="search_form" id="sidebar_search_form">
            <input type="text" class="search_input" placeholder="Search" required="required">
            <button class="search_button"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
    </div>

    <!-- Cart -->
    <div class="cart d-flex flex-row align-items-center justify-content-start">
        <div class="cart_text ml-auto">{{$user->first_name.' '.$user->last_name}}</div>
    </div>

    <div class="menu_extra">
        <div class="menu_social">
            <ul>
                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
</div>
