<?php

require '../functions/act.php';
require '../functions/db.php';

$kode_barang = $_GET['kode_barang'];

$harga_barang = getWhere('barang', 'kode_barang', $kode_barang, 'harga_brg');

while($row10 = mysqli_fetch_assoc($harga_barang)){

?>
      <input name="harga" id="harga-barang-edit" type="text"  class="form-control" value="<?php echo $row10['harga_brg']; ?>" readonly>
<?
    }
?>