<!DOCTYPE html>
<html>
<head>
	<title>Laporan transaksi</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
	<body>
		<div class="container">
			<h2>Laporan transaksi</h2>
			<div class="data-tables datatable-dark">

				<table class="table" id="export-transaksi">
					<thead class="bg-info">
						<tr>
							<th>Nama customer</th>
							<th>No whatsapp</th>
							<th>Produk</th>
							<th>Jumlah</th>
							<th>Total harga</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include '../crud/config.php';
						$query = mysqli_query($conn,"select t.*, c.nama, c.no_wa, p.nama_produk, p.harga from transaksi t, customers c, products p where t.customer_id=c.id and t.product_id=p.id order by t.id asc");
						while($row = mysqli_fetch_array($query))
						{
							echo "<tr>
							<td>".$row['nama']."</td>
							<td>".$row['no_wa']."</td>
							<td>".$row['nama_produk']."</td>
							<td>".$row['jumlah']."</td>
							<td>".$row['total_harga']."</td>
							<td>".$row['status']."</td>
							</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<script>
			$(document).ready(function() {
				$('#export-transaksi').DataTable( {
					dom: 'Bfrtip',
					buttons: [
					'pdf', 'print'
					]
				});
			});
		</script>
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
	</body>
	</html>