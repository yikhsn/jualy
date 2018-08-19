<?php 
    require_once 'core/init.php';

    if($_SESSION['username']!="admin"){
        header('location: ../index.php');                    
    }

    $id = $_GET['kode_suplai'];

    if(isset($_POST['update_suplai'])){
        
        $fields = array(
            'id_pemasok'    => $_POST['id_pemasok'],
            'waktu'         => $_POST['waktu'],
            'kode_barang'   => $_POST['kode_barang'],
            'nama_barang'   => $_POST['nama_barang'],
            'jumlah'        => $_POST['jumlah'],
            'harga'         => $_POST['harga'],
            'total_harga'   => $_POST['total_harga']
        );

        $data = getWhere('suplai', 'kode_suplai', $id);

        while ($row = mysqli_fetch_array($data)){
            $kode_barang_lama = $row['kode_barang'];
            $suplai_sebelumnya = $row['jumlah'];
        }

        /**
         * if the changes is the same item
         */
        if( $kode_barang_lama == $_POST['kode_barang']){

            /**
             * if amount suply is more than the previous
             */
            if($_POST['jumlah'] >= $suplai_sebelumnya){

                //count the amount item will be added to the item data
                $jumlah_barang_tambah = $_POST['jumlah'] - $suplai_sebelumnya; 
                
                //update data suply to the latest changes data
                update('suplai', $fields, 'kode_suplai', $id);
                
                //add the amount item will be added to the item data
                tambah_pasokan_barang($kode_barang_lama, $jumlah_barang_tambah);
                
                header('Location: suplai.php');
            }
            /**
             * if the amount suply is lesser than previous
             */
            else{
                
                //count the amount item will be reduced to the item data
                $jumlah_barang_kurang = $suplai_sebelumnya - $_POST['jumlah']; 
                
                //update data suply to the latest changes data
                update('suplai', $fields, 'kode_suplai', $id);
                
                //reduce the amount item will be reduced to the item data
                kurang_stok_barang($kode_barang_lama, $jumlah_barang_kurang);

                header('Location: suplai.php');
            }
        }

        /**
         * if the changes is not the same item
         */
        else{
            
            //update the the latest changes suply data
            update('suplai', $fields, 'kode_suplai', $id);
            
            //add the amount item of the new item will be added
            tambah_pasokan_barang($_POST['kode_barang'], $_POST['jumlah']);

            //reduce the amount item of the old item will be reduced
            kurang_stok_barang($kode_barang_lama, $suplai_sebelumnya);

            header('Location: suplai.php');

        }
    }

    require_once 'view/header.php';    

    $data = getWhere('suplai', 'kode_suplai', $id);
    while ($row = mysqli_fetch_array($data)){
?>

<br>
<br>

<div class="container-fluid">
    <form id="data" action="" method="post">
        <div class="row">
            <div class="col-12">
                <h3>Edit Pemasokan : <?php echo $row['kode_suplai'] ?></h3>
                <table class="table">
                    <tr>
                        <td>Kode Suplai</td>
                        <td><?= $row['kode_suplai'] ?></td>
                    </tr>
                    <tr>
                        <td>ID Pemasok</td>
                        <td>
                            <select class="custom-select" name="id_pemasok" id="id_pemasok">                        
                            <?
                                $pemasok = getAll('pemasok', 'id_pemasok');

                                while($data_pemasok = mysqli_fetch_array($pemasok)) {
                                ?>
                                <option value="<?= $data_pemasok['id_pemasok']?>"><?= $data_pemasok['id_pemasok'] ?></option>
                                <?
                                }
                                ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Waktu</td>
                        <td><input name="waktu" type="text" class="form-control" value="<?php echo $row['waktu']?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Kode Barang</td>
                        <td>
                            <select class="custom-select" name="kode_barang" id="kode_barang_suplai">
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
                        <td>Nama Barang</td>
                        <td id="nama-barang-form">
                            <input name="nama_barang" type="text" class="form-control" value="<?php echo $row['nama_barang']?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><input id="harga-barang-suplai" name="harga" type="text" class="form-control" value="<?php echo $row['harga']?>"></td>
                    </tr>
                    <tr>
                        <td>Jumlah Barang</td>
                        <td><input name="jumlah" id="jumlah-barang-suplai" type="text" class="form-control" value="<?php echo $row['jumlah']?>"></td>
                    </tr>
                    <tr>
                        <td>Total Harga</td>
                        <td><input id="total-harga-suplai" name="total_harga" type="text" class="form-control" value="<?php echo $row['total_harga']?>" readonly></td>
                    </tr>
                </table>
            </div>
        </div>

<?php } ?> 
        <div class="row justify-content-end mr-3">
            <input type="button" id="hapus" class="btn btn-outline-secondary mx-1"
                onclick="if(confirm('Apakah kamu yakin ingin menghapus barang ini?')){
                        location.href='suplai_hapus.php?kode_suplai=<?= $id ?>'
                        }" value="Hapus">
            <input type="submit" name="update_suplai" class="btn btn-secondary mx-1" value="Simpan">            
        </div>
    </form>
</div>

<?php require_once 'view/footer.php'; ?>