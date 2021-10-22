<?php
require_once 'config.php';

if (isset($_GET['id']))
{
	$file_path = '../assets/img/' . $_GET["path"];
	if(unlink($file_path))
	{
		$id = $_GET['id'];
		$query = "delete from products where id = $id";
		$result = mysqli_query($conn, $query);
		if (!$result) echo "Error: ". mysqli_error($conn);
		echo 'Succesfully! Data product berhasil dihapus';
	}
}
?>