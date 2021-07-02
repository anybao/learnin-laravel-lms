@extends('layouts.admin')

@section('title') Add Courses @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.courses') }}">Courses</a></li>
    <li class="breadcrumb-item active">Add a new course</li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header"><strong>Create a new course</strong></div>
        <div class="card-body">
            @include('layouts.form_message')
            <form action="" method="POST" enctype="multipart/form-data" id="form">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" required name="title" value="{{ old('title') ?? '' }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="course_category_id">Category</label>
                            <select name="course_category_id" id="course_category_id" class="form-control" required>
                                <option value="">Please select</option>
                                @if($categories)
                                    @foreach($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                        @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="minute_length">Course Duration (in second)</label>
                            <input type="number" class="form-control" required name="minute_length" value="{{ old('minute_length') ?? 11710 }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="body">Excerpt</label>
                    <textarea name="body" id="body" class="form-control" rows="5">{{ old('body') ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="description">Long Description</label>
                    <textarea name="description" id="editor" class="form-control" rows="5">{{ old('description') ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="keywords">Keywords</label>
                    <textarea name="keywords" id="keywords" class="form-control" rows="2">{{ old('keywords') ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="thumbnail">Cover Image (690 x 522)</label>
                    <input type="file" name="file" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Display this?</label> <br>
                        <input type="checkbox" id="is_displayed" name="is_displayed" checked> <label for="is_displayed">Is Displayed?</label>
                    </div>
                    <div class="col-md-6">
                        <label for="">Feature this</label> <br>
                        <input type="checkbox" id="is_featured" name="is_featured"> <label for="is_featured">Is Featured?</label>
                    </div>
                </div>
                <br> <br>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
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
