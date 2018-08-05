<?php require_once 'core/init.php' ?>

<? 
    if(!isset($_SESSION['username'])){
        header('location: ../index.php');            
    }

    if($_SESSION['username']!="admin"){
        header('location: ../index.php');
    }  

    $id = $_GET['kode_suplai']; 

    $query = "DELETE FROM suplai WHERE kode_suplai='$id'";
    $data = mysqli_query($link, $query) or die("gagal menampilkan data");
    header('location:suplai.php');
?>