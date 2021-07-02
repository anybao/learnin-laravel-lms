@extends('layouts.admin')

@section('title') Chapter Detail | {{ $chapter->title }} @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.courses') }}">Courses</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.courses.detail', $course) }}">Course: {{ $course->title }}</a></li>
    <li class="breadcrumb-item active">Chapter: {{ $chapter->title }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong>Chapter Overview</strong>
                    <div class="card-header-actions">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#edit" class="card-header-action">Edit this Chapter</a>
                        <div class="modal fade bd-example-modal-sm" id="edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Edit this chapter
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            @csrf @method('PUT')
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" class="form-control" required value="{{ $course->title }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="body">Body</label>
                                                <textarea name="body" id="body" class="form-control" rows="2">{{ $course->body }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Submit" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <strong>{{ $chapter->title }}</strong>
                    <p class="mt-3">{{ $chapter->body }}</p>
                </div>
            </div>
            <div class="card card-body mt-3">
                @if($chapter->lessons->count() > 0)
                    <a href="javascript:void(0)" onclick="alert('Can not delete the NOT empty chapter!')" class="text-danger"><i class="fa fa-times-circle"></i> Delete this chapter?</a>
                    @else
                    <a href="javascript:void(0)" onclick="if(confirm('Delete this chapter?')){$('#deleteForm').submit()}" class="text-danger"><i class="fa fa-times-circle"></i> Delete this chapter?</a>
                    <form action="" method="POST" id="deleteForm">@csrf @method('delete')</form>
                    @endif
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Lessons</strong>
                    <div class="card-header-actions">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#addModal" class="card-header-action">Create new Lesson</a>
                        <div class="modal fade bd-example-modal-sm" id="addModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Create new Lesson
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.courses.chapters.lessons.add', [ $course, $chapter]) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Is Free?</label> <br>
                                                <input type="checkbox" id="yes" name="is_free"> <label for="yes">Yes</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="video_url">Video EMBED URL (Youtube for free vid, Vimeo for Paid vid)</label>
                                                <input type="text" name="video_url" id="video_url" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="order">Lesson Order</label>
                                                <input type="number" name="order" id="order" class="form-control" required value="{{ $lesson->order ?? 1 }}">
                                            </div>
{{--                                            <div class="form-group">--}}
{{--                                                <label for="poster">Video Poster</label>--}}
{{--                                                <input type="file" name="file" id="poster" class="form-control">--}}
{{--                                            </div>--}}
                                            <div class="form-group">
                                                <label for="body">Body</label>
                                                <textarea name="body" id="body" class="form-control" rows="2"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="resource">Lesson Resource</label>
                                                <textarea name="resource" id="editor" class="form-control" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="minutes_length">Lesson Duration (seconds)</label>
                                                <input type="number" name="minutes_length" class="form-control" id="minutes_length" required value="0">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="Submit" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.form_message')
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Order</th>
                                <th>Title</th>
                                <th>Length</th>
{{--                                <th>Video URL</th>--}}
                                <th>Free</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($chapter->lessons)
                                @foreach($chapter->lessons as $key => $lesson)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $lesson->order }}</td>
                                        <td>
                                            <a href="{{ route('admin.courses.chapters.lessons.detail', [ $course, $chapter, $lesson ]) }}"><strong>{{ $lesson->title }}</strong></a>
                                            <p class="text-muted">{{ $lesson->body }}</p>
                                        </td>
                                        <td>{{ number_format($lesson->minutes_length/60, 2) }} mins</td>
{{--                                        <td>{{ $lesson->video_url }}</td>--}}
                                        <td>
                                            @if($lesson->isFree())
                                                <span class="badge badge-success"><i class="fa fa-check-circle"></i></span>
                                            @else
                                                <span class="badge badge-danger"><i class="fa fa-lock"></i></span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">No chapter.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
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
