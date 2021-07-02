@extends('layouts.admin')

@section('title') Invoices @endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Invoices</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Invoices "{{ ucfirst(request('status') ? request('status') : '') }}"</strong>
            <div class="card-header-actions">
                <a href="{{ route('admin.invoices') }}"  class="card-header-action">All</a>
                <a href="{{ route('admin.invoices') }}?status=draft"  class="card-header-action">Draft</a>
                <a href="{{ route('admin.invoices') }}?status=new"  class="card-header-action">New</a>
                <a href="{{ route('admin.invoices') }}?status=completed"  class="card-header-action">Completed</a>
                <a href="{{ route('admin.invoices') }}?status=error"  class="card-header-action">Error</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Grand total</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Buyer</th>
                        <th>Created Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->id }}</td>
                            <td><a href="{{ route('admin.invoices.detail', $invoice) }}"><strong>{{ $invoice->code }}</strong></a></td>
                            <td>{{ number_format($invoice->grand_total, 2) }} VND</td>
                            <td>
                                {{ $invoice->payment_method }}
                            </td>
                            <td>
                                @if($invoice->status == 'completed')
                                    <span class="badge badge-success">{{ $invoice->status }}</span>
                                @elseif($invoice->status == 'new')
                                    <span class="badge badge-primary">{{ $invoice->status }}</span>
                                @else
                                    {{ $invoice->status }}
                                @endif
                            </td>
                            <td><a href="{{ route('admin.users.detail', $invoice->buyer) }}">{{ $invoice->buyer ? $invoice->buyer->name : '' }}</a></td>
                            <td>{{ $invoice->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
@endsection
