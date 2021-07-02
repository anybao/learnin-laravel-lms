@extends('layouts.user')

@section('title') Kết quả tìm kiếm @endsection
@section('meta')
    @include('layouts.meta_default')
@endsection
@section('content')
    <div class="container">
        <h3>Kết quả tìm kiếm cho từ khoá "{{ request('keywords') }}"</h3>
        <hr>
        <div class="mt-5">
            @if($result_courses && $result_courses->count()>0)
                @foreach($result_courses as $item)
                    <div class="news_post d-flex flex-row align-items-start justify-content-start">
                        <div><div class="news_post_image"><img height="60" src="{{ $item['cover_img'] ? env('AWS_PUBLIC_URL').$item['cover_img']  : ('/images/skill.jpg') }}" alt="{{ $item['title'] }}"></div></div>
                        <div class="news_post_body mt-0 ml-3 mb-0 pt-0 pb-1">
                            <h3><a style="color: #ff6600" href="{{ route('courses.view', $item) }}">{{ $item->title }}</a></h3>
                            <div class="news_post_author">{{ $item->body }}</div>
                        </div>
                    </div>
                @endforeach
                    {{ $result_courses->appends(request()->query())->links() }}
                @else

                <div class="text-center">
                    <img src="/images/no_results.png" alt="No results" height="130"> <br> <br>
                    <p class="mt-3">
                        Không có kết quả! Vui lòng thử lại với từ khoá khác.
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
