<?php 

session_start();

require 'dashboard/functions/act.php';
require 'dashboard/functions/db.php';

$username=$_POST['username'];
$password=$_POST['password'];

$query = "SELECT * FROM pegawai WHERE id_pegawai='$username' and password='$password'";

    if($result = mysqli_query($link, $query)){
        if(mysqli_num_rows($result) != 0){
			$_SESSION['username']= $username;
			header("location:dashboard/index.php");
        }
        else{
			header("location:index.php?pesan=gagal")or die(mysqli_error());
		}
	}
 ?>