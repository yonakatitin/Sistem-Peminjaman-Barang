<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
 
	<a href="/unit"> Kembali</a>
	
	<br/>
	<br/>
 
	<form action="/unit/store" method="post">
		{{ csrf_field() }}
		Nama <input type="text" name="nama" required="required"> <br/>
		Lokasi <input type="text" name="lokasi" required="required"> <br/>
		<input type="submit" value="Simpan Data">
	</form>
 
</body>
</html>