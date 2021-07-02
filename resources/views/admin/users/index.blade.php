@extends('layouts.admin')

@section('title') Users @endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Users</li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <strong>Users</strong>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Last login</th>
                    <th>Is Active</th>
                    <th>Is Funded Active</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $user)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{$user->last_login ? \Carbon\Carbon::make($user->last_login)->diffForHumans() :'' }}</td>
                        <td>
                            @if($user->isActive())
                                <span class="badge badge-success"><i class="fa fa-check-circle"></i> Yes</span>
                            @else
                                <span class="badge badge-light"><i class="fa fa-ban"></i> No</span>
                            @endif
                        </td>
                        <td>
                            @if($user->isFundedActive())
                                <span class="badge badge-success"><i class="fa fa-check-circle"></i> Yes</span>
                            @else
                                <span class="badge badge-light"><i class="fa fa-ban"></i> No</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.users.detail', $user) }}">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>

@endsection
