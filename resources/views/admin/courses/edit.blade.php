@extends('layouts.admin')

@section('title') Edit Courses @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.courses') }}">Courses</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.courses.detail', $course) }}">{{ $course->title }}</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header"><strong>Course Edit</strong></div>
        <div class="card-body">
            @include('layouts.form_message')
            <form action="" method="POST" enctype="multipart/form-data" id="form">
                @csrf @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" required name="title" value="{{ $course->title }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="course_category_id">Category</label>
                            <select name="course_category_id" id="course_category_id" class="form-control" required>
                                <option value="">Please select</option>
                                @if($categories)
                                    @foreach($categories as $item)
                                        <option value="{{ $item->id }}" @if($item->id == $course->course_category_id) selected @endif>{{ $item->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="minute_length">Course Duration (mins)</label>
                            <input type="number" class="form-control" required name="minute_length" value="{{ $course->minute_length }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="body">Excerpt</label>
                    <textarea name="body" id="body" class="form-control" rows="5">{{ $course->body }}</textarea>
                </div>

                <div class="form-group">
                    <label for="description">Long Description</label>
                    <textarea name="description" id="editor" class="form-control" rows="5">{{ $course->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="keywords">Keywords</label>
                    <textarea name="keywords" id="keywords" class="form-control" rows="5">{{ $course->keywords }}</textarea>
                </div>

                <div class="form-group">
                    <label for="thumbnail">Cover Image</label> <br>
                    <img src="{{ env('AWS_PUBLIC_URL').$course->cover_img }}" alt="{{ $course->title }}" height="80">
                    <br><br>
                    <input type="file" name="file" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Display this?</label> <br>
                        <input type="checkbox" id="is_displayed" name="is_displayed" @if($course->isDisplayed()) checked @endif> <label for="is_displayed">Is Displayed?</label>
                    </div>
                    <div class="col-md-6">
                        <label for="">Feature this</label> <br>
                        <input type="checkbox" id="is_featured" name="is_featured" @if($course->isFeatured()) checked @endif> <label for="is_featured">Is Featured?</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-primary" onclick="$('#form').submit()">Submit</button>
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
    </script>
@endpush
