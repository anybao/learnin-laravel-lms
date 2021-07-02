<div class="text-center">
    <img src="{{ asset('/images/icon/payment-paypal.jpg') }}" alt="">
</div>
<form class="w3-container w3-display-middle w3-card-4 w3-padding-16" method="POST" id="payment-form"
      action="{{ route('payment.paypal') }}">
    @csrf
    <input type="hidden" name="amount" value="{{ request('amount') }}">
    <input type="hidden" name="month" value="{{ request('month') }}">
    <div class="text-center">
        <button class="btn btn-lg btn-primary">Thanh toán qua paypal ({{ request('amount') }}.000 VND)</button>
    </div>
</form>
