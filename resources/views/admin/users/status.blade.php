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
                    <h3>Change Status</h3>
                    <form action="" method="POST">
                        @csrf @method('PUT')
                        <table class="table">
                            <tr>
                                <td>Is Active:</td>
                                <td>
                                    <input type="checkbox" name="is_active" id="is_active" @if($user->isActive()) checked @endif>
                                    <label for="is_active">Yes</label>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" value="Save" class="btn btn-primary">
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
