<?php 
require_once 'config.php';

// Mencari data berdasarkan id
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$qry ="select * from kategori_produk where id=$id";
	$result = mysqli_query($conn, $qry);
	$row = mysqli_fetch_array($result);

	if($row) {
		echo json_encode($row);
	}
	exit();
}

//Menampilkan seluruh data
$result = mysqli_query($conn, "select * from kategori_produk");
showData($result);

function showData($result)
{
	$no = 1;
	if (mysqli_num_rows($result) < 1) {
		echo "<tr><td colspan='3' style='text-align:center;'>Tidak ada data</td></tr>";
	} else {
		while ($row = mysqli_fetch_array($result)) { ?>

			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $row['nama_kategori'] ?></td>
				<td>
					<a href="#" id="btnEditKategori" data-id="<?php echo $row['id'] ?>"><ion-icon name="create" style="color: #10B981;"></ion-icon></a>
					<a href="javascript:void();" id="btnDelKategori" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['nama_kategori'] ?>">
						<ion-icon name="trash" style="color: #EF4444;"></ion-icon>
					</a>
				</td>
			</tr>
			<?php
		}
	}
}

?>