<?php
	if (isset($_POST['idBarang'])) {
		$idBarang = $_POST['idBarang'];
		$foto_lama = $_POST['foto_lama'];
		$simpan = "EDIT";
	} else {
		$simpan = "BARU";
	}

	$nama = $_POST['nama'];
	$harga = $_POST['harga'];
	$stok = $_POST['stok'];


	$foto = $_FILES['foto']['name'];
	$tmpName = $_FILES['foto']['tmp_name'];
	$size = $_FILES['foto']['size'];
	$type = $_FILES['foto']['type'];

	$maxSize = 1500000;
	$typeYgBoleh = array("image/jpeg","image/png","image/pjpeg");

	$dirFoto = "pict";
	if (!is_dir($dirFoto)) {
		mkdir($dirFoto);
	}
	$fileTujuanFoto = $dirFoto."/".$foto;

	include "koneksi3.php";

	if ($simpan == "EDIT") {
		if ($size == 0) {
			$foto = $foto_lama;
		}
		$sql = "update barang set nama = '$nama', harga = $harga, stok = $stok, foto = '$foto' where idBarang = $idBarang";
	} else {
		$sql = "insert into barang (nama, harga, stok, foto) 
				values
				('$nama', $harga, $stok, '$foto')";
	}
	
	$hasil = mysqli_query($kon, $sql);

	if (!$hasil) {
		echo "Gagal Simpan, silahkan diulangi!<br/>";
		echo mysqli_error($kon);
		echo "<br /> <input type='button' value='Kembali' onClick='self.history.back()' />";
		exit;
	} else {
		echo "Simpan data berhasil";
	}

	if ($size > 0) {
		if (!move_uploaded_file($tmpName, $fileTujuanFoto)) {
			echo "Gagal upload gambar... <br />";
			echo "<a href='index.php?page=daftar_barang'>Daftar Barang</a>";
			exit;
		} else {
		
		}
	}
	echo "<br />File Sudah diupload.<br />";


?>
<hr />
<a href="index.php?page=daftar_barang" class="btn btn-primary">DAFTAR BARANG</a>