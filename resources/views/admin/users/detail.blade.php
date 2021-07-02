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
                    <h3>View information</h3>
                    <table class="table table-bordered">
                        <tr>
                            <td>Name:</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <td>Registration Date:</td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <td>Last login:</td>
                            <td>{{ $user->last_login ? \Carbon\Carbon::make($user->last_login)->diffForHumans() : ''}}</td>
                        </tr>
                        <tr>
                            <td>Count login:</td>
                            <td>{{ $user->count_login }}</td>
                        </tr>
                        <tr>
                            <td>Is Active:</td>
                            <td>{{ $user->isActive() ? 'Yes' : 'No' }}</td>
                        </tr>
                        <tr>
                            <td>Is Funded Active:</td>
                            <td>{{ $user->isFundedActive() ? 'Yes' : 'No' }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>

@endsection
