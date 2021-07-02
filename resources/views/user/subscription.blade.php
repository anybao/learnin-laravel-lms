<p class="text-center">Chọn gói đăng ký của bạn</p>
<section class="pricing py-5">
    <div class="container">
        <div class="row">
            <!-- Free Tier -->
            <div class="col-lg-4">
                <div class="card mb-5 mb-lg-0 mt-3">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">1 tháng</h5>
                        <h6 class="card-price text-center">99k<span class="period"></span></h6>
                        <hr>
                        <a href="{{ route('subscribe') }}?amount=99&month=1" class="btn btn-block btn-outline-primary text-uppercase">Đăng ký</a>
                    </div>
                </div>
            </div>
            <!-- Plus Tier -->
            <div class="col-lg-4">
                <div class="card mb-5 mb-lg-0 mt-3">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">3 tháng</h5>
                        <h6 class="card-price text-center">299k<span class="period"></span></h6>
                        <hr>
                        <a href="{{ route('subscribe') }}?amount=299&month=3" class="btn btn-block btn-primary text-uppercase">Đăng ký</a>
                    </div>
                </div>
            </div>
            <!-- Pro Tier -->
            <div class="col-lg-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">6 tháng</h5>
                        <h6 class="card-price text-center">499k<span class="period"></span></h6>
                        <hr>
                        <a href="{{ route('subscribe') }}?amount=499&month=6" class="btn btn-block btn-outline-primary text-uppercase">Đăng ký</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
