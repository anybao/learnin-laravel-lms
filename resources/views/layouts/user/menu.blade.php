<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
    <div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
    <div class="search">
        <form action="{{ route('search') }}" class="header_search_form menu_mm" method="get">
            <input type="text" name="keywords" class="search_input menu_mm" placeholder="Bạn muốn học gì?" required value="{{ request('keywords') ?? ''}}">
            <button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
                <i class="fa fa-search menu_mm" aria-hidden="true"></i>
            </button>
        </form>
    </div>
    <nav class="menu_nav">
        <ul class="menu_mm">
            <li class="menu_mm"><a href="/">Trang chủ</a></li>
            <li class="menu_mm"><a href="/courses">Các khóa học</a></li>
            @if(auth()->check())
                <li class="menu_mm"><a href="/profile">Hồ sơ</a></li>
                <li class="menu_mm">
                    <a href="javascript:void(0)"
                       onclick="if(confirm('Bạn có chắc chắn muốn thoát?')){$('#logout-form').submit()}">Thoát ra</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @else
                <li class="menu_mm"><a href="/register">Đăng ký</a></li>
                <li class="menu_mm"><a href="/login">Đăng nhập</a></li>
            @endif
        </ul>
    </nav>
    <div class="menu_extra">
        <div class="menu_phone"><span class="menu_title">phone:</span>(+84) 0354-003-078</div>
        <div class="menu_social">
            <span class="menu_title">follow us</span>
            <ul>
                <li><a href="https://www.facebook.com/daotaovanphong/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="https://www.youtube.com/channel/UCr2azRFyowdMvbZijaVSaSg" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
</div>
