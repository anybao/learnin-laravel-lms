@extends('user.profile')

@section('content-profile')
    <h4>Chỉnh sửa hồ sơ</h4>
    <form action="" method="POST">
        @csrf  @method('PUT')
        <div class="form-group">
            <label for="name">Họ tên</label>
            <input type="text" required id="name" class="form-control" name="name" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" required id="email" class="form-control" name="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <input type="submit" value="Lưu lại" class="btn btn-primary">
        </div>
    </form>
    @include('layouts.form_message')

@endsection
