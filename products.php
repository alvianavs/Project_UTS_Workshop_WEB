<div class="recent">
	<div class="cardDetails">
		<div class="cardHeader">
			<h2 class="titleForm">Tambah products</h2>
			<button id="clearProduct" class="btnCancel" style="display: none;"><ion-icon name="close"></ion-icon></button>
		</div>
		<form id="saveDataProduct" enctype="multipart/form-data">
			<input type="hidden" name="id" id="id" value="">
			<div class="form-control">
				<input type="text" class="form-input" name="nama" id="nama" placeholder="Nama produk..">
				<span class="focus-border"></span>
			</div>
			<div class="form-control">
				<input type="text" class="form-input" name="kondisi" id="kondisi" placeholder="Kondisi..">
				<span class="focus-border"></span>
			</div>
			<div class="form-control row">
				<div>
					<input type="text" class="form-input" name="harga" id="harga" placeholder="Harga..">
					<span class="focus-border"></span>	
				</div>
				<div>
					<input type="text" class="form-input" name="stok" id="stok" placeholder="Jumlah stok..">
					<span class="focus-border"></span>	
				</div>
			</div>
			<div class="form-control">
				<div class="select">
					<?php
					include 'crud/config.php';
					$execute = mysqli_query($conn, "select * from kategori_produk");
					?>
					<select name="kategori" id="kategori">
						<option value="0" id="selected-option" selected>Pilih kategori</option>
						<?php
						while($row = mysqli_fetch_array($execute)) { ?>
							<option value="<?php echo $row['id'] ?>"><?php echo $row['nama_kategori'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-control input-image">
				<input id="uploadImage" type="file" accept="image/*" name="image" onchange="getImagePreview(event)" hidden />
				<label for="uploadImage">Choose File</label>
				<span id="file-chosen">No file chosen</span>
			</div>
			<div class="form-control prev-image">
				<div id="preview"><img src="assets/img/filed.png" width="180" />
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
			<h3>Kategori <a href="#" id="goToTable"><ion-icon name="caret-down"></ion-icon></a></h3><br>
			<div id="chartKategori"><?php include 'charts/chart-kategori.php' ?></div>
		</div>
	</div>
</div>
<div class="details">
	<div class="cardDetails">
		<div class="cardHeader">
			<h2>Products</h2>
			<!-- <a href="#" class="btn">View all</a> -->
		</div>
		<div class="popup_box" id="popup-img">
			<div class="title">
				<h2>Image</h2>
				<a href="javascript:void();"><ion-icon class="close-toggle" name="close-outline"></ion-icon></a>
			</div>
			<p class="name"></p>
			<img src="" id="product-img" style="width: 240px;">
			<form id="updateImage" enctype="multipart/form-data">
				<input type="hidden" name="idproduct" id="idproduct" value="">
				<input type="hidden" name="oldImg" id="oldImg" value="">
				<div class="form-control input-image">
					<input type="file" id="inputUpdateImg" name="inputUpdateImg" hidden />
					<label for="inputUpdateImg">Choose File</label>
					<span id="file-chosen-update" style="color: white;">No file chosen</span>
				</div>
				<div class="form-control">
					<button type="submit" class="btn-green">Update</button>
				</div>
			</form>
		</div>
		<table>
			<thead>
				<tr>
					<td>No</td>
					<td>Nama tanaman</td>
					<td>Kondisi</td>
					<td>Harga</td>
					<td>Stok</td>
					<td>Kategori</td>
					<td>Aksi</td>
				</tr>
			</thead>
			<tbody id="dataProducts">
				<?php include 'crud/showProducts.php'; ?>
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
	<button id="delete-product" type="button">Delete</button>
</div>
<script>
	function getImagePreview(event) {
		var image = URL.createObjectURL(event.target.files[0]);
		var imagediv = document.getElementById('preview');
		var newimg = document.createElement('img');
		imagediv.innerHTML = '';
		newimg.src=image;
		newimg.width = "180";
		imagediv.appendChild(newimg);
	}
	$(document).ready(function (e) {
		$('#clearProduct').click(function() {
			$('#updateDataProduct').attr('id', 'saveDataProduct');
			$('.titleForm').html('Tambah product');
			$('#nama').val('');
			$('#kondisi').val('');
			$('#harga').val('');
			$('#stok').val('');
			$("#kategori #selected-option").prop('selected', true);
			$('#file-chosen').html('No file chosen');
			$('.form-control.input-image').show();
			$('.form-control.prev-image').show();
			$('#preview').html('');
			$('#preview').append('<img src="assets/img/filed.png" width="180" />');
			$('#btnUpdate').hide();
			$('#btnSave').show();
			$(this).hide();
		});
		$('#goToTable').click(function() {
			$('html, body').animate({
				scrollTop: $("#dataProducts").offset().top
			}, 1500);
		});
		var img, name;
		$(document).on('click', '#btn-img', function() {
			img = $(this).data('img');
			name = $(this).data('name');
			var id = $(this).data('id');
			$('#oldImg').val(img);
			$('#idproduct').val(id);
			$('.name').html(name);
			$('#product-img').attr("src", "assets/img/"+img);
			$('#popup-img').fadeIn();
		});

		$('#uploadImage').on('change', function() {
			$('#file-chosen').html(this.files[0].name);
		});

		$(document).on('change', '#inputUpdateImg', function() {
			var img = URL.createObjectURL(event.target.files[0]);
			$('#product-img').attr('src', img).width(240);
			$('#file-chosen-update').html(event.target.files[0].name);
		});
	});
</script>