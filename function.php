<?php 
session_start();

// konek database
$conn = mysqli_connect("localhost","root","","inventaris_barang");


// tambah barang
if (isset($_POST['addnewbarang'])) {
	$kode = $_POST['kode'];
	$namabarang = $_POST['namabarang'];
	$lokasi = $_POST['lokasi'];
	$deskripsi = $_POST['deskripsi'];
	$stock = $_POST['stock'];

	$addtotable = mysqli_query($conn,"insert into stock (kode, namabarang, lokasi, deskripsi, stock) values('$kode', '$namabarang', '$lokasi', '$deskripsi', '$stock')");
	if (addtotable) {
		header('location:index.php');
	}else{
		echo "gagal";
		header('location:index.php');
	}

}

// menambahkan barang masuk
if (isset($_POST['barangmasuk'])) {
	$barangnya = $_POST['barangnya'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);

	$stocksekarang = $ambildatanya['stock'];
	$tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

	$addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty) values('$barangnya', '$penerima', $qty)");
	$updatestockmasuk = mysqli_query($conn, "update stock set stock= '$tambahkanstocksekarangdenganquantity' where idbarang= '$barangnya' ");

	if ($addtomasuk&&$updatestockmasuk) {
		header('location:masuk.php');
	}else{
		echo "gagal";
		header('location:masuk.php');
	}

}


// menambahkan barang keluar
if (isset($_POST['addbarangkeluar'])) {
	$barangnya = $_POST['barangnya'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);

	$stocksekarang = $ambildatanya['stock'];
	if ($stocksekarang >= $qty) {
		// kalau barang cukup
	

		$tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

		$addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, penerima, qty) values('$barangnya', '$penerima', $qty)");
		$updatestockmasuk = mysqli_query($conn, "update stock set stock= '$tambahkanstocksekarangdenganquantity' where idbarang= '$barangnya' ");

		if ($addtokeluar&&$updatestockmasuk) {
			header('location:keluar.php');
		}else{
			echo "gagal";
			header('location:keluar.php');
		}
	}else{
		// kalau barang gak cukup
		echo'
		<script>
			alert("Stok saat ini tidak mencukupi");
			window.location.href="keluar.php";
		</script>
	    ';
	}
}


// edit barang
if (isset($_POST['updatebarang'])) {
	$idb = $_POST['idb'];
	$kode = $_POST['kode'];
	$namabarang = $_POST['namabarang'];
	$lokasi = $_POST['lokasi'];
	$deskripsi = $_POST['deskripsi'];

	$update = mysqli_query($conn, "update stock set kode = '$kode', namabarang = '$namabarang', lokasi = '$lokasi' , deskripsi = '$deskripsi' where idbarang = '$idb'");
	if ($update) {
		header('location:index.php');
	}else{
		echo "gagal";
		header('location:index.php');
	}

	
}

// menghapus barang
if (isset($_POST['hapusbarang'])) {
	$idb = $_POST['idb'];

	$hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
	if ($hapus) {
		header('location:index.php');
	}else{
		echo "gagal";
		header('location:index.php');
	}

}

// update barang masuk

if (isset($_POST['updatebarangmasuk'])) {
	$idb = $_POST['idb'];
	$idm = $_POST['idm'];
	$keterangan = $_POST['keterangan'];
	$qty = $_POST['qty'];

	$lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$stocknya = mysqli_fetch_array($lihatstock);
	$stockskrg = $stocknya['stock'];

	$qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
	$qtynya = mysqli_fetch_array($qtyskrg);
	$qtyskrg = $qtynya['qty'];

	if ($qty>$qtyskrg) {
		$selisih = $qty-$qtyskrg;
		$kurangin = $stockskrg + $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$keterangan' where idmasuk='$idm'");
			if ($kurangistocknya&&$updatenya) {
				header('location:masuk.php');
			}else{
				echo "gagal";
				header('location:masuk.php');
			}
			
		
	} else{
		$selisih = $qtyskrg-$qty;
		$kurangin = $stockskrg - $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$keterangan' where idmasuk='$idm'");
			if ($kurangistocknya&&$updatenya) {
				header('location:masuk.php');
			}else{
				echo "gagal";
				header('location:masuk.php');
			}
	}

}

// menghapus barang masuk
if (isset($_POST['hapusbarangmasuk'])) {
	$idb = $_POST['idb'];
	$qty = $_POST['kty'];
    $idm = $_POST['idm'];

	$getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$data = mysqli_fetch_array($getdatastock);
	$stock = $data['stock'];

	$selisih = $stock-$qty;

	$update = mysqli_query($conn, "update stock set stock= '$selisih' where idbarang= '$idb' ");
	$hapusdata = mysqli_query($conn, "delete from masuk where idmasuk= '$idm'");

	if ($update&&$hapusdata) {
		 header('location:masuk.php');
	}else{
		 header('location:masuk.php');
	}

}

// update barang keluar

