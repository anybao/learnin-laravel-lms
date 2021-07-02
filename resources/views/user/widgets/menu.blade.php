<div class="card card-body">
    <div class="student-info">
        <img src="{{ asset('images/skill.jpg') }}" alt="{{ auth()->user()->name }}" width="100%"> <br> <br>
        <h3 class="text-center"><a href="{{ route('profile') }}">{{ auth()->user()->name }}</a></h3>
        <p class="text-center"><span class=" text-muted">(Tham gia {{ \Carbon\Carbon::make(auth()->user()->created_at)->format('d-m-Y') }})</span></p>
    </div>
    <ul class="list-group mt-3">
        <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action"><i class="fa fa-edit"></i> Chỉnh sửa hồ sơ</a>
        <a href="{{ route('profile.password') }}" class="list-group-item list-group-item-action"><i class="fa fa-lock"></i> Đổi mật khẩu</a>
    </ul>
    <ul class="list-group mt-3">
        <a href="{{ route('profile.lessons') }}" class="list-group-item list-group-item-action"><i class="fa fa-book"></i> Khoá học của tôi</a>
        <a href="{{ route('profile.subscription') }}" class="list-group-item list-group-item-action"><i class="fa fa-book"></i> Gói đăng ký của tôi</a>
        <a href="{{ route('profile.payment') }}" class="list-group-item list-group-item-action"><i class="fa fa-money"></i> Lịch sửa thanh toán</a>
    </ul>
</div>
