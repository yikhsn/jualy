<!DOCTYPE html>
<html lang="en">
<head>

  <title>Aplikasi Penjualan Jualy</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="assets\bootstrap\css\bootstrap.min.css">
	<link rel="stylesheet" href="assets\bootstrap\css\daterangepicker.css">	
	<link rel="stylesheet" href="main.css">	
  	<script src="assets\bootstrap\js\jquery-3.3.1.min.js"></script>
  	<script src="assets\bootstrap\js\moment.min.js"></script>
  	<script src="assets\bootstrap\js\daterangepicker.min.js"></script>	  	  
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
	<script src="assets\bootstrap\js\bootstrap.min.js"></script>
	<script src="assets\bootstrap\js\script.js"></script>

	<?
		require_once 'core/init.php';

		date_default_timezone_set('Asia/Jakarta');
		
		if($_SESSION['username']=="admin"){
			$username = "Admin";
		}
		else {
			$kode_username = $_SESSION['username'];
			$hasil_ambil = ambil_nama_pegawai($kode_username);
			$data_username = mysqli_fetch_assoc($hasil_ambil);
			$username = $data_username['nama_pegawai'];
		}		

		$now = date('H');

		if ($now >= 5 && $now < 13){
			$waktu = 'Pagi';
		}
		elseif ($now >= 13 && $now < 21){
			$waktu = 'Siang';
		}
		elseif ($now >= 21 || $now < 5){
			$waktu = 'Malam';
		}
	?>

</head>

<body>

<div class="row no-gutters">
	<div class="col-12">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-jualy">
			<a class="navbar-brand text-white" href="/jualy/">Jualy</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#target-menu" aria-controls="target-menu" aria-expanded="false" aria-lable="Toggle Notification">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="navbar-collapse collapse justify-content-end" id="target-menu">
				<ul  class="nav navbar-nav">						
					<li class="nav-item">
						<a class="text-light nav-link" href="#">
						<?= $username;?>
						<span id="icon-menu">
								<img style="width: 30px; height:auto;" src="assets/img/user.png">
							</span>
					</a>
					</li>
				</ul>
			</div>

		</nav>
	</div>
</div>

<div class="body-jualy">
	<div class="row no-gutters">
		<div class="col-2 bg-dark">
			<div id="nav-jualy">
				<div id="side-nav">
					<div class="list-group">
						<div class="list-group-item bg-dark"></div>
						<a class="list-group-item list-group-item-action bg-dark text-white" href="index.php">
							<span id="icon-menu">
								<img style="width: 20px; height:auto;" src="assets/img/dashboard.png">
							</span>
							Dashboard
						</a>
						<a class="list-group-item list-group-item-action bg-dark text-white" href="penjualan.php">
							<span id="icon-menu">
								<img style="width: 20px; height:auto;" src="assets/img/penjualan.png">
							</span>
							Data Penjualan
						</a>
						<a class="list-group-item list-group-item-action bg-dark text-white" href="barang.php">
							<span id="icon-menu">
								<img style="width: 20px; height:auto;" src="assets/img/barang.png">
							</span>
							Data Barang
						</a>
						<a class="list-group-item list-group-item-action bg-dark text-white" href="pembeli.php">
							<span id="icon-menu">
								<img style="width: 20px; height:auto;" src="assets/img/pembeli.png">
							</span>
							Data Pelanggan
						</a>
							<?
								if($_SESSION['username']=="admin"){
							?>
						<a class="list-group-item list-group-item-action bg-dark text-white" href="pemasok.php">
							<span id="icon-menu">
								<img style="width: 20px; height:auto;" src="assets/img/pemasok.png">
							</span>
							Data Penyuplai
						</a>
						<a class="list-group-item list-group-item-action bg-dark text-white" href="suplai.php">
						<span id="icon-menu">
								<img style="width: 20px; height:auto;" src="assets/img/pemasokan.png">
							</span>
							Data Pemasokan
						</a>
						<a class="list-group-item list-group-item-action bg-dark text-white" href="pegawai.php">
							<span id="icon-menu">
								<img style="width: 20px; height:auto;" src="assets/img/pegawai_pria.png">
							</span>
							Data Pegawai
						</a>
							<?			
								} 
							?>		
						<a class="list-group-item list-group-item-action bg-dark text-white" href="../logout.php">
							<span id="icon-menu">
								<img style="width: 20px; height:auto;" src="assets/img/logout.png">
							</span>
							Logout
						</a>
						<div class="list-group-item bg-dark"></div>				
					</div>
				</div>
			</div>		
		</div>

		<div class="col-10">
			<div class="content-jual">
		