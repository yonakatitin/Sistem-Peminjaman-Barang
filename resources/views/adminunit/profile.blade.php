@extends('layouts.default_adminunit')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">User Profile</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/adminunit/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active"><a>Profile</a></li>
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
                Profile
            </div>
            <div class="card-body">
                <!-- <form action=""> -->
                <input type="hidden" value="$id_unit">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <!-- <span>Nama Unit</span> -->
                            <input class="form-control" id="name" name="name" type="text" value="{{ $user->name }}" disabled aria-disabled="true" />
                            <label for="name">Nama</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <!-- <span>Lokasi Unit</span> -->
                            <input class="form-control" id="email" name="email" type="text" value="{{ $user->email }}" disabled aria-disabled="true" />
                            <label for="email">Email</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <!-- <span>Nama Unit</span> -->
                            <input class="form-control" id="no_hp" name="no_hp" type="text" value="{{ $user->no_hp }}" disabled aria-disabled="true" />
                            <label for="no_hp">No. Telepon</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <textarea class="form-control" id="alamat" name="alamat" type="text" disabled aria-disabled="true">{{ $user->alamat }}</textarea>
                            <label for="no_telp">Alamat</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-0">
                    <div class="d-grid justify-content-end">
                        <a href="{{ route('adminunit.profile.edit') }}"><button type="submit" class="btn btn-primary">Edit Profile</button></a>
                    </div>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</main>
@stop