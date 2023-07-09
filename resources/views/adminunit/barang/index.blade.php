@extends('layouts.default_adminunit')

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
        <h2 class="mt-4">Barang</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="adminunit/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Barang</li>
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
                Tabel Daftar Barang
            </div>
            <div class="card-body">
                <!-- <div style="overflow-x: auto;" style="display: flex;"> -->
                <table id="datatablesSimple">
                    <div class="datatable-top d-flex justify-content-end">
                        <a href="barang/create" class="btn btn-success">Tambah Barang</a>
                    </div>
                    <thead>
                        <tr>
                            <th>No</th>
                            <!-- <th class="col-sm-4">Gambar</th> -->
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <!-- <th>Serial Number</th>
                                            <th class="col-sm-4">Deskripsi</th>
                                            <th class="col-sm-4">Detail</th> -->
                            <th>Status Barang</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <!-- <th>Gambar</th> -->
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <!-- <th>Serial Number</th>
                                            <th>Deskripsi</th>
                                            <th>Detail</th> -->
                            <th>Status Barang</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($barang as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <!-- <td>{{ $r->gambar }}</td> -->
                            <td>{{ $r->nama_barang }}</td>
                            <td>{{ $r->nama }}</td>
                            <!-- <td>{{ $r->serial_number }}</td>
                                            <td>{{ $r->deskripsi }}</td>
                                            <td>{{ $r->detail }}</td> -->
                            <td>{{ $r->status_barang }}</td>
                            <td id="details">
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modal-{{ $r->id }}">Detail</button>
                            </td>
                            <td>
                                <a href="{{ route('adminunit.barang.edit', ['id_barang' => $r->id]) }}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <a href="/adminunit/barang/hapus/{{ $r->id }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="modal-{{ $r->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            @if($r->gambar == NULL)
                                            <img src="/assets/barang/default.png" id="foto">
                                            @else
                                            <img src="/storage/{{ $r->gambar }}" id="foto">
                                            @endif
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <!-- <span>Nama Unit</span> -->
                                                    <input class="form-control" id="nama" name="nama" type="text" value="{{ $r->nama_barang }}" disabled aria-label="disabled" />
                                                    <label for="nama">Nama Barang</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <!-- <span>Lokasi Unit</span> -->
                                                    <input class="form-control" id="merk" name="lokasi" type="text" value="{{ $r->merk }}" disabled aria-label="disabled" />
                                                    <label for="merk">Merek</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <!-- <span>Nama Unit</span> -->
                                                    <input class="form-control" id="serial_number" name="nama" type="text" value="{{ $r->serial_number }}" disabled aria-label="disabled" />
                                                    <label for="serial_number">Serial Number</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="kategori" name="kategori" value="{{ $r->nama }}" disabled aria-label="disabled">
                                                    <label for="kategori">Kategori</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <!-- <span>Lokasi Unit</span> -->
                                                    <textarea style="height: 7rem;" class="form-control" id="deskripsi" name="lokasi" type="text" disabled aria-label="disabled">{{ $r->deskripsi }}</textarea>
                                                    <label for="deskripsi">Deskripsi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <!-- <span>Lokasi Unit</span> -->
                                                    <textarea style="height: 7rem;" class="form-control" id="detail" name="lokasi" type="text" disabled aria-label="disabled">{{ $r->detail }}</textarea>
                                                    <label for="detail">Detail</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <!-- <span>Nama Unit</span> -->
                                                    <input class="form-control" id="status_barang" name="status_barang" value="{{ $r->status_barang }}" disabled aria-label="disabled">
                                                    <label for="status_barang">Status Barang</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary mb-4" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                @endforeach
                    </tbody>
                </table>
                <!-- </div> -->
            </div>
        </div>
    </div>
</main>
@stop