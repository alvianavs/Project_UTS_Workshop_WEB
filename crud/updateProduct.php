<?php 
if (isset($_POST['id'])) {
	include 'config.php';
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$kondisi = $_POST['kondisi'];
	$harga = $_POST['harga'];
	$stok = $_POST['stok'];
	$kategori = $_POST['kategori'];

	if(!empty($nama) && !empty($kondisi) && !empty($id) && !empty($harga) && !empty($stok) && !empty($kategori)){
		$query = "update products set nama_produk='$nama', kondisi='$kondisi', harga='$harga', stok='$stok', kategori_id='$kategori', updated_at=NOW() where id=$id";
		$result = mysqli_query($conn, $query);
		if (!$result) echo "Error: ". mysqli_error($conn);
		echo 'Succesfully! Data product berhasil diupdate.';
	}else{
		echo 'Failed! Mohon lengkapi form';
	}
}


?>