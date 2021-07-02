@extends('user.profile')

@section('content-profile')

    <h4>Đăng kí của bạn</h4>
    <p class="mt-3">
        @if(auth()->user()->isFundedActive() && auth()->user()->subscriptions)
            <span class="alert alert-info">
                <i class="fa fa-check-circle"></i> Đăng ký của bạn sẽ kết thúc vào {{ \Carbon\Carbon::make(auth()->user()->subscriptions->last()->date_end)->format('d-m-Y') }}

        (còn {{ \Carbon\Carbon::make(auth()->user()->subscriptions->last()->date_end)->diffInDays(\Carbon\Carbon::now()) }} ngày).
            </span>
        @else
        <span class="alert alert-danger">
            <i class="fa fa-warning"></i> Bạn chưa đăng kí gói sử dụng nào.
        </span>
        @endif
    </p>
    <br>
    <h5>Chọn gói đăng ký:</h5>
    @include('user.subscription')

@endsection
