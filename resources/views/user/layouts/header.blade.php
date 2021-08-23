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
                <li><a href="{{ route('home') }}" class=" @if(isset($menu)&&$menu=='home') active @endif" style="text-decoration: underline">home</a></li>
                @if(isset($base)&&$base=='home')
                    <li><a href="{{ route('shop') }}" class=" @if(isset($menu)&&$menu=='shop') active @endif">shop</a></li>
                    <li><a href="{{ route('cart') }}" class=" @if(isset($menu)&&$menu=='cart') active @endif">cart</a></li>
                    <li><a href="{{ route('news') }}" class=" @if(isset($menu)&&$menu=='news') active @endif">news</a></li>
                @endif
                <li><a href="{{ route('account') }}" class=" @if(isset($menu)&&$menu=='account') active @endif" style="text-decoration: underline">account</a></li>
                @if(isset($base)&&$base=='account')
                    <li><a href="{{ route('profile') }}" class=" @if(isset($menu)&&$menu=='profile') active @endif">profile</a></li>
                    <li><a href="{{ route('order') }}" class=" @if(isset($menu)&&$menu=='order') active @endif">order</a></li>
                    <li><a href="{{ route('signOut') }}">Sign Out</a></li>
                @endif
            </ul>
        </nav>

        <!-- Header Extra -->
        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
            <!-- Cart -->
            <div class="cart d-flex flex-row align-items-center justify-content-start">
                <div class="cart_icon">
                    <a href="{{ route('cart') }}">
                        <img src="{{asset('assets/images/bag.png')}}" alt="">
                        <div class="cart_num text-dark">{{cart()->quantity}}</div>
                    </a>
                </div>
            </div>
            <div class="cart_price ml-auto">৳ {{cart()->price}}</div>
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
            <li><a href="{{ route('home') }}" class=" @if(isset($menu)&&$menu=='home') active @endif">home</a></li>
            @if(isset($base)&&$base=='home')
                <li class="ml-2"><a href="{{ route('shop') }}" class=" @if(isset($menu)&&$menu=='shop') active @endif">shop</a></li>
                <li class="ml-2"><a href="{{ route('cart') }}" class=" @if(isset($menu)&&$menu=='cart') active @endif">cart</a></li>
                <li class="ml-2"><a href="{{ route('news') }}" class=" @if(isset($menu)&&$menu=='news') active @endif">news</a></li>
            @endif
            <li><a href="{{ route('account') }}" class=" @if(isset($menu)&&$menu=='account') active @endif">account</a></li>
            @if(isset($base)&&$base=='account')
                <li class="ml-2"><a href="{{ route('profile') }}" class=" @if(isset($menu)&&$menu=='profile') active @endif">profile</a></li>
                <li class="ml-2"><a href="{{ route('order') }}" class=" @if(isset($menu)&&$menu=='order') active @endif">order</a></li>
                <li class="ml-2"><a href="{{ route('signOut') }}">Sign Out</a></li>
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
            <li><a href="{{ route('home') }}" class=" @if(isset($menu)&&$menu=='home') active @endif">home<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
            @if(isset($base)&&$base=='home')
                <li class="ml-2"><a href="{{ route('shop') }}" class=" @if(isset($menu)&&$menu=='shop') active @endif">shop<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li class="ml-2"><a href="{{ route('cart') }}" class=" @if(isset($menu)&&$menu=='cart') active @endif">cart<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li class="ml-2"><a href="{{ route('news') }}" class=" @if(isset($menu)&&$menu=='news') active @endif">news<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
            @endif
            <li><a href="{{ route('account') }}" class=" @if(isset($menu)&&$menu=='account') active @endif">account<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
            @if(isset($base)&&$base=='account')
                <li class="ml-2"><a href="{{ route('profile') }}" class=" @if(isset($menu)&&$menu=='profile') active @endif">profile<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li class="ml-2"><a href="{{ route('order') }}" class=" @if(isset($menu)&&$menu=='order') active @endif">order<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li class="ml-2"><a href="{{ route('signOut') }}">Sign Out<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
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
        <div class="cart_icon"><a href="{{ route('cart') }}">
                <img src="{{asset('assets/images/bag.png')}}" alt="">
                <div class="cart_num text-dark">{{cart()->quantity}}</div>
            </a></div>
        <div class="cart_text ml-auto">bag</div>
        <div class="cart_price ml-auto">৳ {{cart()->price}}</div>
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
