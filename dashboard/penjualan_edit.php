<?php
    require_once 'core/init.php';

    if(!isset($_SESSION['username'])){
        header('location: ../index.php');
    }

    $id = $_GET['kode_transaksi'];

    if(isset($_POST['update_penjualan'])){

        $fields = array(
            'id_pembeli'    => $_POST['id_pembeli'],
            'id_pegawai'    => $_POST['id_pegawai'],
            'waktu'         => $_POST['waktu'],
            'kode_barang'   => $_POST['kode_barang'],
            'jumlah'        => $_POST['jumlah'],
            'harga'         => $_POST['harga'],
            'total_harga'   => $_POST['total_harga']
        );

        $data = getWhere('penjualan', 'kode_transaksi', $id);

        while ($row = mysqli_fetch_array($data)){
            $kode_barang_lama       = $row['kode_barang'];
            $jumlah_barang_lama     = $row['jumlah'];
        }

        /**
         * if item the customer change to buy is the same item
         */
        if( $kode_barang_lama == $_POST['kode_barang']){

            /**
             * if the amount item change item is more than previous
             */
            if($_POST['jumlah'] >= $jumlah_barang_lama){

                //count the amount item will be reduced to the item data
                $jumlah_barang_kurang = $_POST['jumlah'] - $jumlah_barang_lama;

                //update the changes order data to the latest changes data
                update('penjualan', $fields, 'kode_transaksi', $id);

                //reduce the item stock data
                kurang_sisa_barang($kode_barang_lama, $jumlah_barang_kurang);

                header('Location: penjualan.php');
            }

            /**
             * if the amount item change is lesser than previous
             */
            else{

                // count the amount item will be added again to the stock item
                $jumlah_barang_tambah = $jumlah_barang_lama - $_POST['jumlah'];

                //update the order data to the latest order data
                update('penjualan', $fields, 'kode_transaksi', $id);

                //add the amount item will be added again to the stock item data
                tambah_sisa_barang($kode_barang_lama, $jumlah_barang_tambah);

                header('Location: penjualan.php');
            }
        }

        /**
         * if the item ordered was not the same item
         */
        else{

            //update the order detail to the latest changes
            update('penjualan', $fields, 'kode_transaksi', $id);

            //add the amount item of the old ordered to the stock again
            tambah_sisa_barang($kode_barang_lama, $jumlah_barang_lama);

            // reduce the stock item of the new item ordered
            kurang_sisa_barang($_POST['kode_barang'], $_POST['jumlah']);

            header('Location: penjualan.php');
        }

    }

    require_once 'view/header.php';

    $data = getWhere('penjualan', 'kode_transaksi', $id);

    while ($row = mysqli_fetch_array($data)){
?>

<br>
<br>

<div class="container-fluid">
    <form id="data" action="" method="post">
        <div class="row">
            <div class="col-12">
                <h3>Edit Transaksi : <?php echo $row['kode_transaksi'] ?></h3>
                <table class="table">
                    <tr>
                        <td>Kode Transaksi</td>
                        <td><?= $row['kode_transaksi'] ?></td>
                    </tr>
                    <tr>
                        <td>ID Pembeli</td>
                        <td><input name="id_pembeli" type="text" class="form-control" value="<?php echo $row['id_pembeli']?>" readonly></td>
                    </tr>
                    <tr>
                        <td>ID Pegawai</td>
                        <td><input name="id_pegawai" type="text" class="form-control" value="<?php echo $row['id_pegawai']?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Waktu</td>
                        <td><input name="waktu" type="text" class="form-control" value="<?php echo $row['waktu']?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Kode Barang</td>
                        <td>
                        <select class="custom-select" name="kode_barang" id="kode_barang_edit">
                        <option value="<?= $row['kode_barang']; ?>"><?= $row['kode_barang']; ?></option>
                            <?
                            $pilih_kode = getAll('barang', 'kode_barang');

                            $i = 1;
                            while($row_kode = mysqli_fetch_array($pilih_kode)) {
                            ?>
                            <option value="<?= $data_kode_barang[$i++] = $row_kode['kode_barang']; ?>"><?= $row_kode['kode_barang']; ?></option>
                            <?
                            $i++;
                            }
                            ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah Barang</td>
                        <td><input name="jumlah" id="jumlah-barang-edit" type="text" class="form-control" value="<?php echo $row['jumlah']?>"></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td id="harga-barang-form">
                            <input name="harga" id="harga-barang-edit" type="text"  class="form-control" value="<?php echo $row['harga']?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Total Harga</td>
                        <td><input name="total_harga" id="total-harga-edit" type="text" class="form-control" value="<?php echo $row['total_harga']?>" readonly></td>
                    </tr>
                </table>
            </div>
        </div>

<?php } ?>
        <div class="row justify-content-end mr-3">
            <input type="submit" name="update_penjualan" class="btn btn-secondary mx-1" value="Simpan">
        </div>
    </form>
</div>

<?php require_once 'view/footer.php'; ?>