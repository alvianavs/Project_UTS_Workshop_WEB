<div style="padding-right: 20px">
	<div class="transaksi">
		<div class="cardDetails">
			<div class="cardHeader">
				<h2 class="titleForm">Tambah transaksi</h2>
				<button id="clearTransaksi" class="btnCancel" style="display: none;"><ion-icon name="close"></ion-icon></button>
			</div>
			<div class="formTransaksi">
				<form id="saveTransaksi">
					<input type="hidden" name="id" id="id" value="">
					<div class="form-control">
						<div class="select">
							<?php
							include 'crud/config.php';
							$execute = mysqli_query($conn, "select id, nama from customers");
							?>
							<select name="customer_id" id="customers" style="max-width: 350px">
								<option value="0" id="selected-customer" selected>Pilih customer</option>
								<?php
								while($row = mysqli_fetch_array($execute)) { ?>
									<option value="<?php echo $row['id'] ?>"><?php echo $row['nama'] ?></option>
									<?php
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-control">
						<div class="select">
							<?php
							include 'crud/config.php';
							$execute = mysqli_query($conn, "select id, nama_produk from products");
							?>
							<select name="product_id" id="products" style="max-width: 350px">
								<option value="0" id="selected-produk" selected>Pilih produk</option>
								<?php
								while($row = mysqli_fetch_array($execute)) { ?>
									<option value="<?php echo $row['id'] ?>"><?php echo $row['nama_produk'] ?></option>
									<?php
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-control row">
						<input type="date" class="form-input" name="tanggal" id="tanggal" placeholder="Tanggal..">
						<span class="focus-border"></span>
					</div>
					<div class="form-control row">
						<div>
							<input type="text" class="form-input" name="jumlah" id="jumlah" placeholder="Jumlah..">
							<span class="focus-border"></span>	
						</div>
						<div>
							<input type="text" class="form-input" name="total" id="total" placeholder="Total harga..">
							<span class="focus-border"></span>	
						</div>

					</div>
					<div class="form-control">
						<span>Status</span>
						<div class="input-radio">
							<input type="radio" name="status" value="null" checked hidden>
							<input type="radio" name="status" id="paid" value="Paid">
							<label for="paid">Paid</label>
							<input type="radio" name="status" id="due" value="Due">
							<label for="due">Due</label>
						</div>
					</div>
					<div class="form-control">
						<button type="submit" id="btnSave" class="btn-green">Save</button>
						<button type="submit" id="btnUpdate" class="btn-green" style="display: none;">Update</button>
					</div>
				</form>
			</div>

		</div>

		<div class="recentCustomers" style="background: white;">
			<div class="cardHeader">
				<h2>Customer</h2>
				<ion-icon name="people"></ion-icon>
			</div>
			<br>
			<p><b>Nama</b></p>
			<p id="nama-customer">-</p>
			<br>
			<p><b>No whatsapp</b></p>
			<a href="" target="_blank" class="no-wa" id="nowa-customer">-</a>
			<br>
			<p><b>Jenis kelamin</b></p>
			<p id="gender-customer">-</p>
			<br>
			<p><b>Alamat</b></p>
			<p id="alamat-customer">-</p>
		</div>
		<div class="recentCustomers" style="background: white;">
			<div class="cardHeader">
				<h2>Produk</h2>
				<ion-icon name="leaf"></ion-icon>
			</div>
			<p id="nama-product">-</p>
			<div class="imgProduk">
				<img id="img-product" src="assets/img/filed.png">
			</div>
			<p><b>Harga</b></p>
			<p id="harga">-</p>
			<br>
			<p><b>Kondisi</b></p>
			<p id="kondisi">-</p>
			<br>
			<p><b>Stok</b></p>
			<p id="stok">-</p>
		</div>
	</div>
</div>
<div class="details">
	<div class="cardDetails">
		<div class="cardHeader">
			<h2>Transaksi</h2>
			<a href="report/laporan-transaksi.php"><ion-icon name="print"></ion-icon></a>
		</div>
		<div class="popup_box" id="popup-img">
			<div class="title">
				<h2>Image</h2>
				<a href="javascript:void();"><ion-icon class="close-toggle" name="close-outline"></ion-icon></a>
			</div>
			<p class="name"></p>
			<img src="" id="product-img" style="width: 240px;">
		</div>
		<table>
			<thead>
				<tr>
					<td>No</td>
					<td>Nama customer</td>
					<td>No WA</td>
					<td>Nama produk</td>
					<td>Jumlah</td>
					<td>Total harga</td>
					<td>Tanggal</td>
					<td>Status</td>
					<td>Aksi</td>
				</tr>
			</thead>
			<tbody id="dataTransaksi">
				<?php include 'crud/showTransaksi.php'; ?>
			</tbody>
		</table>
	</div>
	
</div>
<!-- Popup delete -->
<div class="popup_box" id="popup-delete">
	<div class="title">
		<h3 style="color: white;">Apakah anda yakin ingin menghapus?</h3>
		<a href="javascript:void();"><ion-icon class="close-toggle" name="close-outline"></ion-icon></a>
	</div>
	<br>
	<p class="name" style="font-size:14px;"></p>
	<p class="product" style="font-size:14px;"></p>
	<p class="tanggal" style="font-size:14px;"></p>
	<button id="delete-transaksi" type="button">Delete</button>
</div>
<script>
	$(document).ready(function() {
		$('#clearTransaksi').click(function() {
			$('#updateTransaksi').attr('id', 'saveTransaksi');
			$('.titleForm').html('Tambah transaksi');
			$("#customers #selected-customer").prop('selected', true);
			$("#products #selected-produk").prop('selected', true);
			$('#tanggal').val('');
			$('#jumlah').val('');
			$('#total').val('');
			$("input[name='status']").prop('checked', false);
			$('#btnUpdate').hide();
			$('#btnSave').show();
			$('#nama-customer, #nowa-customer, #gender-customer, #alamat-customer').html('-');
			$('#nama-product, #harga, #kondisi, #stok').html('-');
			$('#img-product').attr('src', 'assets/img/filed.png');
			$(this).hide();
		});
		$('#goToTable').click(function() {
			$('html, body').animate({
				scrollTop: $("#dataTransaksi").offset().top
			}, 1500);
		});
	});
</script>