if (isset($_POST['updatebarangkeluar'])) {
	$idb = $_POST['idb'];
	$idk = $_POST['idk'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$stocknya = mysqli_fetch_array($lihatstock);
	$stockskrg = $stocknya['stock'];

	$qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
	$qtynya = mysqli_fetch_array($qtyskrg);
	$qtyskrg = $qtynya['qty'];

	if ($qty>$qtyskrg) {
		$selisih = $qty-$qtyskrg;
		$kurangin = $stockskrg - $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
			if ($kurangistocknya&&$updatenya) {
				header('location:keluar.php');
			}else{
				echo "gagal";
				header('location:keluar.php');
			}
			
		
	} else{
		$selisih = $qtyskrg-$qty;
		$kurangin = $stockskrg + $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
			if ($kurangistocknya&&$updatenya) {
				header('location:keluar.php');
			}else{
				echo "gagal";
				header('location:keluar.php');
			}
	}

}

// menghapus barang keluar
if (isset($_POST['hapusbarangkeluar'])) {
	$idb = $_POST['idb'];
	$qty = $_POST['kty'];
    $idk = $_POST['idk'];

	$getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$data = mysqli_fetch_array($getdatastock);
	$stock = $data['stock'];

	$selisih = $stock+$qty;

	$update = mysqli_query($conn, "update stock set stock= '$selisih' where idbarang= '$idb' ");
	$hapusdata = mysqli_query($conn, "delete from keluar where idkeluar= '$idk'");

	if ($update&&$hapusdata) {
		 header('location:keluar.php');
	}else{
		 header('location:keluar.php');
	}

}

// menambah admin
if (isset($_POST['tambahadminbaru'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$queryinsert = mysqli_query($conn, "insert into login (email, password) values ('$email','$password') ");

	if ($queryinsert) {
		// berhasil
		 header('location:admin.php');

	}else{
		// gagal
		 header('location:admin.php');
	}
}

// edit admin
if (isset($_POST['updateadmin'])) {
	$emailbaru = $_POST['email'];
	$passwordbaru = $_POST['password'];
	$idnya = $_POST['id'];

	$queryupdate = mysqli_query($conn, "update login set email = '$emailbaru',password = '$passwordbaru' where iduser = '$idnya' ");

	if ($queryupdate) {
		// berhasil
		 header('location:admin.php');

	}else{
		// gagal
		 header('location:admin.php');
	}
}

// hapus admin
if (isset($_POST['hapusadmin'])) {
		$id = $_POST['id'];

		$querydelete = mysqli_query($conn, "delete from login where iduser= '$id'");

	if ($querydelete) {
			 header('location:admin.php');
		}else{
			 header('location:admin.php');
		}	
}


// meminjam barang
if (isset($_POST['pinjam'])) {
	$idbarang = $_POST['barangnya'];
	$qty = $_POST['qty'];
	$penerima = $_POST['penerima'];
	$prodi = $_POST['prodi'];
	$semester = $_POST['semester'];

	//ambil stok sekarang 
	$stok_saiki = mysqli_query($conn, "select * from stock where idbarang='$idbarang'");
	$stok_nya = mysqli_fetch_array($stok_saiki);
	$stok = $stok_nya['stock'];

	// kurangi stoknya
	$stok_anyar = $stok-$qty;

	// mulai query insert
	$insertpinjam = mysqli_query($conn, "INSERT INTO peminjaman (idbarang,qty,peminjam,prodi,semester) values ('$idbarang','$qty','$penerima','$prodi','$semester') ");

	// mengurangi stok tabel stok
	$kurangistok = mysqli_query($conn, "update stock set stock='$stok_anyar' where idbarang='$idbarang'");

	if($insertpinjam&&$kurangistok) {
		echo'
		<script>
			alert("Berhasil");
			window.location.href="pinjam.php";
		</script>
	    ';
	}else{
		echo'
		<script>
			alert("Gagal");
			window.location.href="pinjam.php";
		</script>
	    ';
	}
}


// menyelesaikan pinjaman
if (isset($_POST['barangkembali'])) {
	$idpinjam = $_POST['idpinjam'];
	$idbarang = $_POST['idbarang'];

	$pembaruan_status = mysqli_query($conn, "update peminjaman set status='kembali' where 
	idpeminjaman='$idpinjam'");

	//ambil stok sekarang 
	$stok_saiki = mysqli_query($conn, "select * from stock where idbarang='$idbarang'");
	$stok_nya = mysqli_fetch_array($stok_saiki);
	$stok = $stok_nya['stock'];

	//ambil qty dari idpinjam 
	$stok_saiki1 = mysqli_query($conn, "select * from peminjaman where idpeminjaman='$idpinjam'");
	$stok_nya1 = mysqli_fetch_array($stok_saiki1);
	$stok1 = $stok_nya1['qty'];

	// tambahi stoknya
	$stok_anyar = $stok1+$stok;

	// kembalikan stoknya
	$kembalikan_stok = mysqli_query($conn, "update stock set stock='$stok_anyar' where idbarang='$idbarang'");

	// eksekusi
	if ($pembaruan_status&&$kembalikan_stok) {
		echo'
		<script>
			alert("Berhasil");
			window.location.href="pinjam.php";
		</script>
	    ';
	}else{
		echo'
		<script>
			alert("Gagal");
			window.location.href="pinjam.php";
		</script>
	    ';
	}

}

 ?>