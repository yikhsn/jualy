<?php
    require '../functions/act.php';
    require '../functions/db.php';

    $ambil_kode_transaksi =  ambil_max_kode('kode_transaksi', 'penjualan');
    
    $data_kode_transaksi = mysqli_fetch_assoc($ambil_kode_transaksi);
    $edit_kode_transaksi = $data_kode_transaksi['maxKode'];

    $noUrut = (int) substr($edit_kode_transaksi, 3, 7);
    $noUrut++;
    $char = "TRS";
    $edit_kode_transaksi = $char . sprintf("%07s", $noUrut);
?>

    <label class="col-form-label" for="idPembeli">ID Pembeli</label>
    <input class="form-control" value="<?= $edit_kode_transaksi; ?>" name="id_pembeli" type="text" id="idPembeli" readonly>