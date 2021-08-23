<!-- Header -->

<header class="header">
    <div class="container header_content d-flex flex-row align-items-center justify-content-start">

        <!-- Hamburger -->
        <div class="hamburger menu_mm"><i class="fa fa-bars menu_mm" aria-hidden="true"></i></div>

        <!-- Logo -->
        <div class="header_logo">
            <img src="{{asset('assets/images/logo.png')}}" height="50" width="50" class="rounded-circle" alt="Name" style="border: solid 2px #bbe432;">
        </div>

        <!-- Navigation -->
        <nav class="ml-auto header_nav">
            <ul class="d-flex flex-row align-items-center justify-content-start">
                <li><a href="{{ route('signIn') }}">Sign In</a></li>
                <li><a href="{{ route('signUp') }}">Sign Up</a></li>
            </ul>
        </nav>

    </div>
</header>

<!-- Menu -->

<div class="menu d-flex flex-column align-items-start justify-content-start menu_mm trans_400">
    <div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>

    <nav class="menu_nav">
        <ul class="menu_mm">
            <li><a href="{{ route('signIn') }}">Sign In</a></li>
            <li><a href="{{ route('signUp') }}">Sign Up</a></li>
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

<div class="sidebar">


    <!-- Logo -->
    <div class="sidebar_logo">
        <img src="{{asset('assets/images/logo.png')}}" height="150" width="150" class="rounded-circle" alt="Name" style="border: solid 2px #bbe432;">
    </div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar_nav">
        <ul>
            <li><a href="{{ route('signIn') }}">Sign In<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
            <li><a href="{{ route('signUp') }}">Sign Up<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
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
