<?php
require_once 'config.php';

$customer_id = $_POST['customer_id'];
$product_id = $_POST['product_id'];
$jumlah = $_POST['jumlah'];
$total = $_POST['total'];
$tanggal = $_POST['tanggal'];
$status = $_POST['status'];
if($customer_id != 0 && $product_id != 0 && $status != 'null' && !empty($jumlah) && !empty($total) && !empty($tanggal)){
	$query = "INSERT INTO transaksi VALUES('', '$customer_id','$product_id','$jumlah','$total','$tanggal','$status', now(), now())";
	$execute = mysqli_query($conn, $query);
	if($execute == true)
	{
		echo 'Succesfully! Data transaksi berhasil ditambahkan';
	}
	else{
		echo "Error: " . $query;
	}
}else{
	echo 'Failed! Mohon lengkapi form';
}

?>