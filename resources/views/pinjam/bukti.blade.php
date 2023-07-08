<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Peminjaman</title>
    <style>
        /* CSS untuk mengatur tampilan bukti peminjaman */
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .content {
            margin-bottom: 20px;
            font-size: 14px;
        }
        .label {
            font-weight: bold;
        }
        .info {
            margin-bottom: 5px;
            font-size: 18px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Bukti Peminjaman</h1>
    </div>
    <div class="content">
        <div class="info">
            <span class="label">Nama Peminjam:</span> {{ $userName }}
        </div>
    </div>

    <div class="content">
        <table width="50%" cellpadding="10">
            @foreach ($peminjamans as $peminjaman)
                @php
                    $index = $loop->iteration;
                @endphp
                <tr>
                    <td>{{ $index }}</td>
                </tr>
                <tr>
                    <td><b>Nama Barang</b></td>
                    <td>: {{ $peminjaman->nama_barang }}</td>
                </tr>
                <tr>
                    <td><b>Nama Unit</b></td>
                    <td>: {{ $peminjaman->nama_unit }}</td>
                </tr>
                <tr>
                    <td><b>Tanggal Reservasi</b></td>
                    <td>: {{ $peminjaman->tgl_reservasi }}</td>
                </tr>
                <tr>
                    <td><b>Tanggal Pinjam</b></td>
                    <td>: {{ $peminjaman->tgl_pinjam }}</td>
                </tr>
                <tr>
                    <td><b>Tanggal Kembali</b></td>
                    <td>: {{ $peminjaman->tgl_kembali }}</td>
                </tr>
                <tr>
                    <td><b>Status Pinjam</b></td>
                    <td>: {{ $peminjaman->status_pinjam }}</td>
                </tr>  
                <tr>
                    <td></td>
                </tr>
            @endforeach
        </table>


    <div class="footer">
        &copy; {{ date('Y') }} Nama Aplikasi Peminjaman Barang
    </div>
</body>
</html>
