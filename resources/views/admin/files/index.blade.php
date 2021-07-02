@extends('layouts.admin')

@section('title') Files @endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Files</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tile</th>
                        <th>Size</th>
                        <th>Path</th>
                        <th>Created Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)
                        <tr>
                            <td>{{ $file->id }}</td>
                            <td>{{ $file->title }}</td>
                            <td>{{ $file->size_in_kb }} Kb</td>
                            <td><a href="{{ env('AWS_PUBLIC_URL','https://daotaovanphong.s3-ap-southeast-1.amazonaws.com/').$file->path }}" target="_blank">{{$file->path}}</a></td>
                            <td>{{ $file->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $files->links() }}
            </div>
        </div>
    </div>
    @endsection
