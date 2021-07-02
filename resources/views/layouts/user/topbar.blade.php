<div class="top_bar_container">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                    <ul class="top_bar_contact_list">
                        <li><div class="question">Liên hệ ngay</div></li>
                        <li>
                            <div>(+84) 0354-003-078</div>
                        </li>
                        <li>
                            <div>daotaovanphong@gmail.com</div>
                        </li>
                    </ul>
                    <div class="top_bar_login ml-auto">
                        <ul>
                            @if(auth()->check())
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Thoát ra</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                                @else
                                <li><a href="/register">Đăng ký</a></li>
                                <li><a href="/login">Đăng nhập</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
