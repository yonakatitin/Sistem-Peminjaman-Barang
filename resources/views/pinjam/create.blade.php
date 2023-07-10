<!-- resources/views/peminjaman/create.blade.php -->

@extends('layouts.master')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset("images/bg_3.jpg") }}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Form Peminjaman <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Form Peminjaman</h1>
      </div>
    </div>
  </div>
</section>
<section class="ftco-section ftco-no-pt bg-light">
    <div class="container">
        <div class="row no-gutters">
            <div class="featured-top">
                <div class="row no-gutters">
                    <div class="d-flex align-items-center">
                        <form action="{{ route('pinjam.store') }}" method="POST" class="request-form ftco-animate bg-primary">
                            @csrf
                            <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                            <h2 style="font-size: 48px;"><i>Form Peminjaman</i></h2>
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <div style="margin: 20px;"></div>
                            <table cellpadding="5" style="color: white; font-size: 18px;">
                                <tr>
                                    <th>Nama Barang</th>
                                    <td>: {{ $barang->nama_barang }}</td>
                                </tr>
                                <tr>
                                    <th>Serial Number</th>
                                    <td>: {{ $barang->serial_number }}</td>
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
                            <div class="form-group">
                                
                            </div>
                            <div class="d-flex">
                                <div class="form-group mr-2">
                                    <label for="" class="label" style="font-size: 18px;">Tanggal Pinjam</label>
                                    <input type="date" name="tgl_pinjam" class="form-control" style="font-size: 18px;" placeholder="Date">
                                </div>
                                <div class="form-group ml-2">
                                    <label for="" class="label" style="font-size: 18px;">Tanggal Kembali</label>
                                    <input type="date" name="tgl_kembali" class="form-control" style="font-size: 18px;" placeholder="Date">
                                </div>
                            </div>
                            <div class="form-group">
                              <input type="submit" value="Pinjam" class="btn btn-secondary py-3 px-4" style="font-size: 18px;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
