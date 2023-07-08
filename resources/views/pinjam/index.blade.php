<!-- resources/views/peminjaman/index.blade.php -->
@extends('layouts.app')

@section('content')
<!-- resources/views/units/index.blade.php -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Daftar Peminjaman</h1>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pinjam.index') }}" method="GET" class="row g-3">
                      <div class="col-auto">
                        <label for="staticEmail2" class="visually-hidden">Email</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Status Peminjaman:">
                      </div>
                      <div class="col-auto">
                        <label for="inputPassword2" class="visually-hidden">Password</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">All</option>
                            <option value="requested">Requested</option>
                            <option value="approved">Approved</option>
                            <option value="borrowed">Borrowed</option>
                            <option value="returned">Returned</option>
                        </select>
                      </div>
                      <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Filter</button>
                      </div>
                    </form>
                    <table width="100%" cellpadding="10">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Unit</th>
                                <th>Tanggal Reservasi</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <!-- Informasi-informasi peminjaman lainnya -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $peminjaman)
                                <tr>
                                    <td>{{ $peminjaman->nama_barang }}</td>
                                    <td>{{ $peminjaman->nama_unit }}</td>
                                    <td>{{ $peminjaman->tgl_reservasi }}</td>
                                    <td>{{ $peminjaman->tgl_pinjam }}</td>
                                    <td>{{ $peminjaman->tgl_kembali }}</td>
                                    <td>{{ $peminjaman->status_pinjam }}</td>
                                    <td>
                                        <input type="checkbox" name="selected_peminjaman[]" value="{{ $peminjaman->id }}">
                                    </td>
                                    
                                    <!-- Informasi-informasi peminjaman lainnya -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form id="print-form" action="{{ route('pinjam.print') }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="selected_peminjaman" id="selected_peminjaman_input">
                    </form>

                    <button type="button" id="print-button" class="btn btn-primary">Cetak Bukti</button>
                </div>
            </div>
        </div>
    </div>
</div>

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
