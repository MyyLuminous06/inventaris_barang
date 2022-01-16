<?php 
// menghubungkan dengan koneksi
include 'function.php';
// menghubungkan dengan library excel reader
include "excel_reader2.php";
?>

<?php
// upload file xls
$target = basename($_FILES['filepegawai']['name']) ;
move_uploaded_file($_FILES['filepegawai']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['filepegawai']['name'],0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filepegawai']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

// var_dump($data);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$kode     = $data->val($i, 1);
	$namabarang   = $data->val($i, 2);
	$lokasi  = $data->val($i, 3);
	$deskripsi  = $data->val($i, 4);
	$stock  = $data->val($i, 5);

	if($kode != "" && $namabarang != "" && $lokasi != "" && $deskripsi != "" && $stock != ""){
		// input data ke database (table stock)
		mysqli_query($conn,"INSERT into stock values('','$kode','$namabarang','$lokasi', '$deskripsi', '$stock')");
		$berhasil++;
	}
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filepegawai']['name']);

// alihkan halaman ke index.php
header("location:index.php?berhasil=$berhasil");
?>