<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

<form method="post" action="{{ route('unit.update',[$unit->id]) }}">
	{{ csrf_field }}

	<input type="hidden" name="_method" value="put">

	<label for="unit_nama">Nama</label>
	<input id="unit_nama" name="unit_nama" value="{{ $unit->nama }}">

	<label for="unit_lokasi">Lokasi</label>
	<input id="unit_lokasi" name="unit_lokasi" value="{{ $unit->lokasi }}">
</form>

</body>
</html>