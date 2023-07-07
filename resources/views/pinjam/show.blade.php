<!-- resources/views/pinjam/show.blade.php -->

<h1>Detail Peminjaman</h1>

<p>ID Peminjaman: {{ $peminjaman->id }}</p>
<p>Tanggal Peminjaman: {{ $peminjaman->tgl_pinjam }}</p>
<!-- Tambahkan informasi lainnya tentang peminjaman -->
<a href="{{ route('pinjam.index') }}" class="btn btn-primary">Kembali ke Daftar Peminjaman</a>
