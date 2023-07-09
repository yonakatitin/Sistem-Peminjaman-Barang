<!-- resources/views/barang/show.blade.php -->




<!-- Tambahkan informasi lainnya tentang barang -->

<!-- resources/views/units/show.blade.php -->

@extends('layouts.master')

@section('content')
<!-- resources/views/units/index.blade.php -->
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset("images/bg_3.jpg") }}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="{{ route('units.index') }}">Unit <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2">Daftar Barang <i class="ion-ios-arrow-forward"></i></span> <span>Detail Barang <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Detail Barang</h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-car-details">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="car-details">
                    <div class="img rounded" style="background-image: url('{{ asset("img/" . $detailbarang->gambar) }}');"></div>
                    <div class="text text-center">
                        <h2>{{ $detailbarang->barang->nama_barang }}</h2>
                        <span class="subheading">{{ $detailbarang->barang->merk }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pills">
                <div class="bd-example bd-example-tabs">
                    <div class="d-flex justify-content-center">
                      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Description</a>
                        </li>
                      </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
                        <p>{{ $detailbarang->detail }}</p>
                    </div>
                </div>
            </div>
        </div>
      </div>
</section>


@endsection


