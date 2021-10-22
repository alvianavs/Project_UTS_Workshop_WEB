<?php
require_once 'config.php';

$nama = $_POST['nama'];
$nowa = $_POST['nowa'];
$gender = $_POST['gender'];
$alamat = $_POST['alamat'];

if(!empty($nama) && !empty($nowa) && $gender != 'null' && !empty($alamat)){
	insertData($nama, $nowa, $gender, $alamat);
}else{
	echo 'Failed! Mohon lengkapi form';
}

function insertData($nama, $nowa, $gender, $alamat){
	global $conn;
	global $failed;
	global $sukses;
	$query = "INSERT INTO customers VALUES('', '$nama','$nowa','$gender','$alamat', now(), now())";
	$execute = mysqli_query($conn, $query);
	if($execute == true)
	{
		echo 'Succesfully! Data customer berhasil ditambahkan.';
	}
	else{
		echo "Error: " . $query;
	}
}
?>