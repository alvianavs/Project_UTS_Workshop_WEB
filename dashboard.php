<?php
include 'crud/config.php';
?>
<div class="cardBox">
	<div class="card">
		<div>
			<?php
			$customers = mysqli_query($conn, "select id from customers");
			$customers = mysqli_num_rows($customers);
			?>
			<div class="numbers"><?php echo $customers ?></div>
			<div class="cardName">Customers</div>
		</div>
		<div class="iconBx"><ion-icon name="people"></ion-icon></div>
	</div>
	<div class="card">
		<div>
			<?php
			$products = mysqli_query($conn, "select id from products");
			$products = mysqli_num_rows($products);
			?>
			<div class="numbers"><?php echo $products ?></div>
			<div class="cardName">Products</div>
		</div>
		<div class="iconBx"><ion-icon name="cart"></ion-icon></div>
	</div>
	<div class="card">
		<div>
			<?php
			$transaksi = mysqli_query($conn, "select id from transaksi");
			$transaksi = mysqli_num_rows($transaksi);
			?>
			<div class="numbers"><?php echo $transaksi ?></div>
			<div class="cardName">Transaction</div>
		</div>
		<div class="iconBx"><ion-icon name="calendar"></ion-icon></div>
	</div>
	<div class="card">
		<div>
			<?php
			$pendapatan = mysqli_query($conn, "select sum(total_harga) as total from transaksi where status='Paid'");
			$pendapatan = mysqli_fetch_array($pendapatan);
			$pendapatan = substr($pendapatan['total'], 0, -3);
			?>
			<div class="numbers" style="font-size: 25px">Rp. <?php echo number_format($pendapatan,0,',','.'); ?>k</div>
			<div class="cardName">Earnings</div>
		</div>
		<div class="iconBx"><ion-icon name="cash"></ion-icon></div>
	</div>

</div>

<!-- chart -->
<div class="details">
	<div class="graphBox">
		<div class="box">
			<?php
			$execute = mysqli_query($conn, "SELECT DATE_FORMAT(tanggal, '%b') AS bulan, SUM(total_harga) AS total FROM transaksi WHERE status='Paid' GROUP BY Month(tanggal)");
			$data = array();
			foreach ($execute as $row) {
				$data[] = $row;
			}
			$data = json_encode($data);
			?>
			<canvas id="earning"></canvas>
			<script>
				var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
				var total = [];
				var bulan = [];
				var total_harga = [];
				var data = <?php echo $data ?>;

				for (var i in data) {
					total.push(data[i].total);
					bulan.push(data[i].bulan);
				}
				for (var j = 0; j < 12; j++) {
					for (var k = 0; k < bulan.length; k++) {
						if (month[j] == bulan[k]) {
							total_harga[j] = total[k];
						}
					}
				}
				
				// console.log(total_harga);
				var earning = document.getElementById('earning').getContext('2d');
				var myChart = new Chart(earning, {
					type: 'bar',
					data: {
						labels: month,
						datasets: [{
							label: 'Pendapatan',
							data: total_harga,
							backgroundColor: [
							'rgba(255, 99, 132, 1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(153, 102, 255, 1)',
							'rgba(255, 159, 64, 1)',
							'rgba(255, 99, 132, 1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(153, 102, 255, 1)',
							'rgba(255, 159, 64, 1)'
							]
						}]
					},
					options: {
						responsive: true,
					}
				});
			</script>
		</div>
		<div class="box">
			<h3 style="margin-bottom: 10px">3 Customer terbaik</h3>
			<?php
			$execute = mysqli_query($conn, "select c.nama, count(t.customer_id) as count from customers c, transaksi t where t.customer_id=c.id and t.status='Paid' group by t.customer_id order by c.id asc limit 3");
			$data = array();
			foreach ($execute as $row) {
				$data[] = $row;
			}
			$data = json_encode($data);
			?>
			<canvas id="bestCustomers"></canvas>
			<script>
				var nama = [];
				var count = [];
				var data = <?php echo $data ?>;

				for(var i in data) {
					nama.push(data[i].nama);
					count.push(data[i].count);
				}
				var bestCustomers = document.getElementById('bestCustomers').getContext('2d');
				var myChart = new Chart(bestCustomers, {
					type: 'doughnut',
					data: {
						labels: nama,
						datasets: [{
							label: '3 Customer terbaik',
							data: count,
							backgroundColor: [
							'rgba(255, 99, 132, 1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)'
							],
						}]
					},
					options: {
						responsive: true,
					}
				});

			</script>
		</div>
	</div>
</div>

<!-- data -->
<div style="padding-right: 20px;">
	<div class="recent">
		<div class="cardDetails">
			<div class="cardHeader">
				<h2>Transaksi terbaru</h2>
				<a href="#" class="btngototransaksi">View all</a>
			</div>
			<table>
				<thead>
					<tr>
						<td>Nama</td>
						<td>Product</td>
						<td>Total</td>
						<td>Status</td>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = mysqli_query($conn, "select c.nama, p.nama_produk, t.total_harga, t.status from customers c, products p, transaksi t where t.customer_id=c.id && t.product_id=p.id order by t.created_at desc limit 5");
					if (mysqli_num_rows($query) < 1) {
						echo "<tr><td colspan='4' style='text-align:center;'>Tidak ada data</td></tr>";
					} else {
						while ($row = mysqli_fetch_array($query)) { ?>
							<tr>
								<td><?php echo $row['nama'] ?></td>
								<td><?php echo $row['nama_produk'] ?></td>
								<td>Rp.<?php echo number_format($row['total_harga'],0,',','.') ?></td>
								<td>
									<span class="status <?php echo $row['status'] ?>"><?php echo $row['status'] ?></span>
								</td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
		<!-- New Customers -->
		<div class="recentCustomers">
			<div class="cardHeader">
				<h2>Customer terbaru</h2>
			</div>
			<table>
				<?php
				$sql = mysqli_query($conn, "select nama, no_wa, created_at from customers order by created_at desc limit 5");
				if (mysqli_num_rows($sql) < 1) {
					echo "<tr><td colspan='4' style='text-align:center;'>Tidak ada data</td></tr>";
				} else {
					while ($row = mysqli_fetch_array($sql)) { ?>
						<tr>
							<td><h4><?php echo $row['nama'] ?><br><span><?php echo $row['no_wa'] ?></span></h4></td>
							<td style="text-align: end;"><small><?php echo getDateTimeDiff($row['created_at']) ?></small></td>
						</tr>
						<?php
					}
				}
				function getDateTimeDiff($date){
					$now_timestamp = strtotime(date('Y-m-d H:i:s'));
					$diff_timestamp = $now_timestamp - strtotime($date);

					if($diff_timestamp<60){
						return 'few seconds ago';
					}
					else if($diff_timestamp>=60 && $diff_timestamp<3600){
						return round($diff_timestamp/60).' mins ago';
					}
					else if($diff_timestamp>=3600 && $diff_timestamp<86400){
						return round($diff_timestamp/3600).' hours ago';
					}
					else if($diff_timestamp>=86400 && $diff_timestamp<(86400*30)){
						return round($diff_timestamp/(86400)).' days ago';
					}
					else if($diff_timestamp>=(86400*30) && $diff_timestamp<(86400*365)){
						return round($diff_timestamp/(86400*30)).' months ago';
					}
					else{
						return round($diff_timestamp/(86400*365)).' years ago';
					}
				}
				?>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.btngototransaksi').click(function() {
			$('#page-file').load("transaksi.php");
		});
	})
</script>