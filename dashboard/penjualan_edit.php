<?php 
    require_once 'core/init.php';

    if(!isset($_SESSION['username'])){
        header('location: ../index.php');
    }

    $id = $_GET['kode_transaksi'];

    if(isset($_POST['update_penjualan'])){

        $id_pembeli = $_POST['id_pembeli'];
        $id_pegawai = $_POST['id_pegawai'];
        $waktu = $_POST['waktu'];
        $kode_barang = $_POST['kode_barang'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $total_harga = $_POST['total_harga'];

        $data = detail_penjualan($id);
        while ($row = mysqli_fetch_array($data)){
            $kode_barang_lama = $row['kode_barang'];
            $jumlah_barang_lama = $row['jumlah'];
        }

        // die($kode_barang_lama);

        if( $kode_barang_lama == $kode_barang){
            if($jumlah >= $jumlah_barang_lama){
                $jumlah_barang_kurang = $jumlah - $jumlah_barang_lama; 
                update_penjualan($id, $id_pembeli, $id_pegawai, $waktu, $kode_barang, $jumlah, $harga, $total_harga);
                kurang_stok_barang($kode_barang_lama, $jumlah_barang_kurang);
                header('Location: penjualan.php');
            }
            else{
                $jumlah_barang_tambah = $jumlah_barang_lama - $jumlah; 
                update_penjualan($id, $id_pembeli, $id_pegawai, $waktu, $kode_barang, $jumlah, $harga, $total_harga);
                tambah_pasokan_barang($kode_barang_lama, $jumlah_barang_tambah);
                header('Location: penjualan.php');                     
            }
        }
        else{
            update_penjualan($id, $id_pembeli, $id_pegawai, $waktu, $kode_barang, $jumlah, $harga, $total_harga);
            tambah_pasokan_barang($kode_barang_lama, $jumlah_barang_lama);                
            kurang_stok_barang($kode_barang, $jumlah);
            header('Location: penjualan.php');
        }
       
    }

    require_once 'view/header.php';    

    $data = detail_penjualan($id);
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
                            $pilih_kode = pilih_kode_barang();
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