@php
    $categories = \Illuminate\Support\Facades\Cache::get('categories::courses:all');
    if(!$categories)
    {
        $categories = \App\CourseCategory::orderBy('order', 'ASC')->with('courseshomepage')->get()->toArray();
        \Illuminate\Support\Facades\Cache::put('categories::courses:all', $categories);
    }
@endphp
@extends('layouts.user')
@section('title') Các Khoá học -@endsection
@section('meta')
    @include('layouts.meta_default')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="section_title text-center"><h2>@if(isset($category)) {{ $category->title }} @else Các Khóa học @endif</h2></div>
                <div class="section_subtitle">
                    @if(isset($category) && $category->except)
                        {{ $category->except }}
                        @else
                        Hàng chục bài học mới được cập nhật hàng tuần về tất cả những kĩ năng làm việc, <br>học tập cần thiết cho bạn trong thời đại công nghệ 4.0
                        @endif
                </div>
                <div class="text-center mt-3">
                    Xem thêm:
                    @foreach($categories as $item)
                        @if(isset($item))
                        <a style="color: #ff6600" href="{{ route('courses.categories.view', $item['tag']) }}">{{ $item['title'] }}</a>,
                        @endif
                    @endforeach
                    ...
                </div>
            </div>
        </div>

        <div class="row courses_row">

            @foreach($courses as $course)
                <!-- Course -->
                    <div class="col-lg-4 col-md-6">
                        @include('user.widgets.course_info_vertical', ['course' => $course])
                    </div>
                @endforeach

        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col">
                <div class="courses_paginations">
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
