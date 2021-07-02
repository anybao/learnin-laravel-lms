@extends('layouts.admin')

@section('title') Course Category Detail | {{ $category->title }} @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.courses.categories') }}">Course Categories</a></li>
    <li class="breadcrumb-item active">Category: {{ $category->title }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <strong>Category Overview</strong>
                </div>
                <div class="card-body">
                    <strong>{{ $category->title }}</strong>
                    <p class="mt-3">{{ $category->except }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <strong>Courses</strong>
                    <div class="card-header-actions">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
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
                            </tr>
                            </thead>
                            <tbody>
                            @if($category->courses && $category->courses->count())
                            @foreach($category->courses as $key => $course)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><a href="{{ route('admin.courses.detail', $course) }}">{{ $course->title }}</a></td>
                                    <td>@if($course->cover_img)<img src="{{ env('AWS_PUBLIC_URL').$course->cover_img }}" height="100">@else No Image. @endif</td>
                                    <td>{{ $course->category ? $course->category->title : ''}}</td>
                                    <td>{{ $course->chapters->count() }}</td>
                                    <td>{{ $course->lessons->count() }}</td>
                                    <td>
                                        @if($course->isDisplayed())
                                            <span class="badge badge-success"><i class="fa fa-check-circle"></i> Displayed</span>
                                        @else
                                            <span class="badge badge-light"><i class="fa fa-times-circle"></i> Hidden</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($course->isFeatured())
                                            <span class="badge badge-success"><i class="fa fa-check-circle"></i> Yes</span>
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
                                </tr>
                            @endforeach
                                @else
                            <tr>
                                <td colspan="10">No records.</td>
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
