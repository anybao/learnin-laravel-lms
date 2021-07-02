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
                    <h3>Edit Information</h3>
                    <form action="" method="POST">
                        @csrf @method('PUT')
                        <table class="table">
                            <tr>
                                <td>Name:</td>
                                <td><input type="text" name="name" class="form-control" value="{{ $user->name }}"></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><input type="email" name="email" class="form-control" value="{{ $user->email }}"></td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td><input type="text" name="phone" class="form-control" value="{{ $user->phone }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" class="btn btn-primary" value="Save">
                                </td>
                            </tr>
                        </table>
                        @include('layouts.form_message')
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
