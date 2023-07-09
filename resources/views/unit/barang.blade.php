<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<table border="1">
        <thead>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Merk</td>
                <td>Serial Number</td>
                <td>Deskripsi</td>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
            @foreach($barang as $b)
            <tr>
                <td>
                    <?=$i?>
                </td>
                <td>
                    {{ $b->nama_barang }}
                </td>
                <td>
                    {{ $b->merk }}
                </td>
                <td>
                    {{ $b->serial_number }}
                </td>
                <td>
                    {{ $b->deskripsi }}
                </td>
                <td><a href="{{ route('barang.show', $b->id) }}">Pilih</a></td>
                <!-- <td><a href="/unit/hapus/{{ $b->id }}">Delete</a></td> -->
                <?php $i++?>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>