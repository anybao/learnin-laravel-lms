@extends('layouts.user')

@section('title') Thông tin Giảng viên - Harry Tran @endsection

@section('meta')
    @include('layouts.meta_default')
@endsection

@section('content')

    @include('user.widgets.teacher_info')

@endsection
