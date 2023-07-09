@extends('layouts.master')

@section('content')
<!-- resources/views/units/index.blade.php -->

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Unit <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Unit</h1>
      </div>
    </div>
  </div>
</section>
<section class="ftco-section">
    <div class="container">
        @if ($units->isEmpty())
            <p>Tidak ada unit yang tersedia.</p>
        @else
            <div class="row">
                @foreach ($units as $unit)
                    <div class="col-md-3">
                        <a href="{{ route('units.show', $unit->id) }}" style="text-decoration: none; color: inherit;">
                          <div class="services services-2 w-100 text-center">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                            <div class="text w-100">
                                    <h3 class="heading mb-2">{{ $unit->nama }}</h3>
                                <p>{{ $unit->lokasi }}</p>
                            </div>
                          </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection

