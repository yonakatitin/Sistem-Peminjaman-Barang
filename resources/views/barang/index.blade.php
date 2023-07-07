<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<table>
        <thead>
            <tr>
                <td>No</td>
                <td>Detail</td>
                <td>Gambar</td>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
            @foreach($detail as $r)
            <tr>
                <td>
                    <?=$i?>
                </td>
                <td>
                    {{ $r->detail }}
                </td>
                <td>
                    {{ $r->gambar }}
                </td>
                <!-- <td><a href="/barang/{{ $r->id }}">Pilih</a></td> -->
                <!-- <td><a href="/unit/hapus/{{ $r->id }}">Delete</a></td> -->
                <?php $i++?>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>