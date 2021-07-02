@extends('layouts.user')
@section('title')Đăng nhập - @endsection
@section('meta')
    @include('layouts.meta_default')
@endsection
@section('content')
    <div class="text-center">
        <h2>Đăng nhập</h2>
        <form method="POST" action="{{ route('login') }}" class="mt-3">
            @csrf

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="contact_input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Mật khẩu</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="contact_input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            Ghi nhớ đăng nhập
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0 mt-3">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="contact_button">
                        Đăng nhập
                    </button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Quên mật khẩu
                        </a>
                    @endif
                </div>
            </div>
        </form>
        <div class="text-center mt-5">
            Chưa có tài khoản? <a href="/register">Đăng ký</a> tại đây
        </div>
    </div>
@endsection
