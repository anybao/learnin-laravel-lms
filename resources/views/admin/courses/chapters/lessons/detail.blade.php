@extends('layouts.admin')

@section('title') Chapter Detail | {{ $chapter->title }} @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.courses') }}">Courses</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.courses.detail', $course) }}">Course: {{ $course->title }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.courses.chapters.detail', [ $course, $chapter ]) }}">Chapter: {{ $chapter->title }}</a></li>
    <li class="breadcrumb-item active">Lesson: {{ $lesson->title }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong>Lesson Overview</strong>
                    <div class="card-header-actions">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#addModal" class="card-header-action">Edit this Lesson</a>
                        <div class="modal fade bd-example-modal-sm" id="addModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Update Lesson
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            @csrf @method('put')
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" class="form-control" required value="{{ $lesson->title }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Is Free?</label> <br>
                                                <input type="checkbox" id="yes" name="is_free" @if($lesson->isFree()) checked @endif> <label for="yes">Yes</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="video_url">Video EMBED URL (Youtube for free vid, Vimeo for Paid vid)</label>
                                                <input type="text" name="video_url" id="video_url" class="form-control" required value="{{ $lesson->video_url }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="order">Lesson Order</label>
                                                <input type="number" name="order" id="order" class="form-control" required value="{{ $lesson->order ?? 1 }}">
                                            </div>
{{--                                            <div class="form-group">--}}
{{--                                                <label for="poster">Video Poster</label>--}}
{{--                                                @if($lesson->poster)--}}
{{--                                                    <br>--}}
{{--                                                    <img src="{{ env('AWS_PUBLIC_URL').$lesson->poster }}" alt="{{ $lesson->title }}" height="150">--}}
{{--                                                    @endif--}}
{{--                                                <input type="file" name="file" id="poster" class="form-control">--}}
{{--                                            </div>--}}
                                            <div class="form-group">
                                                <label for="body">Body</label>
                                                <textarea name="body" id="body" class="form-control" rows="2">{{ $lesson->body }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="resource">Lesson Resource</label>
                                                <textarea name="resource" id="editor" class="form-control" rows="3">{{ $lesson->resource }}</textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="minutes_length">Lesson Duration (seconds)</label>
                                                        <input type="number" name="minutes_length" class="form-control" id="minutes_length" required  value="{{ $lesson->minutes_length }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="chapter">Chapter</label>
                                                        <select name="chapter" id="chapter" class="form-control">
                                                            <option value="">Please select</option>
                                                            @if($course->chapters && $course->chapters->count() > 0)
                                                                @foreach($course->chapters as $chapter)
                                                                    <option value="{{ $chapter->id }}" @if($lesson->chapter_id == $chapter->id) selected @endif >{{ $chapter->title }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Submit" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('courses.lesson.view', [ $course, $lesson ]) }}" class="card-header-action" target="_blank"><i class="fa fa-eye"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.form_message')
                    @if($lesson->poster)
                        <div class="lesson-img mb-3">
                            <img src="{{ env('AWS_PUBLIC_URL').$lesson->poster }}" alt="{{ $lesson->title }}" width="100%">
                        </div>
                    @endif
                    <strong>{{ $lesson->title }}</strong> <br>

                    <p class="mt-3">{!! $lesson->body !!}</p>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Type: </strong>
                            @if($lesson->isFree())
                                <span class="badge badge-success">Free</span>
                            @else
                                <span class="badge badge-danger">Paid</span>
                            @endif
                        </li>

                        <li class="list-group-item">
                            <strong>Lesson Order: </strong>{{ ($lesson->order) }}
                        </li>
                        <li class="list-group-item">
                            <strong>Video Length: </strong>{{ number_format($lesson->minutes_length/60, 2) }} mins
                        </li>
                        <li class="list-group-item">
                            <strong>Video Url: </strong><a href="{{ $lesson->video_url }}" target="_blank" title="{{ $lesson->video_url }}">{{ $lesson->video_url }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card card-body mt-3">
                <a href="javascript:void(0)" onclick="if(confirm('Delete this lesson?')){$('#deleteLesson').submit()}" class="text-danger"><i class="fa fa-times-circle"></i> Delete this lesson?</a>
                <form action="" method="POST" id="deleteLesson">@csrf @method('delete')</form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Lesson Video Preview</strong>
                </div>
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe src="{{ $lesson->video_url }}?rel=0&autoplay=1&modestbranding=1" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('header-scripts')
    <script>
        tinymce.init({
            selector: '#editor',
            plugins: 'print preview importcss tinydrive searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
            menubar: 'file edit view insert format tools table tc help',
        });
        tinymce.init({
            selector: '#editor2',
            plugins: 'print preview importcss tinydrive searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
            menubar: 'file edit view insert format tools table tc help',
        });
    </script>
@endpush
