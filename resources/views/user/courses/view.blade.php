@extends('layouts.user')

@section('title'){{ $course->title }} -@endsection

@section('meta')
    <meta property="og:description"        content="{{ $course->body }}" />
    <meta property="og:image"              content="{{ $course->cover_img ? env('AWS_PUBLIC_URL').$course->cover_img  : asset('images/fb.jpg') }}" />
    <meta name="description" content="{{ $course->body }}">
    <meta name="keywords" content="{{ $course->keywords }}">
@endsection

@section('content')

    <div class="breadcrumbs mb-3">
        <ul>
            <li><a style="color: #ff8a00" href="{{ route('courses.categories.view', $course->category) }}">Chuyên mục {{ $course->category->title }}</a></li>
            <li class="text-dark">{{ $course->title }}</li>
            @if(auth()->user() && auth()->user()->isAdmin())
                <li><a style="color: #ff8a00" href="{{ route('admin.courses.detail', $course) }}"><i class="fa fa-edit"></i> Edit</a></li>
                @endif
        </ul>
    </div>

    <div class="container">
        @include('user.widgets.course_info_horizontal', ['course' => $course])

        {!! $course->description !!}

        <div class="mt-5">
            <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                <div><div class="latest_post_image"><img src="/images/harry_tran_sm.jpg" alt=""></div></div>
                <div class="latest_post_body">
                    <div class="latest_post_title mt-0"><a href="/teacher">Giảng viên: Harry Tran</a></div>
                    <div class="latest_post_author">
                        Xin chào, tôi là <strong>Trần Quang Huy</strong>. Tôi tốt nghiệp tại trường <strong>Đại học Hà Nội</strong> chuyên ngành <strong>Công nghệ thông tin</strong> bằng Tiếng Anh.
                        Tôi có khả năng giao tiếp tiếng anh thành thạo cùng sự nhanh nhạy trong nắm bắt và sử dụng công nghệ, tôi mong muốn mang tới cho mọi người những bài học hiệu quả nhất.
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h3>Nội dung khóa học</h3>
            @if($course->chapters->count()>0)
                @foreach($course->chapters as $chapter)
                    <h5 class="mt-3">{{ $chapter->title }}</h5>
                    <p>{{ $chapter->body }}</p>
                    @foreach($chapter->lessons as $key => $lesson)
                        <div class="card-body mt-3 lesson-custom">
                            <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                                <div class="latest_post_image" style="background: #f60;">
                                    <div class="event_date d-flex flex-column align-items-center justify-content-center" style="padding-top: 15px; color: white;">
                                        <div class="event_day">Bài</div>
                                        <div class="event_month font-2xl font-weight-bold">{{ $key+1 }}</div>
                                    </div>
                                </div>
                                <div class="latest_post_body">
                                    <small class="text-muted"><i class="fa fa-clock-o"></i> {{ number_format($lesson->minutes_length/60, 2) }} phút @if($lesson->isFree()) <span class="badge badge-primary">Miễn phí</span> @endif</small>
                                    <div class="latest_post_title mt-1"><a href="{{ route('courses.lesson.view', [$course, $lesson]) }}">{{ $lesson->title }}</a></div>
                                    <div class="latest_post_author">{{ $lesson->body }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                @endforeach
            @endif
            @if($course->chapters->count() < 1 || $course->isDraft())
            <div class="text-center mt-3">
                <img src="/images/rocket.png" alt="{{ env('APP_NAME') }}" height="80">
                <h4 class="mt-3">Khoá học vẫn đang được cập nhật!</h4>
                <h5 class="mt-2">Bạn hãy quay trở lại thường xuyên để theo dõi những bài học mới nhất nhé.</h5>
            </div>
            @endif
        </div>
    </div>

    @endsection
