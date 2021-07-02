@extends('layouts.admin')

@section('title') Courses @endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Courses</li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <strong>Courses</strong>
            <div class="card-header-actions">
                <a href="{{ route('admin.courses.add') }}" class="card-header-action">Create new course</a>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Cover Img</th>
                    <th>Category</th>
                    <th>Total chapters</th>
                    <th>Total lessons</th>
                    <th>Displayed</th>
                    <th>Featured</th>
                    <th>Published</th>
                    <th>View</th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $key => $course)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><a href="{{ route('admin.courses.detail', $course) }}">{{ $course->title }}</a></td>
                        <td>@if($course->cover_img)<img src="{{ env('AWS_PUBLIC_URL').$course->cover_img }}" height="100">@else No Image. @endif</td>
                        <td>@if($course->category)<a href="{{ route('admin.courses.categories.detail', $course->category) }}" target="_blank">{{ $course->category->title }}</a>@endif</td>
                        <td>{{ $course->chapters->count() }}</td>
                        <td>{{ $course->lessons->count() }}</td>
                        <td>
                            @if($course->isDisplayed())
                                <span class="badge badge-primary"><i class="fa fa-check-circle"></i> Displayed</span>
                            @else
                                <span class="badge badge-light"><i class="fa fa-times-circle"></i> Hidden</span>
                            @endif
                        </td>
                        <td>
                            @if($course->isFeatured())
                                <span class="badge badge-danger"><i class="fa fa-check-circle"></i> Featured</span>
                            @else
                                <span class="badge badge-light"><i class="fa fa-times"></i> No</span>
                            @endif
                        </td>
                        <td>
                            @if($course->isDraft())
                                <span class="badge badge-light"><i class="fa fa-edit"></i> Draft</span>
                            @else
                                <span class="badge badge-success"><i class="fa fa-check-circle"></i> Published</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('courses.view', $course) }}"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $courses->links() }}
        </div>
    </div>

    @endsection
