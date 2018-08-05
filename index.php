<!DOCTYPE html>
<html>
<head>

<title>Aplikasi Penjualan Jualy</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="dashboard\assets\bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" href="dashboard\main.css">	
    <script src="dashboard\assets\bootstrap\js\jquery-3.3.1.min.js"></script>
    <script src="dashboard\assets\bootstrap\js\bootstrap.min.js"></script>
    <script src="dashboard\assets\bootstrap\js\script.js"></script>

    <?
		session_start();
        date_default_timezone_set('Asia/Jakarta');
    ?>

    <style>
    .card-wrapper{
        margin-top: 150px;
    }
    
    </style>
</head>

		<?php 
		// if(isset($_POST['submit'])){
        //     $username = $_POST['username'];
        //     $password = $_POST['password'];
		// }
		?>


<body class="my-login-page">

	<?

	if(isset($_SESSION['username'])){
		header('Location: dashboard/index.php');
	}
	
	?>

	<section class="h-100">
		<div class="container h-100">

				<?php 
			if(isset($_GET['pesan'])){
				if($_GET['pesan'] == "gagal"){
					echo "<div style='margin-top:55px; margin-bottom:-55px' class='alert alert-danger' role='alert'>Mohon maaf, username atau password yang kamu masukkan tidak sesuai dengan data Jualy! Mohon masukkan username dan password yang benar!</div>";
				}
			}
			?>


			<div id="login-form-jualy" class="row justify-content-center align-items-center h-100">
				<div class="card-wrapper">
					<!-- <div class="brand">
						<img src="img/logo.jpg">
					</div> -->
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<form action="validate.php" method="POST">
							 
								<div class="form-group">
									<label for="username">ID Pegawai</label>
									<input id="username" type="text" class="form-control" name="username" value="" required autofocus>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								</div>
								
								<div class="form-group no-margin">
									<button type="submit" class="btn btn-secondary btn-block">
										Masuk
									</button>
									<div class="teks_ganti_user" id="sebagai_admin">
				                        Masuk sebagai admin?
                				    </div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>