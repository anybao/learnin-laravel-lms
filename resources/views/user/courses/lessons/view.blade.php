@extends('layouts.user')

@section('title') {{ $lesson->title }} - {{ $course->title }} -@endsection
@section('meta')
    <meta property="og:description"        content="{{ $lesson->body }}" />
    <meta property="og:image"              content="{{ $course->cover_img ? env('AWS_PUBLIC_URL').$course->cover_img  : asset('images/fb.jpg') }}" />
    <meta name="description" content="{{ $lesson->body }}">
    <meta name="keywords" content="{{ $course->keywords }}">
@endsection
@section('content')
    <div class="breadcrumbs mb-3">
        <ul>
            <li><a style="color: #ff8a00" href="{{ route('courses.categories.view', $course->category) }}">Chuyên mục {{ $course->category->title }}</a></li>
            <li><a style="color: #ff8a00" href="{{ route('courses.view', $course) }}">{{ $course->title }}</a></li>
            <li class="text-dark">{{ $lesson->title }}</li>
            @if(auth()->check() && auth()->user()->isAdmin())
                <li>
                    <a style="color: #ff8a00" href="{{ route('admin.courses.chapters.lessons.detail', [ $course, $lesson->chapter, $lesson]) }}"><i class="fa fa-edit"></i> Edit</a>
                </li>
            @endif
        </ul>
    </div>
    <div class="container">

        <!-- Featured Course -->
        <div class="text-center">
            @if($lesson->isFree() || (auth()->user() && auth()->user()->isFundedActive()))
                @include('layouts.video', ['lesson' => $lesson])
                @else
            <div class="text-center" style="padding: 50px; border: 1px solid grey; border-radius: 5px">
                <h2>Học mọi thứ chỉ với 99k/ tháng</h2>
                <p class="mb-3">Với kho kiến thức được cập nhật hàng ngày vói nhiều bài học hấp dẫn. <br>
                    Hãy đăng kí ngay hôm nay để tận hưởng.</p>
                @if(!auth()->check())
                    <a href="/login" class="btn btn-primary">Đăng nhập</a>
                @else
                @endif
                @include('user.subscription')
            </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="lesson_title mt-3">
                     {{ $lesson->title }}
                </div>
                <p>
                    {{ $lesson->body }}
                </p>
                <hr>
                <div class="mt-3">
                    <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                        <div><div class="latest_post_image"><img src="/images/harry_tran_sm.jpg" alt="Harry Tran"></div></div>
                        <div class="latest_post_body">
                            <div class="latest_post_title mt-0"><a href="/teacher">Harry Tran</a></div>
                            <div class="latest_post_author">
                                Xin chào, tôi là <strong>Trần Quang Huy</strong>. Tôi tốt nghiệp tại trường <strong>Đại học Hà Nội</strong> chuyên ngành <strong>Công nghệ thông tin</strong> bằng Tiếng Anh.
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mt-3">
                    <h4>Tài liệu bài giảng</h4>
                    <p>
                        {!! $lesson->resource !!}
                    </p>
                </div>
                <hr>
                <div class="mt-3">
                    <div class="fb-comments" data-href="{{ url()->current() }}" data-width="" data-numposts="5"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-5">
                    <span class="float-right">
                        <a href="{{ $lesson->previous() ? route('courses.lesson.view', [$course, $lesson->previous()]) : 'javascript:void(0)' }}">Bài trước</a> |
                        <a href="{{ $lesson->next() ? route('courses.lesson.view', [$course, $lesson->next()]) : 'javascript:void(0)' }}">Bài tiếp</a>
                    </span>
                    @foreach($course->chapters as $chapter)
                        <h4 class="mt-3">{{ $chapter->title }}</h4>
                        <ul class="list-group">
                            @foreach($chapter->lessons as $item)
                                    <a class="list-group-item list-group-item-action" href="{{ route('courses.lesson.view', [$course, $item]) }}">
                                        <i class="fa fa-play-circle fa-1x" @if($item->id == $lesson->id)style="color:#ff6600; " @endif></i>
                                        <span class="ml-3">{{ $item->title }}</span>
                                        &middot
                                        <small class="text-muted"><i class="fa fa-clock-o"></i> {{ number_format($item->minutes_length/60, 2) }} phút</small>
                                    </a>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
