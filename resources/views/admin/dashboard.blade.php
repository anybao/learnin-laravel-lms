@extends('layouts.admin')
@section('title') Dashboard @endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ \Carbon\Carbon::now()->format('H:i a, d/m/Y') }}</li>
@endsection
@section('content')

<div class="fade-in">
    <div class="row">
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-gradient-danger">
                <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-value-lg">{{ number_format($data['total_revenue']) }} VND</div>
                        <div>Revenue</div>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="c-icon">
                                <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('admin.invoices') }}">View all</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart4" height="70"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-gradient-primary">
                <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-value-lg">{{ $data['total_users'] }}</div>
                        <div>Members</div>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="c-icon">
                                <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('admin.users') }}">View all</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-gradient-info">
                <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-value-lg">{{ $data['total_active_courses'] }}</div>
                        <div>Active Courses</div>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="c-icon">
                                <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('admin.courses') }}">View all</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart2" height="70"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-gradient-warning">
                <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-value-lg">{{ $data['total_lessons'] }}</div>
                        <div>Lessons</div>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="c-icon">
                                <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3" style="height:70px;">
                    <canvas class="chart" id="card-chart3" height="70"></canvas>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row-->
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title mb-0">Traffic in last 28 days</h4>
                    <div class="small text-muted">Monthly</div>
                </div>
                <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                    <a class="card-header-action" href="https://analytics.google.com/analytics/web/#/report-home/a163337928w228679548p215646790v" target="_blank"><i class="fa fa-eye"></i> View more in Google Analytics</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div style="width:100%;">
                            {!! $chartjs->render() !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="width:100%;">
                            {!! $chartjsVisitors->render() !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div style="width:100%;">
                            {!! $chartBrowsers->render() !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="width:100%;">
                            {!! $chartUserType->render() !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="width:100%;">
                            {!! $charttopReferers->render() !!}
                        </div>
                    </div>
                </div>
            @push('header-scripts')
                <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
            @endpush
        </div>

        <div class="card-footer">
            <div class="row text-center">
                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">Visits</div><strong>29.703 Users (40%)</strong>
                    <div class="progress progress-xs mt-2">
                        <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">Unique</div><strong>24.093 Users (20%)</strong>
                    <div class="progress progress-xs mt-2">
                        <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">Pageviews</div><strong>78.706 Views (60%)</strong>
                    <div class="progress progress-xs mt-2">
                        <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">New Users</div><strong>22.123 Users (80%)</strong>
                    <div class="progress progress-xs mt-2">
                        <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">Bounce Rate</div><strong>40.15%</strong>
                    <div class="progress progress-xs mt-2">
                        <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- /.card-->

    <!-- /.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Sales</div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">
                                <svg class="c-icon">
                                    <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                                </svg>
                            </th>
                            <th>User</th>
                            <th class="text-center">Country</th>
                            <th>Usage</th>
                            <th class="text-center">Payment Method</th>
                            <th>Activity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($users->count() > 0)
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">
                                        <div class="c-avatar"><img class="c-avatar-img" src="/images/logo.png" alt="{{ $user->email }}"><span class="c-avatar-status bg-success"></span></div>
                                    </td>
                                    <td>
                                        <div>{{ $user->name }}</div>
                                        <div class="small text-muted"><span class="badge badge-primary">New</span> | Registered: {{ \Carbon\Carbon::make($user->created_at)->format('M d, Y') }}</div>
                                    </td>
                                    <td class="text-center">
                                        <svg class="c-icon c-icon-xl">
                                            <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/flag.svg#cif-vn"></use>
                                        </svg>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-left"><strong>50%</strong></div>
                                            <div class="float-right"><small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small></div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <svg class="c-icon c-icon-xl">
                                            <use xlink:href="/coreui/dist/vendors/@coreui/icons/svg/brand.svg#cib-cc-mastercard"></use>
                                        </svg>
                                    </td>
                                    <td>
                                        <div class="small text-muted">Last login</div><strong>{{ $user->last_login ? \Carbon\Carbon::make($user->last_login)->diffForHumans() : '' }}</strong>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                        <tr>
                            <td colspan="6">No data.</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
</div>
@endsection
