<?php
include 'config.php';
$execute = mysqli_query($conn, "select id from customers");
$row = mysqli_num_rows($execute);
?>
<p>Total : <?php echo $row ?></p><br>
<canvas id="gender" width="270" height="270"></canvas>

<script>
	var gender = document.getElementById('gender').getContext('2d');
	var myChart = new Chart(gender, {
		type: 'doughnut',
		data: {
			labels: ['Perempuan', 'Laki-laki'],
			datasets: [{
				label: 'Gender',
				data: [
				<?php
				$female = mysqli_query($conn, "select id from customers where gender='P'");
				echo mysqli_num_rows($female);
				?>,
				<?php
				$male = mysqli_query($conn, "select id from customers where gender='L'");
				echo mysqli_num_rows($male);
				?>
				],
				backgroundColor: [
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)'
				],
			}]
		},
		options: {
			responsive: true,
		}
	});
</script>