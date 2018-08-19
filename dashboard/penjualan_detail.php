<?php
    require_once 'core/init.php';

    if(!isset($_SESSION['username'])){
        header('location: ../index.php');
    }

    $id = $_GET['kode_transaksi'];

    $data = getLimitWhere('penjualan', 'kode_transaksi', $id);

    require_once 'view/header.php';    

    while ($row = mysqli_fetch_array($data)){
?>

<br>
<br>
<br>
    <div class="container">
        <div class="row no-gutters">        
            <h3>Detail Transaksi : <?= $id; ?></h3>
            <table class="table table-hover">
                    <tr>
                        <td>Kode Transaksi</td>
                        <td><?= $row['kode_transaksi'] ?></td>
                    </tr>
                    <tr>
                        <td>ID Pembeli</td>
                        <td><?= $row['id_pembeli'] ?></td>
                    </tr>
                    <tr>
                        <td>Waktu</td>
                        <td><?= $row['waktu'] ?></td>
                    </tr>
                    <tr>
                        <td>Barang</td>
                        <td><?= $row['kode_barang'] ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah Barang</td>
                       <td><?= $row['jumlah'] ?></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><?= $row['harga'] ?></td>
                    </tr>
                    <tr>
                        <td>Total Harga</td>
                        <td><?= $row['total_harga'] ?></td>
                    </tr>
                <? } ?>
            </table>
        </div>
    </div>

<div class="container">
    <div class="row no-gutters justify-content-end my-3 mr-3">
        <a href="penjualan_edit.php?kode_transaksi=<?= $id ?>" class="btn btn-secondary mx-1">Edit</a>
    </div>
</div>

<?php require_once 'view/footer.php' ?>