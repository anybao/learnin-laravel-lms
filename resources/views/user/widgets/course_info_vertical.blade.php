<div class="course">
    <div class="course_image"><img src="{{ $course['cover_img'] ? env('AWS_PUBLIC_URL').$course['cover_img']  : env('AWS_PUBLIC_URL').('images/slides/skill.jpg') }}" alt="{{ $course['title'] }}"></div>
    <div class="course_body">
        <div class="course_header d-flex flex-row align-items-center justify-content-start">
            <div class="course_tag">@if(isset($category))<a href="{{ route('courses.categories.view', $category['tag']) }}">#{{ $category['tag'] }}</a>@endif</div>
            <div class="course_price ml-auto">{{ gmdate("H:i:s", $course['minute_length']) }}</div>
        </div>
        <div class="course_title"><h3><a href="{{ route('courses.view', $course['slug']) }}">{{ $course['title'] }}</a></h3></div>
        <div class="course_text">
            {{ $course['body'] }}
        </div>
        <div class="course_footer d-flex align-items-center justify-content-start">
            <div class="course_author_image"><img src="{{ env('AWS_PUBLIC_URL').('images/slides/harry_tran_sm.jpg') }}" alt="{{ $course['title'] }}"></div>
            <div class="course_author_name"><a href="/teacher">Harry Tran</a></div>
            <div class="course_sales ml-auto">@if($course['lesson_count'] > 0)<span>{{ $course['lesson_count'] }}</span> bài học @else <i class="fa fa-hourglass-half"></i> Đang cập nhật @endif</div>
        </div>
    </div>
</div>
