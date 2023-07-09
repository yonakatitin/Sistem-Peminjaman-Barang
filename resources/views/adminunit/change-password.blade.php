@extends('layouts.default_adminunit')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">Ganti Password</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/adminunit/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active"><a>Change Password</a></li>
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
                Edit Profile
            </div>
            <div class="card-body">
                <form action="{{ route('adminunit.update-password' )}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="$id_unit">
                    {{ csrf_field() }}
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="col-md-9 mb-3">
                        <div class="form-floating mb-3 mb-md-0">
                            <!-- <span>Nama Unit</span> -->
                            <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput">
                            <label for="oldPasswordInput">Old Password</label>
                            @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-9 mb-3">
                        <div class="form-floating mb-3 mb-md-0">
                            <!-- <span>Nama Unit</span> -->
                            <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput">
                            <label for="newPasswordInput">New Password</label>
                            @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-9 mb-3">
                        <div class="form-floating">
                            <input name="new_password_confirmation" type="password" class="form-control @error('new_password') is-invalid @enderror" id="confirmNewPasswordInput">
                            <label for="confirmNewPasswordInput">Confirm New Password</label>
                            @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4 mb-0">
                        <div class="d-grid justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@stop