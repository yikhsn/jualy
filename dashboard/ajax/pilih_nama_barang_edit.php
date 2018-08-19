<?php

require '../functions/act.php';
require '../functions/db.php';

$kode_barang = $_GET['kode_barang'];

$nama_barang = ambil_nama_barang($kode_barang);

while($row = mysqli_fetch_assoc($nama_barang)){

?>
    <input name="nama_barang" type="text" class="form-control" value="<?php echo $row['nama_brg']?>" readonly>
<?
    }
?>