<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title') {{ env('APP_NAME') }} - Học mọi thứ chỉ với 99k</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Elearn project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/elearn/styles/bootstrap4/bootstrap.min.css">
    <link href="/elearn/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/elearn/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/elearn/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="/elearn/plugins/OwlCarousel2-2.2.1/animate.css">
    <link href="/elearn/plugins/video-js/video-js.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/elearn/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="/elearn/styles/responsive.css">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />

    <meta property="og:url"                content="{{ url()->current() }}" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="@yield('title') {{ env('APP_NAME') }}" />
    <meta property="fb:app_id"              content="783620185378430" />
    @include('layouts.meta_default')
    @include('layouts.widgets.js_tracking')
</head>
<body>
@include('layouts.widgets.fb_messenger')
<div class="super_container">

    <!-- Header -->

    <header class="header">

{{--        <!-- Top Bar -->--}}
{{--        <div class="top_bar">--}}
{{--            @include('layouts.user.topbar')--}}
{{--        </div>--}}

        <!-- Header Content -->
        @include('layouts.user.header')

        <!-- Header Search Panel -->
        <div class="header_search_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header_search_content d-flex flex-row align-items-center justify-content-end">
                            <form action="#" class="header_search_form">
                                <input type="search" class="search_input" placeholder="Search" required="required">
                                <button class="header_search_button d-flex flex-column align-items-center justify-content-center">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Menu -->

    @include('layouts.user.menu')

    <!-- Home -->

    <div class="home">
        <div class="home_slider_container">

            <!-- Home Slider -->
            <div class="owl-carousel owl-theme home_slider">

                <!-- Slider Item -->
                <div class="owl-item">
                    <div class="home_slider_background" style="background-image:url({{ env('AWS_PUBLIC_URL').'images/slides/slide1.jpg' }})"></div>
                    <div class="home_container">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="home_content text-center">
                                        <div class="home_logo"><img src="{{ asset('images/home_logo.png') }}" alt="{{ env('APP_NAME') }}"></div>
                                        <div class="home_text">
                                            <div class="home_title">Đào tạo Văn phòng</div>
                                            <div class="home_subtitle">
                                                Xem hàng chục bài học mới được cập nhật hàng tuần về tất cả những kĩ năng làm việc, học tập, tin học văn phòng, sử dụng công cụ miễn phí của Google, Microsoft Office, Tiếng Anh để tăng hiệu quả công việc của bạn trong thời đại công nghệ 4.0
                                            </div>
                                        </div>
{{--                                        <div class="home_buttons">--}}
{{--                                            <div class="button home_button"><a href="{{ route('courses') }}">see all courses<div class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a></div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slider Item -->
                <div class="owl-item">
                    <div class="home_slider_background" style="background-image:url({{ env('AWS_PUBLIC_URL').'images/slides/slide2.jpg' }})"></div>
                    <div class="home_container">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="home_content text-center">
                                        <div class="home_logo"><img src="{{ asset('images/home_logo.png') }}" alt="{{ env('APP_NAME') }}"></div>
                                        <div class="home_text">
                                            <div class="home_title">Kĩ năng mới trong kỉ nguyên 4.0</div>
                                            <div class="home_subtitle">
                                                Bạn đã sẵn sàng trang bị cho mình những kĩ năng cần thiết để phục vụ công việc của bạn trong kỉ nguyên này chưa?
                                            </div>
                                        </div>
{{--                                        <div class="home_buttons">--}}
{{--                                            <div class="button home_button"><a href="{{ route('courses') }}">see all courses<div class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a></div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="owl-item">
                    <div class="home_slider_background" style="background-image:url({{ env('AWS_PUBLIC_URL').'images/slides/slide3.jpg' }})"></div>
                    <div class="home_container">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="home_content text-center">
                                        <div class="home_logo"><img src="{{ asset('images/home_logo.png') }}" alt="{{ env('APP_NAME') }}"></div>
                                        <div class="home_text">
                                            <div class="home_title">Học mọi thứ, mọi lúc, mọi nơi chỉ cần Internet</div>
                                            <div class="home_subtitle">
                                                Học trực tuyến chưa bao giờ dễ dàng đến thế. Đăng kí một lần, học tất cả các khóa.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


        <!-- Featured Course -->
            <div class="featured">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Home Slider Nav -->
                    <div class="home_slider_nav_container d-flex flex-row align-items-start justify-content-between">
                        <div class="home_slider_nav home_slider_prev trans_200"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
                        <div class="home_slider_nav home_slider_next trans_200"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                    </div>
                    @if($featured_course)
                    <div class="featured_container">
                        @include('user.widgets.course_info_horizontal_featured', ['course' => $featured_course])
                    </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Courses -->

{{--    <div class="courses">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-10 offset-lg-1">--}}
{{--                    <div class="section_title text-center"><h2>Các khoá học mới cập nhật</h2></div>--}}
{{--                    <div class="section_subtitle">--}}
{{--                        Những khoá học mới được cập nhật liên tục hàng ngày--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col">--}}

{{--                    <!-- Courses Slider -->--}}
{{--                    <div class="courses_slider_container">--}}
{{--                        <div class="owl-carousel owl-theme courses_slider">--}}

{{--                            <!-- Slider Item -->--}}
{{--                            @foreach($courses as $course)--}}
{{--                                <div class="owl-item">--}}
{{--                                    @include('user.widgets.course_info_vertical', ['course' => $course])--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}

{{--                        <!-- Courses Slider Nav -->--}}
{{--                        <div class="courses_slider_nav courses_slider_prev trans_200"><i class="fa fa-angle-left" aria-hidden="true"></i></div>--}}
{{--                        <div class="courses_slider_nav courses_slider_next trans_200"><i class="fa fa-angle-right" aria-hidden="true"></i></div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    @if(isset($categories) && count($categories) > 0)
        @foreach($categories as $category)
            @if($category['courseshomepage'] && count($category['courseshomepage']) >0)
                @php $category['courses'] = $category['courseshomepage'];  @endphp
    <div class="courses">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="section_title text-center"><h2>{{ $category['title'] }}</h2></div>
                    <div class="section_subtitle">
                        {{ $category['except'] }}
                        <p class="mt-3"><a href="{{ route('courses.categories.view', $category['tag']) }}">> Xem toàn bộ <</a></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <!-- Courses Slider -->
                    <div class="courses_slider_container">
                        <div class="owl-carousel owl-theme courses_slider">

                            <!-- Slider Item -->
                            @php array_splice($category['courses'], 5) @endphp
                            @foreach($category['courses'] as $course)
                                <div class="owl-item">
                                    @include('user.widgets.course_info_vertical')
                                </div>
                            @endforeach
                        </div>

                        <!-- Courses Slider Nav -->
                        <div class="courses_slider_nav courses_slider_prev trans_200"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
                        <div class="courses_slider_nav courses_slider_next trans_200"><i class="fa fa-angle-right" aria-hidden="true"></i></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

            @endif
        @endforeach
    @endif

    <!-- Milestones -->

{{--    <div class="milestones">--}}
{{--        <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="/elearn/images/milestones.jpg" data-speed="0.8"></div>--}}
{{--        <div class="container">--}}
{{--            <div class="row milestones_container">--}}

{{--                <!-- Milestone -->--}}
{{--                <div class="col-lg-3 milestone_col">--}}
{{--                    <div class="milestone text-center">--}}
{{--                        <div class="milestone_icon"><img src="/elearn/images/milestone_1.svg" alt=""></div>--}}
{{--                        <div class="milestone_counter" data-end-value="1548">0</div>--}}
{{--                        <div class="milestone_text">Khoá học</div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Milestone -->--}}
{{--                <div class="col-lg-3 milestone_col">--}}
{{--                    <div class="milestone text-center">--}}
{{--                        <div class="milestone_icon"><img src="/elearn/images/milestone_2.svg" alt=""></div>--}}
{{--                        <div class="milestone_counter" data-end-value="7286">0</div>--}}
{{--                        <div class="milestone_text">Học sinh</div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Milestone -->--}}
{{--                <div class="col-lg-3 milestone_col">--}}
{{--                    <div class="milestone text-center">--}}
{{--                        <div class="milestone_icon"><img src="/elearn/images/milestone_3.svg" alt=""></div>--}}
{{--                        <div class="milestone_counter" data-end-value="257">0</div>--}}
{{--                        <div class="milestone_text">Tổng giờ học</div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Milestone -->--}}
{{--                <div class="col-lg-3 milestone_col">--}}
{{--                    <div class="milestone text-center">--}}
{{--                        <div class="milestone_icon"><img src="/elearn/images/milestone_4.svg" alt=""></div>--}}
{{--                        <div class="milestone_counter" data-end-value="39">0</div>--}}
{{--                        <div class="milestone_text">Số bài học</div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- Sections -->

{{--    @include('user.subscription')--}}
    @include('user.widgets.teacher_info')

    <div class="grouped_sections">
        <div class="container">
            <div class="row">

                <!-- Why Choose Us -->

                <div class="col-lg-12 grouped_col">
                    <div class="grouped_title">Hỏi đáp?</div>
                    <div class="accordions">

                        <div class="accordion_container">
                            <div class="accordion d-flex flex-row align-items-center active"><div>Có phải tất cả các bài học đều miễn phí?</div></div>
                            <div class="accordion_panel">
                                <div>
                                    <p>
                                        Đương nhiên! Thành thật mà nói, mình rất muốn cung cấp miễn phí tất cả các bài học. Tuy nhiên, vì sự đầu tư khá nhiều thời gian, cũng như chi phí để duy trì website, bạn chỉ cần bỏ ra 1 khoản chi phí rất nhỏ hàng tháng sẽ giúp mình có nhiều năng lượng để mang tới cho bạn những bài giảng chất lượng hơn nữa.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion_container">
                            <div class="accordion d-flex flex-row align-items-center"><div>Các khoá học có được cập nhật thường xuyên?</div></div>
                            <div class="accordion_panel">
                                <div>
                                    <p>
                                        Có! Tất cả các bài học đều được cập nhật nội dung thường xuyên nhằm mang tới chất lượng tốt nhất đối với người học. Bạn hãy cập nhật website thường xuyên để theo dõi nhé!
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion_container">
                            <div class="accordion d-flex flex-row align-items-center"><div>Thanh toán như thế nào?</div></div>
                            <div class="accordion_panel">
                                <div>
                                    <p>
                                        Bạn có thể thanh toán chuyển khoản ngân hàng; hoặc thánh toán bằng thẻ tín dụng (Visa/ Master) hoặc qua Paypal. Bạn có thể tìm hiểu thêm tại
                                        <a href="/subscribe">link</a>.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion_container">
                            <div class="accordion d-flex flex-row align-items-center"><div>Các khoá học đáng giá bao nhiêu? Tôi có thể nhận được gì?</div></div>
                            <div class="accordion_panel">
                                <div>
                                    <p>
                                        {{ env('APP_NAME') }} đi theo mô hình đăng kí sử dụng. Chỉ với 99k/ tháng, bạn có thể truy cập vào tất cả các bài giảng và video, cùng với rất nhiều bài học được xuất bản mỗi tháng.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Video -->

{{--    @include('layouts.video', ['poster' => asset('images/harry_tran.jpg'), 'url' => 'https://www.youtube.com/watch?v=nxNZ1kjzbHM'])--}}

    @if(!auth()->check())

        <!-- Join -->

            <div class="join">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="section_title text-center"><h2>Tham gia ngay hôm nay</h2></div>
                            <div class="section_subtitle">
                                Đăng kí ngay để cùng cập nhật cho bản thân những kĩ năng tốt nhất để tăng tốc hiệu quả làm việc của bạn!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button join_button"><a href="/register">đăng ký ngay<div class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a></div>
            </div>

        @endif
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
