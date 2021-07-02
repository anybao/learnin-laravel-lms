@extends('layouts.admin')

@section('title') Invoices @endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('admin.invoices') }}">Invoices</a></li>
    <li class="breadcrumb-item active">Invoice Detail</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Invoices "{{ $invoice->code }}"</strong>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-9">
                    <table class="table table-striped">
                        <tr>
                            <td><strong>Grand total</strong></td>
                            <td><strong>{{ number_format($invoice->grand_total, 2) }} VND</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>
                                {{ ucfirst($invoice->status) }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Buyer</strong></td>
                            <td>
                                <a href="{{ route('admin.users.detail', $invoice->buyer) }}">{{ $invoice->buyer->name }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Payment Method</strong></td>
                            <td>{{ ucfirst($invoice->payment_method) }}</td>
                        </tr>
                        @if($invoice->payment_method == 'paypal')
                            <tr>
                                <td>Paypal Payment ID</td>
                                <td>{{ $invoice->paypal_payment_id }}</td>
                            </tr>
                            <tr>
                                <td>Paypal Payer ID</td>
                                <td>{{ $invoice->paypal_PayerID }}</td>
                            </tr>

                            <tr>
                                <td>Paypal Token</td>
                                <td>{{ $invoice->paypal_token }}</td>
                            </tr>
                            <tr>
                                <td>Paypal Payment Status</td>
                                <td>{{ $invoice->paypal_payment_status }}</td>
                            </tr>
                            @endif
                        @if($invoice->payment_method == 'bank_transfer')
                            <tr>
                                <td>Bank file path</td>
                                <td>
                                    @if($invoice->bank_transfer_path)
                                        <a href="{{ env('AWS_PUBLIC_URL').$invoice->bank_transfer_path }}">{{ env('AWS_PUBLIC_URL').$invoice->bank_transfer_path }}</a>
                                    @else
                                        <span class="text-danger"><i class="fa fa-times-circle"></i> Không có file.</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td><strong>Amount</strong></td>
                            <td>{{ ($invoice->amount) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Month</strong></td>
                            <td>{{ ($invoice->month) }} month</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3">
                    @if($invoice->isVerified())
                    This invoice is verified by {{ $invoice->verifier->name }}, at {{ $invoice->verified_at }}
                        @else
                        <form action="{{ route('admin.invoices.verify', $invoice) }}" method="POST">
                            @csrf @method('put')
                            <div class="form-group">
                                <label for="verify_note">Verify Notes</label>
                                <textarea name="verify_note" id="verify_note" class="form-control">I verify this invoice</textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Verify" class="btn btn-primary">
                            </div>
                        </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
