@extends('layouts.user')

@section('title') Đăng ký @endsection

@section('meta')
    @include('layouts.meta_default')
@endsection

@section('content')
    @if(request('amount') && request('month') && in_array(request('amount'), [99, 299, 499]) && in_array(request('month'), [1, 3, 6]))

        <div class="row">
            <div class="col-md-4 text-center">
                <section class="pricing py-5">
                    <div class="container">
                        <div class="card mb-5 mb-lg-0 mt-3">
                            <div class="card-body text-center">
                                <h5 class="card-title text-muted text-uppercase text-center">{{request('month')}} tháng</h5>
                                <h6 class="card-price text-center">{{ request('amount') }}k<span class="period"></span></h6>
                                <hr>
                                <p>Đăng ký của bạn kéo dài tới {{ \Carbon\Carbon::now()->addMonths(request('month'))->format('d-m-Y') }}</p>
                            </div>
                        </div>
                    </div>
                </section>
                <span class="text-center"><a href="/subscribe">Lựa chọn gói khác</a></span>
            </div>
            <div class="col-md-8 text-center">
                @include('layouts.form_message')
                <h4 class="mb-3">Lựa chọn hình thức thanh toán</h4>
                <div class="row">
                    <div class="col-md-6">
                        <input type="radio" name="payment_method" value="bank" id="bank" onchange="togglePayment()" checked> <label for="bank">Chuyển khoản ngân hàng</label>
                    </div>
                    <div class="col-md-6">
                        <input type="radio" name="payment_method" value="paypal" onchange="togglePayment()" id="paypal"> <label for="paypal">Thanh toán thẻ tín dụng (Visa/ Master/ Paypal)</label>
                    </div>
                </div>
                <br>
                <div class="paypal" style="display: none">
                    <img src="{{ asset('images/payment-paypal.jpg') }}" alt="Thanh toán qua paypal">
                    <br>
                    @include('user.widgets.paypal')
                </div>
                <div class="bank">
                    <h4>Thanh toán chuyển khoản ngân hàng</h4>
                    <div class="card card-body">
                        <h4>Số tiền: <span class="font-weight-bold">{{ request('amount') }}.000 VND</span></h4>
                        <p>Nội dung chuyển khoản: {{ env('APP_NAME') }} + SĐT của bạn</p>
                        <p class="mb-3">Chuyển khoản tới</p>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Số tài khoản:</strong> <span class="text-danger font-weight-bold">{{ env('BANK_TRANSFER_ACCOUNT', '19030-5616-08-013') }}</span></li>
                            <li class="list-group-item"><strong>Chủ tài khoản:</strong> {{ env('BANK_TRANSFER_RECEIVER', 'Trần Quang Huy') }}</li>
                            <li class="list-group-item"><strong>Ngân hàng:</strong>{{ env('BANK_TRANSFER_NAME', ' Techcombank') }}, {{ env('BANK_TRANSFER_BRANCH', 'Hà Nội') }}</li>
                        </ul>
                    </div>
                    <br>
                    <form action="" method="POST">@csrf
                        <div class="form-group">
                            <label for="bank_proof">Tải lên ảnh giao dịch</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                        <input type="hidden" name="month" value="{{ request('month') }}">
                        <input type="hidden" name="amount" value="{{ request('amount') }}">
                        <button type="submit" class="btn btn-primary">Thông báo cho chúng tôi</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function togglePayment(){
                $('.bank').toggle();
                $('.paypal').toggle();
            }
        </script>
        @else

        @include('user.subscription')

        @endif


@endsection
