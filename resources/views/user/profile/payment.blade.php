@extends('user.profile')

@section('content-profile')

    <h4>Lịch sử thanh toán</h4>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>STT</th>
                <th>Thời gian</th>
                <th>Số tiền</th>
                <th>Trạng thái</th>
{{--                <th>Xem hoá đơn</th>--}}
            </tr>
            </thead>
            <tbody>
            @if($invoices)
                @foreach($invoices as $key => $invoice)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ \Carbon\Carbon::make($invoice->created_at)->format('d/m/Y') }}</td>
                        <td>{{ number_format($invoice->grand_total,2) }} VND</td>
                        <td>{{ $invoice->status }}</td>
{{--                        <td><a href="#">Hoá đơn</a></td>--}}
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">Không có dữ liệu.</td>
                </tr>

            @endif
            </tbody>
        </table>
    </div>

@endsection
