<!-- resources/views/peminjaman/index.blade.php -->
@extends('layouts.master')

@section('content')
<!-- resources/views/units/index.blade.php -->
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Data Peminjaman <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Data Peminjaman</h1>
      </div>
    </div>
  </div>
</section>


<section class="ftco-section bg-light">
    <div class="container">
        <div class="container">
            <div class="col-md-4">
                <div class="row no-gutters">
                    <div class="">
                        <div class="row no-gutters">
                            <div class="d-flex align-items-center">
                                <form action="{{ route('pinjam.index') }}" method="GET" class="request-form ftco-animate bg-primary row g-3">
                                    @csrf
                                    <div class="col-auto">
                                        <label for="nama_barang" class="label">Status Peminjaman</label>
                                        <select name="status" id="status" class="form-control" style="color: black;">
                                            <option value="" style="color: black;">All</option>
                                            <option value="requested" style="color: black;">Requested</option>
                                            <option value="approved" style="color: black;">Approved</option>
                                            <option value="borrowed" style="color: black;">Borrowed</option>
                                            <option value="returned" style="color: black;">Returned</option>
                                        </select>
                                    </div>
                                    <div class="col-auto" style="margin-top: 10px;">
                                      <input type="submit" value="Filter" class="btn btn-secondary py-3 px-4">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-bottom: 20px;"></div>
        @if ($peminjamans->isEmpty())
            <p>Anda belum memiliki peminjaman.</p>
        @else
        <div class="row">
            @foreach ($peminjamans as $peminjaman)
            <div class="col-md-4">
                <div class="car-wrap rounded ftco-animate">
                    <div class="text">
                        <div class="d-flex mb-3">
                            <h2 class="mb-0"><a href="car-single.html">{{ $peminjaman->nama_barang }}</a><span></span></h2>
                            <p class="price ml-auto"> <span><input type="checkbox" name="selected_peminjaman[]" value="{{ $peminjaman->id }}"></span></p>
                        </div>
                        <div class="d-flex">
                            <p style="color: gray; font-size: 14px"><span>{{ $peminjaman->nama_unit }}</span></p>
                            <p class="price ml-auto">{{ $peminjaman->status_pinjam }}</p>
                        </div>
                        <div>
                            <p style="color: gray; font-size: 14px"><span>Tanggal Pinjam: {{ $peminjaman->tgl_pinjam }}</span></p>
                            <p style="color: gray; font-size: 14px"><span>Tanggal Kembali: {{ $peminjaman->tgl_kembali }}</span></p>
                            <p class="price ml-auto" style="color: gray; font-size: 14px"><span>{{ $peminjaman->tgl_reservasi }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif 
        <form id="print-form" action="{{ route('pinjam.print') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="selected_peminjaman" id="selected_peminjaman_input">
        </form>

        <button type="button" id="print-button" class="btn btn-primary">Cetak Bukti Peminjaman</button>
    </div>
</section>

<script>
    document.getElementById('print-button').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('input[name="selected_peminjaman[]"]:checked');
        var selectedPeminjaman = Array.from(checkboxes).map(function(checkbox) {
            return checkbox.value;
        });
        document.getElementById('selected_peminjaman_input').value = selectedPeminjaman.join(',');
        document.getElementById('print-form').submit();
    });
</script>
@endsection
