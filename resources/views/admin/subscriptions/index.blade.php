@extends('layouts.admin')

@section('title') Subscriptions @endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Subscriptions</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Subscriptions</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Invoice</th>
                        <th>Status</th>
                        <th>Total month</th>
                        <th>Date start</th>
                        <th>Date end</th>
                        <th>Time left</th>
                        <th>Created Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subscriptions as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><a href="{{ route('admin.users.detail', $item->user) }}">{{ $item->user->name ?? '' }}</a></td>
                            <td><a href="{{ route('admin.invoices.detail', $item->invoice) }}"><strong>{{ $item->invoice->code }}</strong></a></td>
                            <td>
                                @if(!$item->isExpired())
                                    <span class="badge badge-success"><i class="fa fa-check-circle"></i> OK</span>
                                @else
                                    <span class="badge badge-danger"><i class="fa fa-times-circle"></i> Expired</span>
                                @endif
                            </td>
                            <td>{{ $item->total_month }}</td>
                            <td>{{ \Carbon\Carbon::make($item->date_start)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::make($item->date_start)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::make($item->date_end)->diffInDays(\Carbon\Carbon::now()) }} days</td>
                            <td>{{ \Carbon\Carbon::make($item->created_at)->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $subscriptions->links() }}
            </div>
        </div>
    </div>
@endsection
