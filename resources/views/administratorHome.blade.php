@extends('layouts.default_admin')

@section('content')

<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">Dashboard</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users['total'] }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"> {{ $users_p['user'] }}%</span>
                                    <span>merupakan user</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Admin Unit</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users['adminunit'] }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"> {{ $users_p['adminunit'] }}%</span>
                                    <span>dari user</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-id-card-alt fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Request Admin Unit</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $reqadminunit['total'] }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"> {{ $reqadminunit['requested'] }}%</span>
                                    <span>menunggu untuk disetujui</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-clock fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Bar Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Rekap User</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="barUsers"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Donut Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Rekap Request Admin Unit</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="pieReqAdminunit"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@stop