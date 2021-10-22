<?php
$valid_extensions = array('jpeg', 'jpg', 'png');
$path = '../assets/img/';

if($_FILES['inputUpdateImg']) {
	$id = $_POST['idproduct'];
	$oldImg = $_POST['oldImg'];
	$img = $_FILES['inputUpdateImg']['name'];
	$tmp = $_FILES['inputUpdateImg']['tmp_name'];
	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
	$final_image = rand(1000,1000000).$img;
	if(in_array($ext, $valid_extensions))
	{ 
		$path = $path.strtolower($final_image); 
		if(move_uploaded_file($tmp,$path)) 
		{
			$file_path = '../assets/img/' . $oldImg;
			unlink($file_path);
			require_once 'config.php';
			$execute = mysqli_query($conn, "update products set image='$final_image', updated_at=NOW() where id='$id'");
			if ($execute == true) {
				echo "Successfully! Data image product berhasil diupdate";
			} else echo "Error: " . $execute;
		} else echo $path;
	} 
	else 
	{
		echo 'Failed! Terjadi kesalahan.';
	}
} else echo "Failed! mohon lengkapi form";
?>