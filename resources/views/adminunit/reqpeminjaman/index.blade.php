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
        <h2 class="mt-4">Daftar Permintaan Peminjaman</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/adminunit/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Permintaan Peminjaman</li>
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
                Tabel Daftar Permintaan Peminjaman
            </div>
            <div class="card-body">
                <!-- <div style="overflow-x: auto;" style="display: flex;"> -->
                <table id="datatablesSimple">
                    <div class="datatable-top d-flex justify-content-end">
                        <a href="{{ route('adminunit.reqpeminjaman.create') }}" class="btn btn-success btn-kategori" style="white-space: nowrap;">Tambah Permintaan</a>
                    </div>
                    <thead>
                        <tr>
                            <th>No</th>
                            <!-- <th class="col-sm-4">Gambar</th> -->
                            <th>Nama Pengguna</th>
                            <th>Nama Barang</th>
                            <th>Tgl Reservasi</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status Pinjam</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <!-- <th>Gambar</th> -->
                            <th>Nama Pengguna</th>
                            <th>Nama Barang</th>
                            <th>Tgl Reservasi</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status Pinjam</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($reqpeminjaman as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $r->name }}</td>
                            <td>{{ $r->nama_barang }}</td>
                            <td>{{ $r->tgl_reservasi }}</td>
                            <td>{{ $r->tgl_pinjam }}</td>
                            <td>{{ $r->tgl_kembali }}</td>
                            <td>{{ $r->status_pinjam }}</td>
                            @if($r->status_pinjam == 'declined')
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#approve-{{ $r->id }}" disabled aria-disabled="true">Terima</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#decline-{{ $r->id }}" disabled aria-disabled="true">Tolak</button>
                            </td>
                            @elseif($r->status_pinjam == 'requested')
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#approve-{{ $r->id }}">Terima</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#decline-{{ $r->id }}">Tolak</button>
                            </td>
                            @endif
                            <!-- <td>
                                <a href="/adminunit/{{ $unit_id }}/barang/edit/{{ $r->id }}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <a href="/adminunit/{{ $unit_id }}/barang/hapus/{{ $r->id }}" class="btn btn-danger">Delete</a>
                            </td> -->
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="approve-{{ $r->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content d-flex">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Terima Request Peminjaman</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- <div class="row mb-3">
                                            @if($r->gambar == NULL)
                                            <img src="/assets/barang/default.png" id="foto">
                                            @else
                                            <img src="/storage/{{ $r->gambar }}" id="foto">
                                            @endif
                                        </div> -->
                                        <div class="row mt-1 mb-1"><span>
                                                <h6><b>Informasi Pengguna</b></h6>
                                            </span></div>
                                        <hr class="mt-0">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <!-- <span>Nama Unit</span> -->
                                                    <input class="form-control" id="nama" name="nama" type="text" value="{{ $r->name }}" disabled aria-label="disabled" />
                                                    <label for="nama">Nama Pengguna</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <!-- <span>Lokasi Unit</span> -->
                                                    <input class="form-control" id="merk" name="lokasi" type="text" value="{{ $r->email }}" disabled aria-label="disabled" />
                                                    <label for="merk">Email Pengguna</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <!-- <span>Nama Unit</span> -->
                                                    <input class="form-control" id="serial_number" name="nama" type="text" value="{{ $r->no_hp }}" disabled aria-label="disabled" />
                                                    <label for="serial_number">No HP Pengguna</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mb-1"><span>
                                                <h6><b>Informasi Barang</b></h6>
                                            </span></div>
                                        <hr class="mt-0">
                                        <div class="row mb-3">
                                            @if($r->gambar == NULL)
                                            <img src="/assets/barang/default.png" id="foto">
                                            @else
                                            <img src="/storage/{{ $r->gambar }}" id="foto">
                                            @endif
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <!-- <span>Lokasi Unit</span> -->
                                                    <input class="form-control" id="nama" name="nama" type="text" value="{{ $r->nama_barang }}" disabled aria-label="disabled" />
                                                    <label for="nama">Nama Barang</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <!-- <span>Lokasi Unit</span> -->
                                                    <input class="form-control" id="nama" name="nama" type="text" value="{{ $r->merk }}" disabled aria-label="disabled" />
                                                    <label for="nama">Merk</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <!-- <span>Lokasi Unit</span> -->
                                                    <input class="form-control" id="nama" name="nama" type="text" value="{{ $r->serial_number }}" disabled aria-label="disabled" />
                                                    <label for="nama">Serial Number</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('adminunit.reqpeminjaman.approve', ['id_reqpeminjaman' => $r->id]) }}"><button type="button" class="btn btn-primary">Terima</button></a>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="decline-{{ $r->id }}" tabindex="-1" aria-labelledby="exampleDeclineLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content d-flex">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tolak Request Peminjaman</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- <div class="row mb-3">
                                            @if($r->gambar == NULL)
                                            <img src="/assets/barang/default.png" id="foto">
                                            @else
                                            <img src="/storage/{{ $r->gambar }}" id="foto">
                                            @endif
                                        </div> -->
                                        <div class="row mt-1 mb-1"><span>
                                                <h6><b>Informasi Pengguna</b></h6>
                                            </span></div>
                                        <hr class="mt-0">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <!-- <span>Nama Unit</span> -->
                                                    <input class="form-control" id="nama" name="nama" type="text" value="{{ $r->name }}" disabled aria-label="disabled" />
                                                    <label for="nama">Nama Pengguna</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <!-- <span>Lokasi Unit</span> -->
                                                    <input class="form-control" id="merk" name="lokasi" type="text" value="{{ $r->email }}" disabled aria-label="disabled" />
                                                    <label for="merk">Email Pengguna</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <!-- <span>Nama Unit</span> -->
                                                    <input class="form-control" id="serial_number" name="nama" type="text" value="{{ $r->no_hp }}" disabled aria-label="disabled" />
                                                    <label for="serial_number">No HP Pengguna</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mb-1"><span>
                                                <h6><b>Informasi Barang</b></h6>
                                            </span></div>
                                        <hr class="mt-0">
                                        <div class="row mb-3">
                                            @if($r->gambar == NULL)
                                            <img src="/assets/barang/default.png" id="foto">
                                            @else
                                            <img src="/storage/{{ $r->gambar }}" id="foto">
                                            @endif
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <!-- <span>Lokasi Unit</span> -->
                                                    <input class="form-control" id="nama" name="nama" type="text" value="{{ $r->nama_barang }}" disabled aria-label="disabled" />
                                                    <label for="nama">Nama Barang</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <!-- <span>Lokasi Unit</span> -->
                                                    <input class="form-control" id="nama" name="nama" type="text" value="{{ $r->merk }}" disabled aria-label="disabled" />
                                                    <label for="nama">Merk</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <!-- <span>Lokasi Unit</span> -->
                                                    <input class="form-control" id="nama" name="nama" type="text" value="{{ $r->serial_number }}" disabled aria-label="disabled" />
                                                    <label for="nama">Serial Number</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('adminunit.reqpeminjaman.decline', ['id_reqpeminjaman' => $r->id]) }}"><button type="button" class="btn btn-danger">Tolak</button></a>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batalkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            @endforeach
            </tbody>
            </table>
            <!-- </div> -->
        </div>
    </div>
</main>
@stop