<div class="recent">
	<div class="cardDetails">
		<div class="cardHeader">
			<h2 class="titleForm">Tambah customer</h2>
			<button id="clearCustomer" class="btnCancel" style="display: none;"><ion-icon name="close"></ion-icon></button>
		</div>
		<!-- <p id="message"></p> -->
		<form id="saveDataCustomers">
			<input type="hidden" name="id" id="id" value="">
			<div class="form-control">
				<input type="text" class="form-input" name="nama" id="nama" placeholder="Nama..">
				<span class="focus-border"></span>
			</div>
			<div class="form-control">
				<input type="text" class="form-input" name="nowa" id="nowa" placeholder="No Whatsapp..">
				<span class="focus-border"></span>
			</div>
			<div class="form-control">
				<input type="text" class="form-input" name="alamat" id="alamat" placeholder="Alamat..">
				<span class="focus-border"></span>
			</div>
			<div class="form-control">
				<span>Jenis kelamin</span>
				<div class="input-radio">
					<input type="radio" id="hidden-radio" name="gender" value="null" checked hidden>
					<input type="radio" name="gender" id="male" value="L">
					<label for="male">Laki-laki</label>
					<input type="radio" name="gender" id="female" value="P">
					<label for="female">Perempuan</label>
				</div>
			</div>
			<div class="form-control">
				<button type="submit" id="btnSave" class="btn-green">Save</button>
				<button type="submit" id="btnUpdate" class="btn-green" style="display: none;">Update</button>
			</div>
		</form>
		
	</div>
	
	<div class="graphBox">
		<div class="box">
			<h3>Jumlah customers <a href="#" id="goToTable"><ion-icon name="caret-down"></ion-icon></a></h3>
			<br>
			<!-- include chart gender -->
			<div id="chartGender"><?php include 'charts/chart-gender.php'; ?></div>
		</div>
	</div>
</div>
<div class="details">
	<div class="cardDetails">
		<div class="cardHeader">
			<h2>Customers</h2>
		</div>
		<table>
			<thead>
				<tr>
					<td>No</td>
					<td>Nama</td>
					<td>No Whatsapp</td>
					<td>Gender</td>
					<td>Alamat</td>
					<td>Aksi</td>
				</tr>
			</thead>
			<tbody id="dataCustomers">
				<?php include 'crud/showCustomers.php' ?>
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
	<p class="name"></p>
	<button id="delete-customer" type="button">Delete</button>
</div>
<script>
	$(document).ready(function() {
		$('#clearCustomer').click(function() {
			$('#updateDataCustomer').attr('id', 'saveDataCustomers');
			$('.titleForm').html('Tambah customer');
			$('#nama').val('');
			$('#nowa').val('');
			$('#alamat').val('');
			$("input[name='gender']").prop('checked', false);
			$('#btnUpdate').hide();
			$('#btnSave').show();
			$(this).hide();
		});
		$('#goToTable').click(function() {
			$('html, body').animate({
				scrollTop: $("#dataCustomers").offset().top
			}, 1500);
		});
	});
</script>