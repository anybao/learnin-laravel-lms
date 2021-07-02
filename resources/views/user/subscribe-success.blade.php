@extends('layouts.user')

@section('title') Đăng ký @endsection

@section('meta')
    @include('layouts.meta_default')
@endsection

@section('content')
    @if($invoice)

        <div class="row">
            <div class="col-md-4 text-center">
                <section class="pricing py-5">
                    <div class="container">
                        <div class="card mb-5 mb-lg-0 mt-3">
                            <div class="card-body text-center">
                                <h5 class="card-title text-muted text-uppercase text-center">{{$invoice->month}} tháng</h5>
                                <h6 class="card-price text-center">{{ $invoice->amount }}k<span class="period"></span></h6>
                            </div>
                        </div>
                    </div>
                </section>
                <span class="text-center"><a href="/subscribe">Lựa chọn gói khác</a></span>
            </div>
            <div class="col-md-8 text-center">
                <div class="image mb-3">
                    <img src="{{ asset('images/success-icon.png') }}" alt="" height="100">
                </div>
                <h1>Thành công!</h1>
                <p class="mt-3">
                    {{ session('message') }}
                </p>
            </div>
        </div>
        @else
            @include('user.subscription')
        @endif


@endsection
