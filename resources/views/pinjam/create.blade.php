<!-- resources/views/peminjaman/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Form Peminjaman</h1>
            <div class="card">
                <div class="card-body">
                    <table cellpadding="10">
                        <tr>
                            <th>Nama Barang</th>
                            <td>: {{ $barang->nama_barang }}</td>
                        </tr>
                        <tr>
                            <th>Merk</th>
                            <td>: {{ $barang->merk }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi Unit</th>
                            <td>: {{ $barang->unit->nama }} ({{ $barang->unit->lokasi }})</td>
                        </tr>
                    </table>
                    <form action="{{ route('pinjam.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="barang_id" value="{{ $barang->id }}">

                        <div class="card-body">
                            <label for="tgl_pinjam"><b>Tanggal Pinjam</b></label>
                            <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" required>
                        </div>

                        <div class="card-body">
                            <label for="tgl_kembali"><b>Tanggal Kembali</b></label>
                            <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" required>
                        </div>

                        <div class="card-body"><button type="submit" class="btn btn-primary">Submit</button></div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
