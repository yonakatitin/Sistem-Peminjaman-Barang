@extends('layouts.master')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset("images/bg_3.jpg") }}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Ganti Password <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Ganti Password</h1>
      </div>
    </div>
  </div>
</section>
<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.update-password' )}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="$id_unit">
                        {{ csrf_field() }}
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="card-body">
                            
                                <!-- <span>Nama Unit</span> -->
                                <label for="oldPasswordInput">Old Password</label>
                                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput">
                                
                                @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            
                        </div>
                        <div class="card-body">
                            
                                <!-- <span>Nama Unit</span> -->
                                <label for="newPasswordInput">New Password</label>
                                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput">
                                
                                @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            
                        </div>
                        <div class="card-body">
                            
                                <label for="confirmNewPasswordInput">Confirm New Password</label>
                                <input name="new_password_confirmation" type="password" class="form-control @error('new_password') is-invalid @enderror" id="confirmNewPasswordInput">
                                
                                @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            
                        </div>
                        <div class="card-body">
                            <div class="d-grid justify-content-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop