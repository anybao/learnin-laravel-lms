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
                                <th>Invoice</th>
                                <th>Total month</th>
                                <th>Date start</th>
                                <th>Date end</th>
                                <th>Days left</th>
                                <th>Available?</th>
                                <th>Created Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($user->subscriptions)
                                @foreach($user->subscriptions as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="{{ route('admin.invoices.detail', $item->invoice) }}">{{ $item->invoice->code }}</a></td>
                                    <td>{{ $item->total_month }}</td>
                                    <td>{{ \Carbon\Carbon::make($item->date_start)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::make($item->date_end)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::make($item->date_end)->diffInDays(\Carbon\Carbon::now()) }} days</td>
                                    <td>
                                        @if($item->isExpired())
                                            <span class="badge badge-danger">Expired</span>
                                            @else
                                            <span class="badge badge-success">Available</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::make($item->created_at)->format('H:i a, d/m/Y') }}</td>
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
