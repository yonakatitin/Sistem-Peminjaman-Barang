@extends('layouts.default_admin')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">Tambah User</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/user">User</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
        <!-- <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>
                        </div> -->
        <div class="card mb-4">
            <div class="card-header">
                <!-- <i class="fas fa-table me-1"></i> -->
                Tambah Barang
            </div>
            <div class="card-body">
                <form action="/admin/user/store" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="$id_unit">
                    {{ csrf_field() }}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <!-- <span>Nama Unit</span> -->
                                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{ old('name') }}" />
                                <label for="name">Nama</label>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <!-- <span>Lokasi Unit</span> -->
                                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="text" value="{{ old('email') }}" />
                                <label for="email">Email</label>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <!-- <span>Nama Unit</span> -->
                                <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" />
                                <label for="password">Password</label>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <!-- <span>Lokasi Unit</span> -->
                                <input class="form-control @error('password') is-invalid @enderror" id="password-confirm" name="password_confirmation" type="password" />
                                <label for="password-confirm">Confirm Password</label>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <!-- <span>Nama Unit</span> -->
                                <input class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" type="text" value="{{ old('no_hp') }}" />
                                <label for="no_hp">No. Telepon</label>

                                @error('no_hp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" type="text">{{ old('alamat') }}</textarea>
                                <label for="no_telp">Alamat</label>

                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-0">
                        <div class="d-grid"><button type="submit" class="btn btn-primary">Simpan</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@stop