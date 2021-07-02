@extends('user.profile')

@section('content-profile')

    <h4 class="mb-4">Khoá học của tôi</h4>
    @if($courses && $courses->count()>0)

        @foreach($courses as $course)
            <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                <div><div class="latest_post_image"><img src="{{ $course->cover_img ? env('AWS_PUBLIC_URL').$course->cover_img : '/images/skill.jpg'}}" alt="{{ $course->title }}"></div></div>
                <div class="latest_post_body">
                    <div class="latest_post_title mt-0"><a href="/courses/{{ $course->slug }}">{{ $course->title }}</a></div>
                    <div class="latest_post_author">{{ $course->body }}</div>
{{--                    Bạn đã học {{ $course->getCompletedLessonByUser(auth()->id()) }}/{{ $course->lessons->count() }} bài--}}
                    <br>
                    <span class="mt-3"><a href="/courses/{{ $course->slug }}" class="mt-3 p-2" style="background-color: #ff6600; color: white">Vào học</a></span>
                </div>
            </div>
            <hr>
        @endforeach
        {{ $courses->links() }}
    @else
        <p>Chưa có khoá học nào.</p>
    @endif

@endsection
