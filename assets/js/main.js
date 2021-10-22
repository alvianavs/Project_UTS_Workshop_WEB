$(document).ready(function() {

	// Insert data customer
	$(document).on('submit', '#saveDataCustomers', function(e){
		e.preventDefault();
		$.ajax({
			method: 'POST',
			url: 'crud/saveCustomer.php',
			data: $(this).serialize(),
			success: function(response){
				$("#message span").html(response);
				$('#message').fadeIn('fast').delay(2000).fadeOut(500);
				$('#dataCustomers').load("crud/showCustomers.php");
				$('#saveDataCustomers').find('input[type="text"]').val('');
				$('input[type="radio"]').prop('checked', false);
				$('#chartGender').load('charts/chart-gender.php');
				if (response == 'Succesfully! Data customer berhasil ditambahkan.') {
					$('html, body').animate({
						scrollTop: $("#dataCustomers").offset().top
					}, 1500);
				}
			}
		});
	});

	// Delete data customer
	var dataId, name;
	$(document).on('click', '#btnDelCustomer', function() {
		dataId = $(this).data('id');
		name = $(this).data('name');
		$('.name').html(name);
		$('.popup_box').show();
	});
	$(document).on('click', '#delete-customer', function() {
		$('.popup_box').fadeOut();
		$.get('crud/delCustomer.php?id=' + dataId, function(response) {
			$("#message span").html(response);
			$('#message').fadeIn('fast').delay(2000).fadeOut(500);
			$('#dataCustomers').load("crud/showCustomers.php");
			$('#chartGender').load('charts/chart-gender.php');
		});
	});
	$(document).on('click', '.close-toggle', function() {
		$('.popup_box').fadeOut();
	});

	// Edit data customer
	$(document).on('click', '#btnEditCustomer', function() {
		dataId = $(this).data("id");
		$('#saveDataCustomers').attr('id', 'updateDataCustomer');
		$('.titleForm').html('Update customer');
		$(window).scrollTop(0);
		$('#btnUpdate').show();
		$('#btnSave').hide();
		$('#clearCustomer').show();
		$.ajax({
			url: 'crud/showCustomers.php',
			type: 'GET',
			data: {id: dataId},
			dataType: 'json',
			success: function(response) {
				$('#nama').val(response.nama);
				$('#nowa').val(response.no_wa);
				$('#alamat').val(response.alamat);
				$("input[name='gender'][value=" + response.gender + "]").prop('checked', true);
			}
		});
	});

	$(document).on('submit', '#updateDataCustomer', function(e){
		e.preventDefault();
		$('#id').val(dataId);
		$.ajax({
			method: 'POST',
			url: 'crud/updateCustomer.php',
			data: $(this).serialize(),
			success: function(response){
				$("#message span").html(response);
				$('#message').fadeIn('fast').delay(2000).fadeOut(500);
				$('#dataCustomers').load("crud/showCustomers.php");
				$('#updateDataCustomer').find('input[type="text"]').val('');
				$('input[type="radio"]').prop('checked', false);
				$('#chartGender').load('charts/chart-gender.php');
				$('#clearCustomer').trigger('click');
				if (response == 'Succesfully! Data customer berhasil diupdate.') {
					$('html, body').animate({
						scrollTop: $("#dataCustomers").offset().top
					}, 1500);
				}
			}
		});
	});

	// Insert data kategori
	$(document).on('submit', '#saveDataKategori', function(e){
		e.preventDefault();
		$.ajax({
			method: 'POST',
			url: 'crud/saveKategori.php',
			data: $(this).serialize(),
			success: function(response){
				$("#message span").html(response);
				$('#message').fadeIn('fast').delay(2000).fadeOut(500);
				$('#dataKategori').load("crud/showKategori.php");
				$('#nama').val('');
			}
		});
	});

	// Edit data kategori
	var idKategori;
	$(document).on('click', '#btnEditKategori', function() {
		idKategori = $(this).data("id");
		$('#saveDataKategori').attr('id', 'updateDataKategori');
		$('.titleForm').html('Update kategori');
		$('#btnUpdate').show();
		$('#btnSave').hide();
		$('#clearKategori').show();
		$.ajax({
			url: 'crud/showKategori.php',
			type: 'GET',
			data: {id: idKategori},
			dataType: 'json',
			success: function(response) {
				$('#nama').val(response.nama_kategori);
			}
		});
	});

	$(document).on('submit', '#updateDataKategori', function(e){
		e.preventDefault();
		$('#id').val(idKategori);
		$.ajax({
			method: 'POST',
			url: 'crud/updateKategori.php',
			data: $(this).serialize(),
			success: function(response){
				$("#message span").html(response);
				$('#message').fadeIn('fast').delay(2000).fadeOut(500);
				$('#nama').val('');
				$('#dataKategori').load("crud/showKategori.php");
				$('#clearKategori').trigger('click');
			}
		});
	});

	// Delete data kategori
	$(document).on('click', '#btnDelKategori', function() {
		idKategori = $(this).data('id');
		name = $(this).data('name');
		$('.name').html(name);
		$('.popup_box').show();
	});
	$(document).on('click', '#delete-kategori', function(){
		$('.popup_box').fadeOut();
		$.get('crud/delKategori.php?id=' + idKategori, function(response) {
			$("#message span").html(response);
			$('#message').fadeIn('fast').delay(2000).fadeOut(500);
			$('#dataKategori').load("crud/showKategori.php");
		});
	});


	// Insert data product
	$(document).on('submit', '#saveDataProduct', function(e){
		e.preventDefault();
		$.ajax({
			url: "crud/saveProduct.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(response){
				$("#message span").html(response);
				$('#message').fadeIn('fast').delay(2000).fadeOut(500);
				$('#dataProducts').load("crud/showProducts.php");
				$('#chartKategori').load('charts/chart-kategori.php');
				$('#clearProduct').trigger('click');
				if (response == 'Successfully! Data product berhasil ditambahkan.') {
					$('html, body').animate({
						scrollTop: $("#dataProducts").offset().top
					}, 1500);
				}
			}
		});
	});

	// Delete data product
	var idProduct, name, filePath;
	$(document).on('click', '#btnDelProduct', function() {
		idProduct = $(this).data('id');
		name = $(this).data('name');
		filePath = $(this).data('file');
		$('.name').html(name);
		$('#popup-delete').show();
	});
	$(document).on('click', '#delete-product', function(){
		$('#popup-delete').fadeOut();
		$.get('crud/delProduct.php?id=' + idProduct + '&path=' + filePath, function(response) {
			$("#message span").html(response);
			$('#message').fadeIn('fast').delay(2000).fadeOut(500);
			$('#dataProducts').load("crud/showProducts.php");
			$('#chartKategori').load('charts/chart-kategori.php');
		});
	});

	// Edit data Product
	$(document).on('click', '#btnEditProduct', function() {
		idProduct = $(this).data("id");
		$('#saveDataProduct').attr('id', 'updateDataProduct');
		$('.titleForm').html('Update product');
		$('#btnUpdate').show();
		$('#btnSave').hide();
		$('#clearProduct').show();
		$('.form-control.input-image').hide();
		$('.form-control.prev-image').hide();
		$.ajax({
			url: 'crud/showProducts.php',
			type: 'GET',
			data: {id: idProduct},
			dataType: 'json',
			success: function(response) {
				$('#nama').val(response.nama_produk);
				$('#kondisi').val(response.kondisi);
				$('#harga').val(response.harga);
				$('#stok').val(response.stok);
				$('#kategori option[value="'+response.kategori_id+'"]').prop('selected', true);
			}
		});
	});

	$(document).on('submit', '#updateDataProduct', function(e){
		e.preventDefault();
		$('#id').val(idProduct);
		$.ajax({
			method: 'POST',
			url: 'crud/updateProduct.php',
			data: $(this).serialize(),
			success: function(response){
				$("#message span").html(response);
				$('#message').fadeIn('fast').delay(2000).fadeOut(500);
				$('#dataProducts').load("crud/showProducts.php");
				$('#chartKategori').load('charts/chart-kategori.php');
				$('#clearProduct').trigger('click');
				if (response == 'Succesfully! Data product berhasil diupdate.') {
					$('html, body').animate({
						scrollTop: $("#dataProducts").offset().top
					}, 1500);
				}
			}
		});
	});

	// Update Image Product
	$(document).on('submit', '#updateImage', function(e){
		e.preventDefault();
		$.ajax({
			method: 'POST',
			url: 'crud/updateImage.php',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(response){
				$("#message span").html(response);
				$('#message').fadeIn('fast').delay(2000).fadeOut(500);
				$('#dataProducts').load("crud/showProducts.php");
				$('#popup-img').fadeOut();
				$('#file-chosen-update').html('No file chosen');
			}
		});
	});
	
	// Show detail customer in transaksi
	$(document).on('change', '#customers', function() {
		var idCustomer = $(this).val();
		$.ajax({
			url: 'crud/showCustomers.php',
			type: 'GET',
			data: {id: idCustomer},
			dataType: 'json',
			success: function(response) {
				$('#nama-customer').html(response.nama);
				$('#nowa-customer').html('<ion-icon name="logo-whatsapp"></ion-icon> ' + response.no_wa).attr('href', 'https://wa.me/' + response.no_wa);
				$('#alamat-customer').html(response.alamat);
				$('#gender-customer').html(response.gender);
			}
		});
	});

	// Show detail products in transaksi
	$(document).on('change', '#products', function() {
		var idProduct = $(this).val();
		$.ajax({
			url: 'crud/showProducts.php',
			type: 'GET',
			data: {id: idProduct},
			dataType: 'json',
			success: function(response) {
				$('#nama-product').html(response.nama_produk);
				$('#harga').html('Rp. ' + response.harga);
				$('#kondisi').html(response.kondisi);
				$('#stok').html(response.stok);
				$('#img-product').attr('src', 'assets/img/'+response.image);
			}
		});
	});

	// Get total harga
	$(document).on('keyup', '#jumlah', function() {
		var harga = $('#harga').html();
		harga = harga.match(/\d+/);
		var total = $(this).val() * harga[0];
		$('#total').val(total);
	});


	// Submit transaksi
	$(document).on('submit', '#saveTransaksi', function(e){
		e.preventDefault();
		$.ajax({
			url: 'crud/saveTransaksi.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function(response) {
				$("#message span").html(response);
				$('#message').fadeIn('fast').delay(2000).fadeOut(500);
				$('#dataTransaksi').load('crud/showTransaksi.php');
				$('#clearTransaksi').trigger('click');
				if (response == 'Succesfully! Data transaksi berhasil ditambahkan') {
					$('html, body').animate({
						scrollTop: $("#dataTransaksi").offset().top
					}, 1500);
				}
			}
		});
	});


	// Edit data Transaksi
	var idTransaksi;
	$(document).on('click', '#btnEditTransaksi', function() {
		idTransaksi = $(this).data("id");
		$('#saveTransaksi').attr('id', 'updateTransaksi');
		$('.titleForm').html('Update product');
		$('#btnUpdate').show();
		$('#btnSave').hide();
		$('#clearTransaksi').show();
		$.ajax({
			url: 'crud/showTransaksi.php',
			type: 'GET',
			data: {id: idTransaksi},
			dataType: 'json',
			success: function(response) {
				$('#jumlah').val(response.jumlah);
				$('#total').val(response.total_harga);
				$('#tanggal').val(response.tanggal);
				$('#stok').val(response.stok);
				$("input[name='status'][value=" + response.status + "]").prop('checked', true);
				$('#customers option[value="'+response.customer_id+'"]').prop('selected', true);
				$('#products option[value="'+response.product_id+'"]').prop('selected', true);
				$.ajax({
					url: 'crud/showCustomers.php',
					type: 'GET',
					data: {id: response.customer_id},
					dataType: 'json',
					success: function(response) {
						$('#nama-customer').html(response.nama);
						$('#nowa-customer').html('<ion-icon name="logo-whatsapp"></ion-icon> ' + response.no_wa).attr('href', 'https://wa.me/' + response.no_wa);
						$('#alamat-customer').html(response.alamat);
						$('#gender-customer').html(response.gender);
					}
				});
				$.ajax({
					url: 'crud/showProducts.php',
					type: 'GET',
					data: {id: response.product_id},
					dataType: 'json',
					success: function(response) {
						$('#nama-product').html(response.nama_produk);
						$('#harga').html('Rp. ' + response.harga);
						$('#kondisi').html(response.kondisi);
						$('#stok').html(response.stok);
						$('#img-product').attr('src', 'assets/img/'+response.image);
					}
				});
			}
		});
	});


	$(document).on('submit', '#updateTransaksi', function(e){
		e.preventDefault();
		$('#id').val(idTransaksi);
		$.ajax({
			method: 'POST',
			url: 'crud/updateTransaksi.php',
			data: $(this).serialize(),
			success: function(response){
				$("#message span").html(response);
				$('#message').fadeIn('fast').delay(2000).fadeOut(500);
				$('#dataTransaksi').load("crud/showTransaksi.php");
				$('#clearTransaksi').trigger('click');
				if (response == 'Succesfully! Data transaksi berhasil diupdate.') {
					$('html, body').animate({
						scrollTop: $("#dataTransaksi").offset().top
					}, 1500);
				}
			}
		});
	});

	// Delete data transaksi
	$(document).on('click', '#btnDelTransaksi', function() {
		idTransaksi = $(this).data('id');
		var name = $(this).data('name');
		var product = $(this).data('product');
		var tanggal = $(this).data('tanggal');
		$('.name').html('Nama customer: '+name);
		$('.product').html('Nama produk: '+product);
		$('.tanggal').html('Tanggal: '+tanggal);
		$('#popup-delete').show();
	});
	$(document).on('click', '#delete-transaksi', function(){
		$('#popup-delete').fadeOut();
		$.get('crud/delTransaksi.php?id=' + idTransaksi, function(response) {
			$("#message span").html(response);
			$('#message').fadeIn('fast').delay(2000).fadeOut(500);
			$('#dataTransaksi').load("crud/showTransaksi.php");
		});
	});



});	