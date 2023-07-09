@extends('layouts.default_adminunit')

@section('content')
<main>
<div class="container-fluid px-4">
    <h2 class="mt-4">Tambah Barang</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/adminunit/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/adminunit/barang">Barang</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
    <!-- <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>
                        </div> -->
    <div class="card mb-4">
        <div class="card-header">
            <!-- <i class="fas fa-table me-1"></i> -->
            Tambah Barang
        </div>
        <div class="card-body">
            <form action="{{ route('adminunit.barang.store') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" value="$id_unit">
                {{ csrf_field() }}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <!-- <span>Nama Unit</span> -->
                            <input class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" type="text" value="{{ old('nama_barang') }}" />
                            <label for="nama_barang">Nama Barang</label>

                            @error('nama_barang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <!-- <span>Lokasi Unit</span> -->
                            <input class="form-control @error('merk') is-invalid @enderror" id="merk" name="merk" type="text" value="{{ old('merk') }}" />
                            <label for="merk">Merek</label>

                            @error('merk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <!-- <span>Nama Unit</span> -->
                            <input class="form-control @error('serial_number') is-invalid @enderror" id="serial_number" name="serial_number" type="text" value="{{ old('serial_number') }}" />
                            <label for="serial_number">Serial Number</label>

                            @error('serial_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori">
                                @foreach($kategori as $k)
                                @if(old('kategori' && old('kategori') == $k->id))
                                <option selected value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endif
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>
                            <label for="kategori">Kategori</label>

                            @error('kategori')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <!-- <span>Lokasi Unit</span> -->
                            <textarea style="height: 7rem;" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" type="text">{{ old('deskripsi') }}</textarea>
                            <label for="deskripsi">Deskripsi</label>

                            @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <!-- <span>Lokasi Unit</span> -->
                            <textarea style="height: 7rem;" class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail" type="text">{{ old('detail') }}</textarea>
                            <label for="detail">Detail</label>

                            @error('detail')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <!-- <span>Nama Unit</span> -->
                            <select class="form-select @error('status_barang') is-invalid @enderror" id="status_barang" name="status_barang">
                                @if(old('status_barang') && old('status_barang') == 1)
                                <option selected value="1">Available</option>
                                <option value="2">In Use</option>
                                <option value="3">Broken</option>
                                @elseif(old('status_barang') && old('status_barang') == 2)
                                <option value="1">Available</option>
                                <option selected value="2">In Use</option>
                                <option value="3">Broken</option>
                                @elseif(old('status_barang') && old('status_barang') == 3)
                                <option value="1">Available</option>
                                <option value="2">In Use</option>
                                <option selected value="3">Broken</option>
                                @else
                                <option value="1">Available</option>
                                <option value="2">In Use</option>
                                <option value="3">Broken</option>
                                @endif
                            </select>
                            <label for="status_barang">Status Barang</label>

                            @error('status_barang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <!-- <span>Lokasi Unit</span> -->
                            <input class="form-control" id="gambar" name="gambar" type="file" id=formFile></textarea>
                            <label for="gambar">Gambar</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="d-grid"><button type="submit" class="btn btn-primary">Simpan</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
</main>
@stop