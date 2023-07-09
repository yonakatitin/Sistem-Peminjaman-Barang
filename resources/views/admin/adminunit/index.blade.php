@extends('layouts.default_admin')

@section('content')
<main>
    <!-- <script type="text/javascript">
        var app = new Vue({
            el : '#details',
            data :{
                barang : null
            }
        });
    </script> -->
    <div class="container-fluid px-4">
        <h2 class="mt-4">Admin Unit</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Admin Unit</li>
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
                Tabel Admin Unit
            </div>
            <div class="card-body">
                <!-- <div style="overflow-x: auto;" style="display: flex;"> -->
                <table id="datatablesSimple">
                    <div class="datatable-top d-flex justify-content-end">
                    <a href="{{ route('admin.adminunit.create') }}" class="btn btn-success btn-kategori">Tambah Akun</a>
                    </div>
                    <thead>
                        <tr>
                            <th>No</th>
                            <!-- <th class="col-sm-4">Gambar</th> -->
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <!-- <th>Gambar</th> -->
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($users as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $r->name }}</td>
                            <td>{{ $r->email }}</td>
                            <td>{{ $r->no_hp }}</td>
                            <td id="details">
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modal-{{ $r->id }}">Detail</button>
                            </td>
                            <td>
                                <a href="{{ route('admin.adminunit.edit', ['id' => $r->id]) }}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.adminunit.hapus', ['id' => $r->id]) }}" class="btn btn-danger">Delete</a>
                            </td>
                            <!-- Modal -->
                        <div class="modal fade" id="modal-{{ $r->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Admin Unit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <!-- <span>Nama Unit</span> -->
                                                    <input class="form-control" id="nama" name="nama" type="text" value="{{ $r->name }}" disabled aria-label="disabled" />
                                                    <label for="nama">Nama</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <!-- <span>Lokasi Unit</span> -->
                                                    <input class="form-control" id="merk" name="lokasi" type="text" value="{{ $r->email }}" disabled aria-label="disabled" />
                                                    <label for="merk">Email</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <!-- <span>Nama Unit</span> -->
                                                    <input class="form-control" id="serial_number" name="nama" type="text" value="{{ $r->no_hp }}" disabled aria-label="disabled" />
                                                    <label for="serial_number">No. Telepon</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="kategori" name="kategori" value="{{ $r->nama }}" disabled aria-label="disabled">
                                                    <label for="kategori">Nama Unit</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <!-- <span>Lokasi Unit</span> -->
                                                    <textarea style="height: 7rem;" class="form-control" id="deskripsi" name="lokasi" type="text" disabled aria-label="disabled">{{ $r->alamat }}</textarea>
                                                    <label for="deskripsi">Alamat</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- </div> -->
            </div>
        </div>
    </div>
</main>
@stop