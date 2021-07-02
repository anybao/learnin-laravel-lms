@extends('layouts.admin')

@section('title') Course Detail | {{ $course->title }}@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.courses') }}">Courses</a></li>
    <li class="breadcrumb-item active">Course: {{ $course->title }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong>Course Overview</strong>
                    <div class="card-header-actions">
                        <a href="{{ route('admin.courses.edit', $course) }}" class="card-header-action">Edit this course</a>
                        <a href="{{ route('courses.view', $course) }}" class="card-header-action" target="_blank"><i class="fa fa-eye"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <img src="{{ $course->cover_img ? env('AWS_PUBLIC_URL').$course->cover_img  : asset('images/placeholder-square.jpg') }}" alt="{{ $course->title }}" style="width: 100%">
                    <div class="detail mt-3">
                        <strong>{{ $course->title }}</strong>
                        <p class="mt-2">{{ $course->body }}</p>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Duration:</strong> {{ gmdate("H:i:s", $course->minute_length) }}
                            </li>
                            <li class="list-group-item">
                                <strong>Category:</strong>
                                @if($course->category)<a href="{{ route('admin.courses.categories.detail', $course->category) }}">{{ $course->category->title }}</a>@endif
                            </li>
                            <li class="list-group-item">
                                <strong>Display:</strong>
                                @if($course->isDisplayed())
                                    <span class="badge badge-success"><i class="fa fa-check-circle"></i> Displayed</span>
                                @else
                                    <span class="badge badge-light"><i class="fa fa-times-circle"></i> Hidden</span>
                                @endif
                            </li>
                            <li class="list-group-item">
                                <strong>Featured:</strong>
                                @if($course->isFeatured())
                                    <span class="badge badge-success"><i class="fa fa-check-circle"></i> Yes</span>
                                @else
                                    <span class="badge badge-danger"><i class="fa fa-times"></i> No</span>
                                @endif
                            </li>
                            <li class="list-group-item">
                                <strong>In development?:</strong>
                                @if($course->isDraft())
                                    <span class="badge badge-light"><i class="fa fa-edit"></i> In development</span>
                                @else
                                    <span class="badge badge-success"><i class="fa fa-check-circle"></i> Completed</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card card-body mt-3">
                @if(!$course->isDraft())
                    <span class=""><i class="fa fa-check-circle text-success"></i> This course is completed. (<a href="javascript:void(0)" onclick="if(confirm('Do you want to mark as not completed this Course?')){$('#unpublishForm').submit()}">Mark as not completed</a>)</span>
                    <form action="{{ route('admin.courses.unpublish', $course) }}" method="POST" id="unpublishForm">@csrf</form>
                    @else
                    <p>This course is in development.</p>
                <a href="javascript:void(0)" onclick="if(confirm('Do you want to mark as completed this Course?')){$('#publishForm').submit()}"><i class="fa fa-share"></i> Mark as completed?</a>
                <form action="{{ route('admin.courses.publish', $course) }}" method="POST" id="publishForm">@csrf</form>
                    @endif
            </div>
            <div class="card card-body mt-3">
                <a href="javascript:void(0)" onclick="if(confirm('Delete this Course?')){$('#deleteForm').submit()}" class="text-danger"><i class="fa fa-times-circle"></i> Delete this course?</a>
                <form action="" method="POST" id="deleteForm">@csrf @method('delete')</form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Chapters</strong>
                    <div class="card-header-actions">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#addModal" class="card-header-action">Create new Chapter</a>
                        <div class="modal fade bd-example-modal-sm" id="addModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Create new chapter
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.courses.chapter.add', $course) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="body">Body</label>
                                                <textarea name="body" id="body" class="form-control" rows="2"></textarea>
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
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Total lessons</th>
                                <th>Create Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($course->chapters)
                            @foreach($course->chapters as $key => $chapter)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <a href="{{ route('admin.courses.chapters.detail', [$course, $chapter]) }}"><strong>{{ $chapter->title }}</strong></a>
                                        <p class="text-muted">{{ $chapter->body }}</p>
                                    </td>
                                    <td>{{ $chapter->lessons->count() }}</td>
                                    <td>{{ $chapter->created_at->diffForHumans() }}</td>
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
