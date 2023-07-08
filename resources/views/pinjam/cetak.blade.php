<!-- resources/views/peminjaman/cetak.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Bukti Peminjaman</h1>

    <!-- Tampilkan informasi peminjaman yang ingin dicetak -->
    <p>ID Peminjaman: {{ $peminjaman->id }}</p>
    <p>Tanggal Peminjaman: {{ $peminjaman->tanggal_peminjaman }}</p>
    <!-- Informasi-informasi peminjaman lainnya -->

    <!-- Tambahkan elemen lain yang diinginkan pada bukti peminjaman -->

    <!-- Tombol cetak -->
    <button onclick="window.print()">Cetak</button>
@endsection
