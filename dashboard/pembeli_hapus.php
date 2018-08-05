<?php require_once 'core/init.php' ?>

<? 
    if(!isset($_SESSION['username'])){
        header('location: ../index.php');
    }
    
    $id = $_GET['id']; 

    $query = "DELETE FROM pembeli WHERE id_pembeli='$id'";
    $data = mysqli_query($link, $query) or die("gagal menampilkan data");
    header('location:pembeli.php');
?>