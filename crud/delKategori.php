<?php
require_once 'config.php';

if (isset($_GET['id']))
{
	$id = $_GET['id'];
	$query = "delete from kategori_produk where id = $id";
	$result = mysqli_query($conn, $query);
	if (!$result) echo "Error: ". mysqli_error($conn);
	echo 'Succesfully! Data kategori berhasil dihapus';
}
?>