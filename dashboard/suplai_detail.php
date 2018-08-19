<?php 
    require_once 'core/init.php';

    if($_SESSION['username']!="admin"){
        header('location: ../index.php');                    
    }

    $id = $_GET['kode_suplai'];
    
    require_once 'view/header.php';
         
    $data = getWhere('suplai', 'kode_suplai', $id);

    while ($row = mysqli_fetch_array($data)){
        
?>
<br>
<br>
<br>
    <div class="container">
        <div class="row no-gutters">        
            <h3>Detail Pemasokan</h3>
            <table class="table table-hover">
                    <tr>
                        <td>Kode Suplai</td>
                        <td><?= $row['kode_suplai'] ?></td>
                    </tr>
                    <tr>
                        <td>ID Pemasok</td>
                        <td><?= $row['id_pemasok'] ?></td>
                    </tr>
                    <tr>
                        <td>Waktu</td>
                        <td><?= $row['waktu'] ?></td>
                    </tr>
                    <tr>
                        <td>Kode Barang</td>
                        <td><?= $row['kode_barang'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Barang</td>
                        <td><?= $row['nama_barang'] ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah Barang</td>
                       <td><?= $row['jumlah'] ?></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><?= rupiah($row['harga']) ?></td>
                    </tr>
                    <tr>
                        <td>Total Harga</td>
                        <td><?= rupiah($row['total_harga']) ?></td>
                    </tr>
                <? } ?>
            </table>
        </div>
    </div>

<div class="container">
    <div class="row no-gutters justify-content-end my-3 mr-3">
        <button type="button" class="btn btn-outline-secondary"
        onclick="if(confirm('Apakah kamu yakin ingin menghapus data transaksi ini?')){
                 location.href='suplai_hapus.php?kode_suplai=<?= $id ?>'
                 }">
         Hapus
        </button>
        <a href="suplai_edit.php?kode_suplai=<?= $id ?>" class="btn btn-secondary mx-1">Edit</a>
    </div>
</div>

<?php require_once 'view/footer.php' ?>