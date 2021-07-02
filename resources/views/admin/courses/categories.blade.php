@extends('layouts.admin')

@section('title') Courses Categories @endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Course Categories</li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <strong>Courses Categories</strong>
            <div class="card-header-actions">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#addModal" class="card-header-action">Create new Category</a>
                <div class="modal fade bd-example-modal-sm" id="addModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                Create new Category
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.courses.categories.add') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="body">Tag</label>
                                        <input type="text" name="tag" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="order">Order</label>
                                        <input type="number" class="form-control" required name="order" value="{{ old('order') ?? 0 }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="except">Description</label>
                                        <textarea name="except" id="except" class="form-control"></textarea>
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
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Tag</th>
                    <th>Oder</th>
                    <th>Description</th>
                    <th>No. courses</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><a href="{{ route('admin.courses.categories.detail', $item) }}"><strong>{{ $item->title }}</strong></a></td>
                        <td>#{{ $item->tag }}</td>
                        <td>{{ $item->order }}</td>
                        <td>{{ $item->except }}</td>
                        <td>{{ $item->courses ? $item->courses->count() : 0}}</td>
                        <td>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#editModal{{ $item->id }}" class="text-warning"><i class="fa fa-edit"></i> Edit</a>
                            <div class="modal fade bd-example-modal-sm" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Edit Category {{ $item->title }}
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.courses.categories.update', $item) }}" method="POST">
                                                @csrf @method('PUT')
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title" class="form-control" required value="{{ $item->title }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="body">Tag</label>
                                                    <input type="text" name="tag" class="form-control" required value="{{ $item->tag }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="order">Order</label>
                                                    <input type="number" class="form-control" required name="order" value="{{ $item->order }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="except">Description</label>
                                                    <textarea name="except" id="except" class="form-control">{{ $item->except }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" value="Submit" class="btn btn-primary">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            &middot
                            <a href="javascript:void(0)" class="text-danger" onclick="if(confirm('Delete this category?')){$('#delete{{ $item->id }}').submit()}"><i class="fa fa-times-circle"></i> Delete</a>
                            <form action="{{ route('admin.courses.categories.delete', $item) }}" method="POST" id="delete{{ $item->id }}">@csrf @method('delete')</form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
