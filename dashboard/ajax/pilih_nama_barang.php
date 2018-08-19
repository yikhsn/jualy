<?php

require '../functions/act.php';
require '../functions/db.php';

$kode_barang = $_GET['kode_barang'];

$nama_barang = ambil_nama_barang($kode_barang);

while($row = mysqli_fetch_assoc($nama_barang)){

?>
    <label class="col-form-label" for="namaBarang">Nama Barang</label>
    <input class="form-control" name="nama_barang" value="<?= $row['nama_brg']; ?>" type="text" id="namaBarang" readonly>
<?
    }
?>