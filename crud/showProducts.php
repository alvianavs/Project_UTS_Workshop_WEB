<?php 
require_once 'config.php';

// Mencari data berdasarkan id
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$qry ="select * from products where id=$id";
	$result = mysqli_query($conn, $qry);
	$row = mysqli_fetch_array($result);

	if($row) {
		echo json_encode($row);
	}
	exit();
}

//Menampilkan seluruh data
$result = mysqli_query($conn, "select p.*, k.nama_kategori from products p, kategori_produk k where p.kategori_id = k.id order by p.created_at");
showData($result);

function showData($result)
{
	$no = 1;
	if (mysqli_num_rows($result) < 1) {
		echo "<tr><td colspan='7' style='text-align:center;'>Tidak ada data</td></tr>";
	} else {
		while ($row = mysqli_fetch_array($result)) { ?>

			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $row['nama_produk'] ?></td>
				<td><?php echo $row['kondisi'] ?></td>
				<td>Rp. <?php echo $row['harga'] ?></td>
				<td><?php echo $row['stok'] ?></td>
				<td><?php echo $row['nama_kategori'] ?></td>
				<td>
					<a href="javascript:void();" id="btn-img" data-id="<?php echo $row['id'] ?>" data-img="<?php echo $row['image'] ?>" data-name="<?php echo $row['nama_produk'] ?>"><ion-icon name="image"></ion-icon></a>
					<a href="#" id="btnEditProduct" data-id="<?php echo $row['id'] ?>"><ion-icon name="create" style="color: #10B981;"></ion-icon></a>
					<a href="javascript:void();" id="btnDelProduct" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['nama_produk'] ?>" data-file="<?php echo $row['image'] ?>">
						<ion-icon name="trash" style="color: #EF4444;"></ion-icon>
					</a>
				</td>
			</tr>
			<?php
		}
	}
}

?>