<!-- resources/views/peminjaman/index.blade.php -->
@extends('layouts.app')

@section('content')
<!-- resources/views/units/index.blade.php -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Daftar Peminjaman</h1>
            <div class="card">
                <div class="card-body">
                    <table width="100%">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Unit</th>
                                <th>Tanggal Reservasi</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <!-- Informasi-informasi peminjaman lainnya -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $peminjaman)
                                <tr>
                                    <td>{{ $peminjaman->nama_barang }}</td>
                                    <td>{{ $peminjaman->nama_unit }}</td>
                                    <td>{{ $peminjaman->tgl_reservasi }}</td>
                                    <td>{{ $peminjaman->tgl_pinjam }}</td>
                                    <td>{{ $peminjaman->tgl_kembali }}</td>
                                    <td>{{ $peminjaman->status_pinjam }}</td>
                                    
                                    <!-- Informasi-informasi peminjaman lainnya -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>


@endsection
