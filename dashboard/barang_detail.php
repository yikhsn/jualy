<?php 
    require_once 'view/header.php';

    if(!isset($_SESSION['username'])){
        header('location: ../index.php');
    }
 
    $kode = $_GET['kode'];
    $data = getLimitWhere('barang', 'kode_barang', $kode);

    while ($row = mysqli_fetch_array($data)){
        $jenis = $row['jenis_brg'];
        $jumlah = $row['jumlah'];
        $sisa = $row['sisa'];
        $terjual = $jumlah - $sisa;

        $persen_terjual = ($terjual * 100) / $jumlah;
        $persen_sisa = ($sisa * 100) / $jumlah;
?>

<br>

<div class="container">
<div class="row">
    <div class="col-3">
        <div class="card border-secondary">
            <div class="card-body text-success">
                <h3 class="card-title text-dark"><?= $row['nama_brg'] ?></h3>
                <div>
                    <? if($jenis == "Makanan") {?>
                        <img id="gambar-barang" style="width:auto; height:113px;"src="assets/img/makanan.jpg" alt="">
                    <?
                    }
                    elseif ($jenis == "Minuman") { 
                    ?>
                        <img id="gambar-barang" style="width:auto; height:113px;"src="assets/img/minuman.png" alt="">
                    <?
                    }
                    else
                    {
                    ?>
                        <img id="gambar-barang" style="width:auto; height:113px;"src="assets/img/rumah_tangga.jpg" alt="">                     
                    <?}?>
                </div>
                <p class="card-text text-dark">Kode Barang : <span class="badge badge-primary"> <?= $row['kode_barang'] ?></span></p>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="card border-secondary">
            <div class="card-body text-success">
                <h5 class="card-title text-dark mb-4">Ringkasan Penjualan</h5>
                <p class="card-text text-dark">Terjual : <?= $terjual ?></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen_terjual?>%">
                        <?= round($persen_terjual) ?>%
                    </div>
                </div>
            
                <br>
            
                <p class="card-text text-dark">Sisa : <?= $sisa ?></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: <?= $persen_sisa?>%">
                        <?= round($persen_sisa) ?>%
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<br>
<br>
<br>
    <div class="container">
        <div class="row no-gutters">        
            <h3>Detail Barang</h3>
            <table class="table table-hover">
                    <tr>
                        <td>Kode Barang</td>
                        <td><?= $row['kode_barang'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Barang</td>
                        <td><?= $row['nama_brg'] ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Barang</td>
                        <td><?= $row['jenis_brg'] ?></td>
                    </tr>
                    <tr>
                        <td>Harga Barang</td>
                        <td><?= rupiah($row['harga_brg']); ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah Barang</td>
                        <td><?= $row['jumlah'] ?></td>
                    </tr>
                    <tr>
                        <td>Sisa Barang</td>
                        <td><?= $row['sisa'] ?></td>
                    </tr>
                    <tr>
                        <td>Barang Terjual</td>
                        <td><?= $terjual ?></td>
                    </tr>
                    <tr>
                        <td>Pemasok Barang</td>
                        <td><?= $row['suplier'] ?></td>
                    </tr>

                <? } ?>
            </table>
        </div>
    </div>

<div class="container">
    <div class="row no-gutters justify-content-end my-3 mr-3">
        <button type="button" class="btn btn-outline-secondary"
        onclick="if(confirm('Apakah kamu yakin ingin menghapus barang ini?')){
                 location.href='barang_hapus.php?kode=<?= $kode ?>'
                 }">
         Hapus
        </button>
        <a href="barang_edit.php?kode=<?= $kode ?>" class="btn btn-secondary mx-1">Edit</a>
    </div>
</div>

<?php require_once 'view/footer.php' ?>