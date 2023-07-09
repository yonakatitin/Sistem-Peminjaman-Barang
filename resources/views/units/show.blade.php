<!-- resources/views/units/show.blade.php -->

@extends('layouts.master')

@section('content')
<!-- resources/views/units/index.blade.php -->
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset("images/bg_3.jpg") }}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="{{ route('units.index') }}">Unit <i class="ion-ios-arrow-forward"></i></a></span> <span>Daftar Barang <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Daftar Barang Unit {{ $unit->nama }}</h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        @if ($barang->isEmpty())
            <p>Tidak ada barang yang tersedia.</p>
        @else
        <div class="row">
            @foreach ($barang as $item)
            <div class="col-md-4">
                <div class="car-wrap rounded ftco-animate">
                    <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset("img/" . $item->detailbarang->gambar) }}');">
                    </div>
                    <div class="text">
                        @if ($item->detailbarang)
                            <a href="{{ route('barang.show', $item->detailbarang->id) }}">
                                <h2 class="mb-0">{{ $item->nama_barang }}</h2>
                            </a>
                        @else
                            <h2 class="mb-0">{{ $item->nama_barang }}</h2>
                        @endif
                        <div>
                            <p style="color: gray; font-size: 14px"><span>{{ $item->deskripsi }}</span></p>
                            <p style="color: gray; font-size: 14px"><span>Merk: {{ $item->merk }}</span></p>
                            <p style="color: gray; font-size: 14px"><span>Serial Number: {{ $item->serial_number }}</span></p>
                        </div>
                        @if ($item->detailbarang)
                            <p class="d-flex mb-0 d-block"><a href="{{ route('barang.show', $item->detailbarang->id) }}" class="btn btn-secondary py-2 mr-1">Detail</a>
                        @endif
                        <a href="{{ route('pinjam.create', ['barang' => $item->id]) }}" class="btn btn-primary py-2 mr-1">Pinjam</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>


@endsection

