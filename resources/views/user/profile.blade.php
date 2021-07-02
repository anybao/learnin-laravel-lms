@extends('layouts.user')

@section('title') Hồ sơ @endsection
@section('meta')
    @include('layouts.meta_default')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @include('user.widgets.menu')
            </div>
            <div class="col-md-8">
                @yield('content-profile')
            </div>
        </div>
    </div>
@endsection
