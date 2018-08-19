<?php 

session_start();

require 'dashboard/functions/act.php';
require 'dashboard/functions/db.php';

$password=$_POST['password'];

$query = "SELECT * FROM admin WHERE password='$password'";

    if($result = mysqli_query($link, $query)){
        if(mysqli_num_rows($result) != 0){
			$_SESSION['username']="admin";
			header("location:dashboard/index.php");
        }
        else{
			header("location:index.php?pesan=gagal")or die(mysqli_error());
		}
	}
 ?>