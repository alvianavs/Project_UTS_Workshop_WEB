<?php 
if (isset($_POST['id'])) {
	include 'config.php';
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$nowa = $_POST['nowa'];
	$gender = $_POST['gender'];
	$alamat = $_POST['alamat'];

	if(!empty($nama) && !empty($nowa) && $gender != 'null' && !empty($alamat)){
		$query = "update customers set nama='$nama', no_wa='$nowa', gender='$gender', alamat='$alamat', updated_at=now() where id=$id";
		$result = mysqli_query($conn, $query);
		if (!$result) echo "Error: ". mysqli_error($conn);
		echo 'Succesfully! Data customer berhasil diupdate.';
	}else{
		echo 'Failed! Mohon lengkapi form';
	}
}


?>