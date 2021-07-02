<div class="row">
    <div class="col-lg-6 featured_col">
        <div class="featured_content">
            <div class="featured_header d-flex flex-row align-items-center justify-content-start">
                <div class="">@if($course->category)<a href="{{ route('courses.categories.view', $course->category) }}" style="color: #ff6600;">#{{ $course->category->tag }}</a>@endif</div>
                <div class="featured_price ml-auto">{{ gmdate("H:i:s", $course->minute_length) }}</div>
            </div>
            <div class="featured_title"><h3><a href="{{ route('courses.view', $course) }}">{{ $course->title }}</a></h3></div>
            <div class="featured_text">
                {{ $course->body }}
            </div>
            <div class="featured_footer d-flex align-items-center justify-content-start">
                <button class="course_button" onclick="window.location.href='{{ route('courses.view', $course) }}'"><span>Xem thêm</span><span class="button_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
                <div class="featured_sales ml-auto">@if($course->lesson_count > 0)<span>{{ $course->lesson_count }}</span> bài học @else <i class="fa fa-hourglass-half"></i> Đang cập nhật @endif</div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 featured_col">
        <div class="featured_background" style="background-image:url({{ $course->cover_img ? env('AWS_PUBLIC_URL').$course->cover_img  : env('AWS_PUBLIC_URL').('images/slides/skill.jpg') }})"></div>
    </div>
</div>
