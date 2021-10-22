<div style="padding: 20px;">
	<div class="recent">
		<div class="cardDetails">
			<div class="cardHeader">
				<h2>Kategori tanaman</h2>
			</div>
			<table>
				<thead>
					<tr>
						<td>No</td>
						<td>Nama kategori</td>
						<td>Aksi</td>
					</tr>
				</thead>
				<tbody id="dataKategori">
					<?php include 'crud/showKategori.php' ?>
				</tbody>
			</table>
		</div>
		<!-- New Customers -->
		<div class="recentCustomers" style="background: white; height: 230px;">
			<div class="cardHeader">
				<h3 class="titleForm">Tambah kategori</h3>
				<button id="clearKategori" class="btnCancel" style="display: none;"><ion-icon name="close"></ion-icon></button>
			</div>
			<form id="saveDataKategori">
				<input type="hidden" name="id" id="id" value="">
				<div class="form-control">
					<input type="text" class="form-input" name="nama" id="nama" placeholder="Nama kategori..">
					<span class="focus-border"></span>
				</div>
				<div class="form-control" style="float: right;">
					<button type="submit" id="btnSave" class="btn-green">Save</button>
					<button type="submit" id="btnUpdate" class="btn-green" style="display: none;">Update</button>
				</div>
			</form>
		</div>
	</div>

</div>
<div class="popup_box">
	<div class="title">
		<h3 style="color: white;">Apakah anda yakin ingin menghapus?</h3>
		<a href="javascript:void();"><ion-icon class="close-toggle" name="close-outline"></ion-icon></a>
	</div>
	<p class="name"></p>
	<button id="delete-kategori" type="button">Delete</button>
</div>
<script>
	$(document).ready(function() {
		$('#clearKategori').click(function() {
			$('#updateDataKategori').attr('id', 'saveDataKategori');
			$('.titleForm').html('Tambah kategori');
			$('#nama').val('');
			$('#btnUpdate').hide();
			$('#btnSave').show();
			$(this).hide();
		});
	});
</script>