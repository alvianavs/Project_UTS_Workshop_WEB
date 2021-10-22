<?php 
if (isset($_POST['id'])) {
	include 'config.php';
	$id = $_POST['id'];
	$customer_id = $_POST['customer_id'];
	$product_id = $_POST['product_id'];
	$jumlah = $_POST['jumlah'];
	$total = $_POST['total'];
	$tanggal = $_POST['tanggal'];
	$status = $_POST['status'];

	if($customer_id != 0 && $product_id != 0 && $status != 'null' && !empty($jumlah) && !empty($total) && !empty($tanggal) && !empty($id)){
		$query = "update transaksi set customer_id='$customer_id', product_id='$product_id', jumlah='$jumlah', total_harga='$total', tanggal='$tanggal', status='$status', updated_at=now() where id=$id";
		$result = mysqli_query($conn, $query);
		if (!$result) echo "Error: ". mysqli_error($conn);
		echo 'Succesfully! Data transaksi berhasil diupdate.';
	}else{
		echo 'Failed! Mohon lengkapi form';
	}
}


?>