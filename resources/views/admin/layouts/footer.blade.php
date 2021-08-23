
<!-- Footer -->

<footer class="footer bg-dark">
    <div class="footer_content">
        <div class="section_container">
            <div class="container">
                <div class="row">

                    <!-- About -->
                    <div class="col-xxl-3 col-md-6 footer_col">
                        <div class="footer_about">
                            <!-- Logo -->
                            <div class="footer_logo">
                                <img src="{{asset('assets/images/logo.png')}}" height="75" width="75" class="rounded-circle bg-dark" alt="Name" style="border: solid 2px #bbe432;">
                            </div>
                            <div class="footer_about_text">
                                <p class="text-white">Donec vitae purus nunc. Morbi faucibus erat sit amet congue mattis. Nullam fringilla faucibus urna, id dapibus erat iaculis ut. Integer ac sem.</p>
                            </div>
                            <div class="cards">
                                <span class="font-weight-bold text-white">bKash: +880 1888 8888 88</span>
                                <br>
                                <span class="font-weight-bold text-white">bKash: +880 1888 8888 88</span>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ -->
                    <div class="col-xxl-3 col-md-6 footer_col">
                        <div class="footer_questions">
                            <div class="footer_title text-white">faq</div>
                            <div class="footer_list">
                                <ul>
                                    <li><a href="{{route('admin.faq', 'about_us')}}" class="font-weight-bold text-white">About us</a></li>
                                    <li><a href="{{ route('admin.contact') }}" class="font-weight-bold text-white">Contact Us</a></li>
                                    <li><a href="{{route('admin.faq', 'offerings')}}" class="font-weight-bold text-white">Offers</a></li>
                                    <li><a href="{{route('admin.faq', 'payment_information')}}" class="font-weight-bold text-white">Payment Information</a></li>
                                    <li><a href="{{route('admin.faq', 'delivery_information')}}" class="font-weight-bold text-white">Delivery Information</a></li>
                                    <li><a href="{{route('admin.faq', 'order_guideline')}}" class="font-weight-bold text-white">Order Guideline</a></li>
                                    <li><a href="{{route('admin.faq', 'terms_and_conditions')}}" class="font-weight-bold text-white">Term & Conditions</a></li>
                                    <li><a href="{{route('admin.faq', 'privacy_policy')}}" class="font-weight-bold text-white">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- News -->
                    <div class="col-xxl-3 col-md-6 footer_col">
                        <div class="footer_blog text-white">
                            <div class="footer_title text-white">News</div>
                            <div class="footer_blog_container">

                                <!-- News Item -->
                                <div class="footer_blog_item d-flex flex-row align-items-start justify-content-start">
                                    <div class="footer_blog_image"><a href="blog.html"><img src="{{asset('assets/images/footer_blog_1.jpg')}}" alt=""></a></div>
                                    <div class="footer_blog_content">
                                        <div class="footer_blog_title"><a href="blog.html" class="text-white">what shoes to wear</a></div>
                                        <div class="footer_blog_date">june 06, 2018</div>
                                        <div class="footer_blog_link"><a href="blog.html">Read More</a></div>
                                    </div>
                                </div>

                                <!-- News Item -->
                                <div class="footer_blog_item d-flex flex-row align-items-start justify-content-start">
                                    <div class="footer_blog_image"><a href="blog.html"><img src="{{asset('assets/images/footer_blog_2.jpg')}}" alt=""></a></div>
                                    <div class="footer_blog_content">
                                        <div class="footer_blog_title"><a href="blog.html" class="text-white">trends this year</a></div>
                                        <div class="footer_blog_date">june 06, 2018</div>
                                        <div class="footer_blog_link"><a href="blog.html">Read More</a></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="col-xxl-3 col-md-6 footer_col">
                        <div class="footer_contact">
                            <div class="footer_title text-white">contact</div>
                            <div class="footer_contact_list">
                                <ul>
                                    <li class="d-flex flex-row align-items-start justify-content-start">
                                        <span>C.</span><div class="font-weight-bold text-white">Asthar Bazar</div>
                                    </li>
{{--                                    <li class="d-flex flex-row align-items-start justify-content-start"><span>A.</span><div>1481 Creekside Lane  Avila Beach, CA 93424, P.O. BOX 68</div></li>--}}
                                    <li class="d-flex flex-row align-items-start justify-content-start">
                                        <span>T.</span><div class="font-weight-bold text-white">+880 1888 8888 88</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-start justify-content-start">
                                        <span>E.</span><div class="font-weight-bold text-white">astherbazar@gmail.com</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Social -->
{{--    <div class="footer_social">--}}
{{--        <div class="section_container">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col">--}}
{{--                        <div class="footer_social_container d-flex flex-row align-items-center justify-content-between">--}}
{{--                            <!-- Instagram -->--}}
{{--                            <a href="#">--}}
{{--                                <div class="footer_social_item d-flex flex-row align-items-center justify-content-start">--}}
{{--                                    <div class="footer_social_icon"><i class="fa fa-instagram" aria-hidden="true"></i></div>--}}
{{--                                    <div class="footer_social_title">instagram</div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <!-- Google + -->--}}
{{--                            <a href="#">--}}
{{--                                <div class="footer_social_item d-flex flex-row align-items-center justify-content-start">--}}
{{--                                    <div class="footer_social_icon"><i class="fa fa-google-plus" aria-hidden="true"></i></div>--}}
{{--                                    <div class="footer_social_title">google +</div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <!-- Pinterest -->--}}
{{--                            <a href="#">--}}
{{--                                <div class="footer_social_item d-flex flex-row align-items-center justify-content-start">--}}
{{--                                    <div class="footer_social_icon"><i class="fa fa-pinterest" aria-hidden="true"></i></div>--}}
{{--                                    <div class="footer_social_title">pinterest</div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <!-- Facebook -->--}}
{{--                            <a href="#">--}}
{{--                                <div class="footer_social_item d-flex flex-row align-items-center justify-content-start">--}}
{{--                                    <div class="footer_social_icon"><i class="fa fa-facebook" aria-hidden="true"></i></div>--}}
{{--                                    <div class="footer_social_title">facebook</div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <!-- Twitter -->--}}
{{--                            <a href="#">--}}
{{--                                <div class="footer_social_item d-flex flex-row align-items-center justify-content-start">--}}
{{--                                    <div class="footer_social_icon"><i class="fa fa-twitter" aria-hidden="true"></i></div>--}}
{{--                                    <div class="footer_social_title">twitter</div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <!-- YouTube -->--}}
{{--                            <a href="#">--}}
{{--                                <div class="footer_social_item d-flex flex-row align-items-center justify-content-start">--}}
{{--                                    <div class="footer_social_icon"><i class="fa fa-youtube" aria-hidden="true"></i></div>--}}
{{--                                    <div class="footer_social_title">youtube</div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <!-- Tumblr -->--}}
{{--                            <a href="#">--}}
{{--                                <div class="footer_social_item d-flex flex-row align-items-center justify-content-start">--}}
{{--                                    <div class="footer_social_icon"><i class="fa fa-tumblr-square" aria-hidden="true"></i></div>--}}
{{--                                    <div class="footer_social_title">tumblr</div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- Credits -->
    <div class="credits">
        <div class="section_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="credits_content d-flex flex-row align-items-center justify-content-end">
                            <div class="credits_text"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
