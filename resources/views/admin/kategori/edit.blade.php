@extends('layouts.default_admin')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">Edit Kategori Peminjaman</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/unit">Kategori Peminjaman</a></li>
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
                Edit Kategori Peminjaman
            </div>
            <div class="card-body">
                <form action="{{ route('admin.kategori.update') }}" method="post">
                    {{ csrf_field() }}
                    @foreach($kategori as $r)
                    <input type="hidden" name="id" value="{{ $r->id }}">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <!-- <span>Nama Unit</span> -->
                                <input class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" type="text" value="{{ $r->nama }}" />
                                <label for="nama">Nama Kategori</label>

                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="mt-4 mb-0">
                        <div class="d-grid"><button type="submit" class="btn btn-primary">Simpan</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@stop