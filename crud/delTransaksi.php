<?php
require_once 'config.php';

if (isset($_GET['id']))
{
	$id = $_GET['id'];
	$query = "delete from transaksi where id = $id";
	$result = mysqli_query($conn, $query);
	if (!$result) echo "Error: ". mysqli_error($conn);
	echo 'Succesfully! Data transaksi berhasil dihapus';
}
?>