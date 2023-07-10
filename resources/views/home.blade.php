@extends('layouts.master')

@section('content')
<div class="hero-wrap ftco-degree-bg" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
      <div class="col-lg-8 ftco-animate">
        <div class="text w-100 text-center mb-md-5 pb-md-5">
          <h1 class="mb-4">Pinjam Barang Cepat &amp; Mudah</h1>
          <p style="font-size: 18px;">Web Pinjam Barang merupakan sebuah sistem yang memfasilitasi peminjaman barang bagi civitas akademika UNS.</p>
          <a href="https://vimeo.com/45830194" class="icon-wrap popup-vimeo d-flex align-items-center mt-4 justify-content-center">
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="ftco-section ftco-no-pt bg-light">
    <div class="container">
        <div class="row no-gutters">
            <div class="featured-top">
                <div class="row no-gutters">
                    <div class="d-flex align-items-center">
                        <form action="{{ route('search') }}" method="POST" class="request-form ftco-animate bg-primary">
                            @csrf
                            <h2>Cari Barang</h2>
                            <div class="form-group">
                                <label for="nama_barang" class="label">Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="LCD, Monitor, Router, etc">
                            </div>
                            <div class="d-flex">
                                <div class="form-group mr-2">
                                    <label for="" class="label">Tanggal Pinjam</label>
                                    <input type="date" name="tgl_pinjam" class="form-control"  placeholder="Date">
                                </div>
                                <div class="form-group ml-2">
                                    <label for="" class="label">Tanggal Kembali</label>
                                    <input type="date" name="tgl_kembali" class="form-control"  placeholder="Date">
                                </div>
                            </div>
                            <div class="form-group">
                              <input type="submit" value="Cari Barang" class="btn btn-secondary py-3 px-4">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="ftco-section ftco-no-pt bg-light">
    <div class="container">
        @if (isset($barangs) && $barangs->count() > 0)
        <div class="row">
            @foreach ($barangs as $item)
            <div class="col-md-4">
                <div class="car-wrap rounded ftco-animate">
                    @if($item->detailbarang && $item->detailbarang->gambar)
                    <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset("storage/" . $item->detailbarang->gambar) }}');">

                    @else
                    <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset("assets/barang/default.png") }}');">

                    @endif
                    
                    </div>
                    <div class="text">
                        @if ($item->detailbarang)
                            <a href="{{ route('barang.show', $item->detailbarang->id) }}">
                                <h2 class="mb-0"><a href="car-single.html">{{ $item->nama_barang }}</a></h2>
                            </a>
                        @else
                        <a role="link">
                                <h2 class="mb-0"><a href="car-single.html">{{ $item->nama_barang }}</a></h2>
                            </a>
                        @endif
                        <div class="d-flex">
                            <p style="color: gray; font-size: 14px;"><span>{{ $item->deskripsi }}</span></p>
                            <p class="price ml-auto">{{ $item->unit->nama }}</p>
                        </div>
                        <div>
                            <p style="color: gray; font-size: 14px;"><span>Merk: {{ $item->merk }}</span></p>
                            <p style="color: gray; font-size: 14px;"><span>Serial Number: {{ $item->serial_number }}</span></p>
                        </div>
                        @if ($item->detailbarang)
                            <p class="d-flex mb-0 d-block"><a href="{{ route('barang.show', $item->detailbarang->id) }}" class="btn btn-secondary py-2 mr-1">Detail</a>
                        @else
                            <p class="d-flex mb-0 d-block"><a role="link" aria-disabled="true" disabled class="btn btn-secondary py-2 mr-1">Detail</a>
                        @endif
                        <a href="{{ route('pinjam.create', ['barang' => $item->id]) }}" class="btn btn-primary py-2 mr-1">Pinjam</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <p>No results found.</p>
        @endif 
    </div>
</section>



@endsection
