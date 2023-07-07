<!-- resources/views/barang/show.blade.php -->




<!-- Tambahkan informasi lainnya tentang barang -->

<!-- resources/views/units/show.blade.php -->

@extends('layouts.app')

@section('content')
<!-- resources/views/units/index.blade.php -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Detail Barang</h1>
            <div class="card">
                <div class="card-body">
                    <p>{{ $detailbarang->detail }}</p>
					<img src="{{ asset('img/' . $detailbarang->gambar) }}" alt="Gambar Barang">
                </div>
                
            </div>
        </div>
    </div>
</div>


@endsection


