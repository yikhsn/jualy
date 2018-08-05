<?php

require '../functions/act.php';
require '../functions/db.php';
require '../functions/user.php';  

$kode_barang = $_GET['kode_barang'];

$harga_barang = ambil_harga_barang($kode_barang);

while($row10 = mysqli_fetch_assoc($harga_barang)){

?>
      <input name="harga" id="harga-barang-edit" type="text"  class="form-control" value="<?php echo $row10['harga_brg']; ?>" readonly>
<?
    }
?>