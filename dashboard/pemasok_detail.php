<?php
    require_once 'core/init.php';

    if(!isset($_SESSION['username'])){
        header('location: ../index.php');            
    }

    if($_SESSION['username']!="admin"){
        header('location: ../index.php');                    
    }  
    $id = $_GET['id'];

    require_once 'view/header.php';    

    $data = detail_pemasok($id);

    while ($row = mysqli_fetch_array($data)){      
?>

<br>
<br>
<br>
    <div class="container">
        <div class="row no-gutters">        
            <h3>Detail Pemasok</h3>
            <table class="table table-hover">
                    <tr>
                        <td>ID Pemasok</td>
                        <td><?= $row['id_pemasok'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Pemasok</td>
                        <td><?= $row['nama_pemasok'] ?></td>
                    </tr>
                    <tr>
                        <td>Barang</td>
                        <td><?= $row['barang'] ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><?= $row['alamat'] ?></td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td><?= $row['telepon'] ?></td>
                    </tr>
                <? } ?>
            </table>
        </div>
    </div>

<div class="container">
    <div class="row no-gutters justify-content-end my-3 mr-3">
        <button type="button" class="btn btn-outline-secondary"
        onclick="if(confirm('Apakah kamu yakin ingin menghapus barang ini?')){
                 location.href='pemasok_hapus.php?id=<?= $id ?>'
                 }">
         Hapus
        </button>
        <a href="pemasok_edit.php?id=<?= $id ?>" class="btn btn-secondary mx-1">Edit</a>
    </div>
</div>

<?php require_once 'view/footer.php' ?>