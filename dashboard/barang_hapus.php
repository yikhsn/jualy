<?php
    require_once 'core/init.php';

    if(!isset($_SESSION['username'])){
        header('location: ../index.php');
    }

    $id = $_GET['kode']; 

    $query = "DELETE FROM barang WHERE kode_barang='$id'";
    $data = mysqli_query($link, $query) or die("gagal menampilkan data");
    header('location:barang.php');
?>