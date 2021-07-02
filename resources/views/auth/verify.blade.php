@extends('layouts.user')
@section('title')Xác nhận email - @endsection
@section('meta')
    @include('layouts.meta_default')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Link kích hoạt tài khoản đã được gửi đến email của bạn. Vui lòng kiểm tra email!
                        </div>
                    @endif

                    Trước khi tiếp tục, vui lòng kích hoạt tài khoản qua link được gửi tới email của bạn.
                    Nếu bạn không nhận được email
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">click vào đây để chúng tôi gửi lại</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
