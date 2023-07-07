<!-- resources/views/units/show.blade.php -->

@extends('layouts.app')

@section('content')
<!-- resources/views/units/index.blade.php -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Daftar Barang Unit {{ $unit->nama }}</h1>
            <div class="card">
                <div class="card-body">
                    @if ($barang->isEmpty())
                        <p>Tidak ada barang yang tersedia.</p>
                    @else
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Merk</th>
                                    <th>Serial Number</th>
                                    <th>Deskripsi</th>
                                    <!-- Informasi-informasi peminjaman lainnya -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $item)
                                    <tr>
                                        @if ($item->detailbarang)
                                            <a href="{{ route('barang.show', $item->detailbarang->id) }}">
                                                <td>{{ $item->nama_barang }}</td>
                                            </a>
                                        @else
                                                <td>{{ $item->nama_barang }}</td>
                                        @endif
                                        
                                        <td>{{ $item->merk }}</td>
                                        <td>{{ $item->serial_number }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        @if ($item->detailbarang)
                                            <td><a href="{{ route('barang.show', $item->detailbarang->id) }}" class="btn btn-secondary">Detail</a></td>
                                        @endif
                                        <td><a href="{{ route('pinjam.create', ['barang' => $item->id]) }}" class="btn btn-primary">Pinjam</a></td>
                                        <!-- Informasi-informasi peminjaman lainnya -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>


@endsection

