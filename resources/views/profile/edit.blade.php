<!-- resources/views/profile/edit.blade.php -->

@extends('layouts.master')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset("images/bg_3.jpg") }}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Edit Profil <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Edit Profil</h1>
      </div>
    </div>
  </div>
</section>
<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                        </div>

                        <div class="card-body">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
                        </div>

                        <div class="card-body">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" value="{{ $user->alamat }}" class="form-control">
                        </div>

                        <div class="card-body">
                            <label for="no_hp">Phone</label>
                            <input type="text" name="no_hp" id="no_hp" value="{{ $user->no_hp }}" class="form-control">
                        </div>

                        <div class="card-body"><button type="submit" class="btn btn-primary">Change</button></div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
