<?php

require '../functions/act.php';
require '../functions/db.php';
require '../functions/user.php';  

$kode_barang = $_GET['kode_barang'];

$harga_barang = ambil_harga_barang($kode_barang);

while($row = mysqli_fetch_assoc($harga_barang)){

?>
    <label class="col-form-label" for="hargaBarangBeli">Harga</label>
    <input class="form-control" name="harga" type="text" value="<?= $row['harga_brg']; ?>" id="hargaBarangBeli" readonly>
<?
    }
?>