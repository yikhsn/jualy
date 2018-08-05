<?php
    require_once 'core/init.php';

    if(!isset($_SESSION['username'])){
        header('location: ../index.php');
    }

    require_once 'view/header.php';    

    $id = $_GET['id'];
    $data = detail_pembeli($id);

    while ($row = mysqli_fetch_array($data)){
?>

<br>
<br>
<br>

    <div class="container">
        <div class="row no-gutters">        
            <h3>Detail Pelanggan : <?= $row['nama'] ?></h3>
            <table class="table table-hover">
                    <tr>
                        <td>ID Pembeli</td>
                        <td><?= $row['id_pembeli'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Pembeli</td>
                        <td><?= $row['nama'] ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><?= $row['alamat'] ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                    </tr>
                <? } ?>
            </table>
        </div>
    </div>

<div class="container">
    <div class="row no-gutters justify-content-end my-3 mr-3">
        <button type="button" class="btn btn-outline-secondary"
        onclick="if(confirm('Apakah kamu yakin ingin menghapus data pembeli ini?')){
                 location.href='pembeli_hapus.php?id=<?= $id ?>'
                 }">
         Hapus
        </button>
        <a href="pembeli_edit.php?id=<?= $id ?>" class="btn btn-secondary mx-1">Edit</a>
    </div>
</div>

<?php require_once 'view/footer.php' ?>