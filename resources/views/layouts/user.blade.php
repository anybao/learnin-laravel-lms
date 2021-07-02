<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.user.head')
</head>
<body>
@include('layouts.widgets.fb_messenger')
<div class="super_container">

    <!-- Header -->

    <header class="header">

        <!-- Top Bar -->
{{--        <div class="top_bar">--}}
{{--            @include('layouts.user.topbar')--}}
{{--        </div>--}}

        <!-- Header Content -->
        @include('layouts.user.header')

        <!-- Header Search Panel -->
{{--        <div class="header_search_container">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col">--}}
{{--                        <div class="header_search_content d-flex flex-row align-items-center justify-content-end">--}}
{{--                            <form action="#" class="header_search_form">--}}
{{--                                <input type="search" class="search_input" placeholder="Search" required="required">--}}
{{--                                <button class="header_search_button d-flex flex-column align-items-center justify-content-center">--}}
{{--                                    <i class="fa fa-search" aria-hidden="true"></i>--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </header>

    <!-- Menu -->

    @include('layouts.user.menu')

    <!-- Home -->

{{--    <div class="home">--}}
{{--        <!-- Background image artist https://unsplash.com/@thepootphotographer -->--}}
{{--        <div class="home_background parallax_background parallax-window" data-parallax="scroll" data-image-src="/elearn/images/contact.jpg" data-speed="0.8"></div>--}}
{{--        <div class="home_container">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col">--}}
{{--                        <div class="home_content text-center">--}}
{{--                            <div class="home_title">Contact</div>--}}
{{--                            <div class="breadcrumbs">--}}
{{--                                <ul>--}}
{{--                                    <li><a href="index.html">Home</a></li>--}}
{{--                                    <li>Contact</li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="breadcrumbs">--}}
{{--        <ul>--}}
{{--            <li><a href="index.html">Home</a>ưe</li>--}}
{{--            <li>Contact</li>--}}
{{--        </ul>--}}
{{--    </div>--}}

    <!-- Contact -->

    <div class="about homepage-custom">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.user.footer')

</div>

<script src="/elearn/js/jquery-3.2.1.min.js"></script>
<script src="/elearn/styles/bootstrap4/popper.js"></script>
<script src="/elearn/styles/bootstrap4/bootstrap.min.js"></script>

{{--<script src="/elearn/plugins/greensock/TweenMax.min.js"></script>--}}
{{--<script src="/elearn/plugins/greensock/TimelineMax.min.js"></script>--}}
<script src="/elearn/plugins/scrollmagic/ScrollMagic.min.js"></script>
{{--<script src="/elearn/plugins/greensock/animation.gsap.min.js"></script>--}}
<script src="/elearn/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="/elearn/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
{{--<script src="/elearn/plugins/easing/easing.js"></script>--}}
{{--<script src="/elearn/plugins/video-js/video.min.js"></script>--}}
{{--<script src="/elearn/plugins/video-js/Youtube.min.js"></script>--}}
{{--<script src="/elearn/plugins/parallax-js-master/parallax.min.js"></script>--}}
<script src="/elearn/js/custom.js"></script>
</body>
</html>
