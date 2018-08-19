<?php

require '../functions/act.php';
require '../functions/db.php';

$kode_barang = $_GET['kode_barang'];

$harga_barang = getWhere('barang', 'kode_barang', $kode_barang, 'harga_brg');

while($row = mysqli_fetch_assoc($harga_barang)){

?>
    <label class="col-form-label" for="hargaBarangBeli">Harga</label>
    <input class="form-control" name="harga" type="text" value="<?= $row['harga_brg']; ?>" id="hargaBarangBeli" readonly>
<?
    }
?>