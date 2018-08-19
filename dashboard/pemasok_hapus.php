<?php require_once 'core/init.php' ?>

<?
    if($_SESSION['username']!="admin"){
        header('location: ../index.php');                    
    }  

    $id = $_GET['id']; 

    $query = "DELETE FROM pemasok WHERE id_pemasok='$id'";
    $data = mysqli_query($link, $query) or die("gagal menampilkan data");
    header('location:pemasok.php');
?>