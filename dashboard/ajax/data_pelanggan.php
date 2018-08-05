<?php
require '../functions/act.php';
require '../functions/db.php';
?>

    <label class="col-form-label" for="idPembeli">ID Pembeli</label>
    <select class="custom-select" name="id_pembeli" id="idPembeli">
        <?
            $pelanggan = pilih_pelanggan();

            print_r($pelanggan);

            while($row = mysqli_fetch_array($pelanggan)) {
        ?>
        <option value="<?= $row['id_pembeli'];?>"><?= $row['id_pembeli']; ?></option>
        <?
            }
        ?>
    </select>                                                
