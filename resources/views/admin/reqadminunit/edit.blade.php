@extends('layouts.default_admin')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">Edit User</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/user">User</a></li>
            <li class="breadcrumb-item active">Edit</li>
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
                <i class="fas fa-table me-1"></i>
                Edit User
            </div>
            <div class="card-body">
                <form action="/admin/adminunit/update" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <!-- <span>Nama Unit</span> -->
                                <input class="form-control" id="name" name="name" type="text" value="{{ $user->name }}" />
                                <label for="name">Nama</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <!-- <span>Lokasi Unit</span> -->
                                <input class="form-control" id="email" name="email" type="text" value="{{ $user->email }}" />
                                <label for="email">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <!-- <span>Nama Unit</span> -->
                                <input class="form-control" id="no_hp" name="no_hp" type="text" value="{{ $user->no_hp }}" />
                                <label for="no_hp">No. Telepon</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <select class="form-select" id="id_unit" name="id_unit">
                                    @foreach($unit as $k)
                                    @if($k->id == $user->id_unit)
                                    <option selected value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @else
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <label for="id_unit">Unit</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <textarea class="form-control" id="alamat" name="alamat" type="text">{{ $user->alamat }}</textarea>
                                <label for="no_telp">Alamat</label>
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