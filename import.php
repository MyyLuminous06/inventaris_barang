<!DOCTYPE html>
<html>
<head>
	<title>Import Excel Ke MySQL</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}

	p{
		color: green;
	}
</style>
<h2>IMPORT DATA EXCEL</h2>




<a href="index.php">Kembali</a>
<br/><br/>
<?php 
require 'function.php';
 ?>

<form method="post" enctype="multipart/form-data" action="upload_aksi.php">
	Pilih File: 
	<input name="filepegawai" type="file" required="required"> 
	<input name="upload" type="submit" value="Import">
</form>

<br/><br/>

</body>
</html>