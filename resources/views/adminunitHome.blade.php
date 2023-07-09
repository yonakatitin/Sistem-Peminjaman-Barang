@extends('layouts.default_adminunit')

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
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Barang</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $barang['jumlah'] }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"> {{ $barang['available'] }}%</span>
                                    <span>dapat dipinjam</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-primary"></i>
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
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Peminjaman</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $peminjaman['jml_peminjaman'] }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"> {{ $peminjaman['berlangsung'] }}%</span>
                                    <span>sedang berlangsung</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-success"></i>
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
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Request Peminjaman</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $peminjaman['jml_req'] }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"> {{ $peminjaman['requested'] }}%</span>
                                    <span>menunggu untuk disetujui</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-inbox fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Barang
                    </div>
                    <div class="card-body"><canvas id="barBarang" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Peminjaman
                    </div>
                    <div class="card-body"><canvas id="piePeminjaman" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
    </div>
</main>
@stop