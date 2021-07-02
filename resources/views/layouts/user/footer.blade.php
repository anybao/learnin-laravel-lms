@php
    $categories = \Illuminate\Support\Facades\Cache::get('categories::courses:all');
    if(!$categories)
    {
        $categories = \App\CourseCategory::orderBy('order', 'ASC')->with('courseshomepage')->get()->toArray();
        \Illuminate\Support\Facades\Cache::put('categories::courses:all', $categories);
    }
@endphp

<footer class="footer">
    <div class="container">
        <div class="row">

            <!-- About -->
            <div class="col-lg-3 footer_col">
                <div class="footer_about">
                    <div class="logo_container">
                        <a href="#">
                            <div class="logo_content d-flex flex-row align-items-end justify-content-start">
                                <div class="logo_img"><img src="/images/logo.png" alt="{{ env('APP_NAME') }}"></div>
                                <div class="logo_text">DTVP</div>
                            </div>
                        </a>
                    </div>
                    <div class="footer_about_text">
                        <p>
                            Xem hàng chục bài học mới được cập nhật hàng tuần về tất cả những kĩ năng làm việc, học tập, tin học văn phòng, sử dụng công cụ miễn phí của Google, Microsoft Office, Tiếng Anh để tăng hiệu quả công việc của bạn trong thời đại công nghệ 4.0
                        </p>
                    </div>
                    <div class="footer_social">
                        <ul>
{{--                            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>--}}
{{--                            <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>--}}
                            <li><a href="https://www.facebook.com/daotaovanphong/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UCr2azRFyowdMvbZijaVSaSg"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
{{--                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>--}}
                        </ul>
                    </div>
                    <div class="copyright">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> Made from Hanoi with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://quanghuyvn.com" target="_blank">Harry Tran</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 footer_col">
                <div class="footer_links">
                    <div class="footer_title">Danh mục khóa học</div>
                    <ul class="footer_list">
                        @if(isset($categories) && count($categories) > 0)
                            @foreach($categories as $category)
                                @if($category['courseshomepage'] && count($category['courseshomepage']) >0)
                                    <li>
                                        <a href="{{ route('courses.categories.view', $category['tag']) }}">{{ $category['title'] }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 footer_col">
                <div class="footer_links">
                    <div class="footer_title">Liên kết</div>
                    <ul class="footer_list">
                        <li><a href="/terms">Quy định & Điều khoản</a></li>
                        <li><a href="/privacy">Quyền riêng tư</a></li>
                        <li><a href="/contact">Liên hệ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 footer_col">
                <div class="footer_contact">
                    <div class="footer_title">Liên hệ</div>
                    <div class="footer_contact_info">
                        <div class="footer_contact_item">
                            <div class="footer_contact_title">Phone:</div>
                            <div class="footer_contact_line">+84 0354-003-078</div>
                        </div>
                        <div class="footer_contact_item">
                            <div class="footer_contact_title">Email:</div>
                            <div class="footer_contact_line">daotaovanphong@gmail.com</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
