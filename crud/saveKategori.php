<?php
require_once 'config.php';

$nama = $_POST['nama'];

if(!empty($nama)){
	$query = "INSERT INTO kategori_produk VALUES('', '$nama')";
	$execute = mysqli_query($conn, $query);
	if($execute == true)
	{
		echo 'Succesfully! Data kategori berhasil ditambahkan';
	}
	else{
		echo "Error: " . $query;
	}
}else{
	echo 'Failed! Mohon lengkapi form';
}
?>