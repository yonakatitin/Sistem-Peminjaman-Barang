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
        <table width="100%" cellpadding="10">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Serial Number</th>
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
                    @php
                        $index = $loop->iteration;
                    @endphp
                    <tr>
                        <td>{{ $index }}</td>
                        <td>{{ $peminjaman->nama_barang }}</td>
                        <td>{{ $peminjaman->serial_number }}</td>
                        <td>{{ $peminjaman->nama_unit }}</td>
                        <td>{{ $peminjaman->tgl_reservasi }}</td>
                        <td>{{ $peminjaman->tgl_pinjam }}</td>
                        <td>{{ $peminjaman->tgl_kembali }}</td>
                        <td>{{ $peminjaman->status_pinjam }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <div class="footer">
        &copy; {{ date('Y') }} Pinjam Barang UNS
    </div>
</body>
</html>
