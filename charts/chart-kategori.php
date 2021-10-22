<?php
include 'config.php';
$execute = mysqli_query($conn, "select kategori_produk.nama_kategori, count(products.id) as count from products, kategori_produk where products.kategori_id = kategori_produk.id group by kategori_id");
$total = mysqli_query($conn, "select id from products");
$total = mysqli_num_rows($total);
$data = array();
foreach ($execute as $row) {
	$data[] = $row;
}
$data = json_encode($data);
?>
<p id="total">Jumlah data: <?php echo $total ?></p><br>
<canvas id="kategoriProduk" width="270" height="270"></canvas>

<script>
	$(document).ready(function() {
		var nama = [];
		var count = [];
		var data = <?php echo $data ?>;

		for(var i in data) {
			nama.push(data[i].nama_kategori);
			count.push(data[i].count);
		}
		var kategoriProduk = document.getElementById('kategoriProduk').getContext('2d');
		var myChart = new Chart(kategoriProduk, {
			type: 'doughnut',
			data: {
				labels: nama,
				datasets: [{
					label: 'Kategori',
					data: count,
					backgroundColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)'
					],
				}]
			},
			options: {
				responsive: true,
			}
		});
	});
</script>