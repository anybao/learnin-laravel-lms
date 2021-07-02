@php
    $categories = \Illuminate\Support\Facades\Cache::get('categories::courses:all');
    if(!$categories)
    {
        $categories = \App\CourseCategory::orderBy('order', 'ASC')->with('courseshomepage')->get()->toArray();
        \Illuminate\Support\Facades\Cache::put('categories::courses:all', $categories);
    }
@endphp

<div class="header_container">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="header_content d-flex flex-row align-items-center justify-content-start">
                    <div class="logo_container">
                        <a href="/">
                            <div class="logo_content d-flex flex-row align-items-end justify-content-start">
                                <div class="logo_img"><img src="/images/logo.png" alt="{{ env('APP_NAME') }}"></div>
                                <div class="logo_text">DTVP</div>
                            </div>
                        </a>
                    </div>
                    <nav class="navbar ml-3 col-md-4 d-none d-md-block">
                        <form class="form-inline d-flex justify-content-center md-form form-sm active-purple-2 mt-2" method="GET" action="{{ route('search') }}">
                            <input class="form-control form-control-sm mr-3 w-75" name="keywords" type="text" placeholder="Bạn muốn học gì hôm nay?"
                                   aria-label="Tìm khoá học, bài giảng" required value="{{ request('keywords') ?? ''}}">
                            <button type="submit" class="pl-2 pr-2 pt-1 pb-1 " style="background-color: #ff6600; color: white">Tìm</button>
                        </form>
                    </nav>
                    <nav class="main_nav_contaner ml-auto">
                        <ul class="main_nav">
                            <li><a href="/"><i class="fa fa-home"></i> Trang chủ</a></li>
                            <li>
                                <div class="dropdown">
                                    <a href="/courses" class="dropbtn"><i class="fa fa-book"></i> Các khóa học</a>
                                    <div class="dropdown-content">
                                        @if(isset($categories) && count($categories) > 0)
                                            @foreach($categories as $category)
                                                @if($category['courseshomepage'] && count($category['courseshomepage']) >0)
                                                    <a href="{{ route('courses.categories.view', $category['tag']) }}">{{ $category['title'] }}</a>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @if(auth()->check())
                                <li><a href="/profile"><i class="fa fa-user"></i> Hồ sơ</a></li>
                                <li>
                                    <a href="javascript:void(0)"
                                       onclick="if(confirm('Bạn có chắc chắn muốn thoát?')){$('#logout-form').submit()}"><i class="fa fa-sign-out"></i> Thoát ra</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <li><a href="/register">Đăng ký</a></li>
                                <li><a href="/login">Đăng nhập</a></li>
                            @endif
                        </ul>
{{--                        <div class="search_button"><i class="fa fa-search" aria-hidden="true"></i></div>--}}

                        <!-- Hamburger -->

                        <div class="hamburger menu_mm">
                            <i class="fa fa-bars menu_mm" aria-hidden="true"></i>
                        </div>
                    </nav>

                </div>
            </div>
        </div>
    </div>
</div>

<style>

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {background-color: #ddd;}

    .dropdown:hover .dropdown-content {display: block;}

</style>
