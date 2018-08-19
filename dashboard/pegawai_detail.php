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
    
    $data = getLimitWhere('pegawai', 'id_pegawai', $id);

    while ($row = mysqli_fetch_array($data)){
?>

<br>
<br>
<br>
    <div class="container">
        <div class="row no-gutters">        
            <h3>Detail Pegawai</h3>
            <table class="table table-hover">
                    <tr>
                        <td>ID Pegawai</td>
                        <td><?= $row['id_pegawai'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Pegawai</td>
                        <td><?= $row['nama_pegawai'] ?></td>
                    </tr>
                    <tr>
                        <td>Shift</td>
                        <td><?= $row['shift'] ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><?= $row['alamat'] ?></td>
                    </tr>
                    <tr>
                        <td>No Handphone</td>
                        <td><?= $row['no_hape'] ?></td>
                    </tr>
                <? } ?>
            </table>
        </div>
    </div>

<div class="container">
    <div class="row no-gutters justify-content-end my-3 mr-3">
        <button type="button" class="btn btn-outline-secondary"
        onclick="if(confirm('Apakah kamu yakin ingin menghapus barang ini?')){
                 location.href='pegawai_hapus.php?id=<?= $id ?>'
                 }">
         Hapus
        </button>
        <a href="pegawai_edit.php?id=<?= $id ?>" class="btn btn-secondary mx-1">Edit</a>
    </div>
</div>

<?php require_once 'view/footer.php' ?>