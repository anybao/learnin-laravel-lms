@extends('layouts.admin')

@section('title') Users @endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Users</li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <strong>{{ $user->name }}</strong>
        </div>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-md-4">
                    @include('admin.users.menu')
                </div>
                <div class="col-md-8">
                    <h3>Invoices</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Grand Total</th>
                                <th>Status</th>
                                <th>Payment Method</th>
                                <th>Created Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($user->invoices)
                                @foreach($user->invoices as $key => $invoice)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="{{ route('admin.invoices.detail', $invoice) }}">{{ $invoice->code }}</a></td>
                                    <td>{{ number_format($invoice->grand_total, 2) }} VND</td>
                                    <td>
                                        @if($invoice->status == 'completed')
                                            <span class="badge badge-success">{{ $invoice->status }}</span>
                                            @elseif($invoice->status == 'new')
                                            <span class="badge badge-primary">{{ $invoice->status }}</span>
                                        @else
                                            {{ $invoice->status }}
                                            @endif
                                    </td>
                                    <td>{{ $invoice->payment_method }}</td>
                                    <td>{{ $invoice->created_at }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
