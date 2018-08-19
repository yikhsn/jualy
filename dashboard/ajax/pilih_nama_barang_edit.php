<?php

require '../functions/act.php';
require '../functions/db.php';

$kode_barang = $_GET['kode_barang'];

$nama_barang = getWhere('barang', 'kode_barang', $kode_barang, 'nama_brg');

while($row = mysqli_fetch_assoc($nama_barang)){

?>
    <input name="nama_barang" type="text" class="form-control" value="<?php echo $row['nama_brg']?>" readonly>
<?
    }
?>