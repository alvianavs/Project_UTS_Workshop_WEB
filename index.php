<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0;">
	<title>UTS | Garden Center</title>
	<link rel=stylesheet href="assets/css/main.css">
</head>
<body>
	<div class="flash-message success" id="message" style="display: none;">
		<ion-icon name="notifications"></ion-icon>
		<span></span>
	</div>
	<div class="container">
		<div class="navigation">
			<ul>
				<li>
					<a href="">
						<span class="icon"><ion-icon name="rose"></ion-icon></span>
						<span class="title">Garden Center</span>
					</a>
				</li>
				<li>
					<a href="#" class="nav-menu" id="dashboard">
						<span class="icon"><ion-icon name="home-outline"></ion-icon></span>
						<span class="title">Dashboard</span>
					</a>
				</li>
				<li>
					<a href="#" class="nav-menu" id="customers">
						<span class="icon"><ion-icon name="people-outline"></ion-icon></span>
						<span class="title">Customers</span>
					</a>
				</li>
				<li>
					<a href="#" class="nav-menu" id="transaksi">
						<span class="icon"><ion-icon name="calendar-outline"></ion-icon></span>
						<span class="title">Transaksi</span>
					</a>
				</li>
				<li>
					<a href="#" class="nav-menu" id="products">
						<span class="icon"><ion-icon name="leaf-outline"></ion-icon></span>
						<span class="title">Produk tanaman</span>
					</a>
				</li>
				<li class="kategori">
					<a href="#" class="nav-menu" id="kategori">
						<span class="icon"><ion-icon name="list-outline"></ion-icon></span>
						<span class="title">Kategori</span>
					</a>
				</li>
				<li>
					<a href="#">
						<span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
						<span class="title">Log Out</span>
					</a>
				</li>
			</ul>
		</div>

		<!-- main menu -->
		<div class="main">
			<div class="topbar">
				<div class="toggle" id="toggle">
					<ion-icon class="show-toggle" name="menu-outline"></ion-icon>
					<ion-icon class="close-toggle" name="close-outline" style="display: none;"></ion-icon>
				</div>
				<div class="notification">
					<a href="#"><ion-icon name="notifications"></ion-icon>	</a>
				</div>
				<div class="user">
					<img src="assets/img/foto.jpg" alt="user.jpg">
				</div>
			</div>

			<!-- Halaman -->
			<div id="page-file">
				
			</div>

		</div>
	</div>


	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="assets/js/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
	<script src="assets/js/main.js"></script>
	<script>
		$(document).ready(function() {

			var halaman = getCookie("halaman");
			if (halaman == "") {
				setCookie("halaman", "dashboard.php", 30);
				$('#page-file').load(getCookie("halaman"));
			} else {
				$('#page-file').load(getCookie("halaman"));
			}

			$('.nav-menu').click(function(){
				var menu = $(this).attr('id');
				setCookie("halaman", menu + ".php", 30);
				$('#page-file').load(getCookie("halaman"));
			});

			$('.toggle').on('click', function() {
				$('.navigation').toggleClass('active');
				$('.main').toggleClass('active');
				if($('.navigation').hasClass('active')) {
					$('.show-toggle').hide();
					$('.close-toggle').show();
				} else {
					$('.show-toggle').show();
					$('.close-toggle').hide();
				}
			});

			$('.navigation li').click(function() {
				$(this).addClass('hovered');
			});

			let list = document.querySelectorAll('.navigation li');
			function activeLink() {
				list.forEach((item) => 
					item.classList.remove('hovered'));
				this.classList.add('hovered');
			}
			list.forEach((item) => item.addEventListener('mouseover', activeLink));
		});

		function setCookie(cname,cvalue,exdays) {
			var d = new Date();
			d.setTime(d.getTime() + (30*24*60*60*1000));
			var expires = "expires=" + d.toGMTString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}

		function getCookie(cname) {
			var name = cname + "=";
			var decodedCookie = decodeURIComponent(document.cookie);
			var ca = decodedCookie.split(';');
			for(var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return "";
		}
		
	</script>
</body>
</html>