<?php 
require_once 'config.php';

// Mencari data berdasarkan id
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$qry ="select * from transaksi where id=$id";
	$result = mysqli_query($conn, $qry);
	$row = mysqli_fetch_array($result);

	if($row) {
		echo json_encode($row);
	}
	exit();
}

//Menampilkan seluruh data
$result = mysqli_query($conn, "select t.*, c.nama, c.no_wa, p.nama_produk, p.harga from transaksi t, customers c, products p where t.customer_id=c.id and t.product_id=p.id order by t.id asc");
showData($result);

function showData($result)
{
	$no = 1;
	if (mysqli_num_rows($result) < 1) {
		echo "<tr><td colspan='9' style='text-align:center;'>Tidak ada data</td></tr>";
	} else {
		while ($row = mysqli_fetch_array($result)) { ?>

			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $row['nama'] ?></td>
				<td><a href="https://wa.me/<?php echo $row['no_wa'] ?>" target="_blank" class="no-wa"><ion-icon name="logo-whatsapp"></ion-icon> <?php echo $row['no_wa'] ?></a></td>
				<td><?php echo $row['nama_produk'] ?></td>
				<td><?php echo $row['jumlah'] ?></td>
				<td><?php echo $row['total_harga'] ?></td>
				<td><?php echo date('d/m/Y', strtotime($row['tanggal'])) ?></td>
				<td><span class="status <?php echo $row['status'] ?>"><?php echo $row['status'] ?></span></td>
				<td>
					<a href="#" id="btnEditTransaksi" data-id="<?php echo $row['id'] ?>"><ion-icon name="create" style="color: #10B981;"></ion-icon></a>
					<a href="javascript:void();" id="btnDelTransaksi" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['nama'] ?>" data-product="<?php echo $row['nama_produk'] ?>" data-tanggal="<?php echo $row['tanggal'] ?>">
						<ion-icon name="trash" style="color: #EF4444;"></ion-icon>
					</a>
				</td>
			</tr>
			<?php
		}
	}
}

?>