@extends('user.profile')

@section('content-profile')

    <h4>Đổi mật khẩu</h4>
    <form action="" method="POST">
        @csrf  @method('PUT')
        <div class="form-group">
            <label for="password_old">Mật khẩu cũ</label>
            <input type="password" required id="password_old" class="form-control" name="password_old">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu mới</label>
            <input type="password" required id="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Nhập lại mật khẩu mới</label>
            <input type="password" required id="password_confirmation" class="form-control" name="password_confirmation">
        </div>
        <div class="form-group">
            <input type="submit" value="Lưu lại" class="btn btn-primary">
        </div>
    </form>

    @include('layouts.form_message')
@endsection
