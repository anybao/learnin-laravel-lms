@extends('layouts.user')

@section('title') Liên hệ -@endsection
@section('meta')
    @include('layouts.meta_default')
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <h1>Liên hệ</h1> <br> <br></br>
            <table class="table">
                <tr>
                    <td>
                        <h3>Phone:</h3>
                        +84 0354-003-078
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>Email:</h3>
                        <a href="mailto:daotaovanphong@gmail.com">daotaovanphong@gmail.com</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
