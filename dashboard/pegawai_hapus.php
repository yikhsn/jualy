<?php 
    require_once 'core/init.php';


    if($_SESSION['username']!="admin"){
        header('location: ../index.php');                    
    }
    
    $id = $_GET['id']; 

    $query = "DELETE FROM pegawai WHERE id_pegawai='$id'";
    $data = mysqli_query($link, $query) or die("gagal menampilkan data");
    header('location:pegawai.php');
?>