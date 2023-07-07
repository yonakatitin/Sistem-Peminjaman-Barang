<!-- resources/views/profile/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Edit Profil</h1>
            <div class="card">
                <div class="card-body">
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

                        <div class="card-body"><button type="submit" class="btn btn-primary">Submit</button></div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
