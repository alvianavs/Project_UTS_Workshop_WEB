<?php
$valid_extensions = array('jpeg', 'jpg', 'png');
$path = '../assets/img/';

$nama = $_POST['nama'];
$kondisi = $_POST['kondisi'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$kategori_id = $_POST['kategori'];
if(!empty($nama) && !empty($kondisi) && !empty($harga) && !empty($stok) && $kategori_id != 0 && $_FILES['image']) {
	$img = $_FILES['image']['name'];
	$tmp = $_FILES['image']['tmp_name'];
	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
	$final_image = rand(1000,1000000).$img;
	if(in_array($ext, $valid_extensions)) 
	{ 
		$path = $path.strtolower($final_image); 
		if(move_uploaded_file($tmp,$path)) 
		{
			require_once 'config.php';
			$execute = mysqli_query($conn, "insert into products values ('', '$nama', '$kondisi', '$harga', '$stok', '$final_image', '$kategori_id', NOW(), NOW())");
			if ($execute == true) {
				echo "Successfully! Data product berhasil ditambahkan.";
			} else echo "Error: " . $execute;
		} else echo $path;
	} 
	else 
	{
		echo 'Failed! Terjadi kesalahan.';
	}
} else echo "Failed! mohon lengkapi form";
?>