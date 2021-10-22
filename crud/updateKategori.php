<?php 
if (isset($_POST['id'])) {
	include 'config.php';
	$id = $_POST['id'];
	$nama = $_POST['nama'];

	if(!empty($nama)){
		$query = "update kategori_produk set nama_kategori='$nama' where id=$id";
		$result = mysqli_query($conn, $query);
		if (!$result) echo "Error: ". mysqli_error($conn);
		echo 'Succesfully! Data kategori berhasil diupdate.';
	}else{
		echo 'Failed! Mohon lengkapi form';
	}
}


?>