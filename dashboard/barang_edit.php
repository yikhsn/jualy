<?php
    require 'view/header.php';    

    if(!isset($_SESSION['username'])){
        header('location: ../index.php');
    }

    $kode = $_GET['kode'];

    if(isset($_POST['update_barang'])){
        $nama = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $kode_barang = $kode;
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $sisa = $_POST['sisa'];
        $suplier = $_POST['suplier'];

        update($nama, $jenis, $kode_barang, $harga, $jumlah, $sisa, $suplier);
        header('Location: barang.php');
    }

    $data = getLimitWhere('barang', 'kode_barang', $kode);
    while ($row = mysqli_fetch_array($data)){
?>

<br>
<br>

<div class="container-fluid">
    <form id="data" action="" method="post">
        <div class="row">
            <div class="col-12">
                <h3>Edit <?php echo $row['nama_brg'] ?></h3>
                <table class="table">
                    <tr>
                        <td>ID</td>
                        <td><?= $row['kode_barang'] ?></td>
                    </tr>
                    <tr>
                        <td id="nama_td">Nama Barang</td>
                        <td><input id="nama" name="nama" type="text" class="form-control" value="<?php echo $row['nama_brg']?>"></td>
                    </tr>
                    <tr>
                        <td>Jenis Barang</td>
                        <td>
                        <select class="custom-select" name="jenis" id="jenisBarang">
                            <?
                            $jenis = pilih_jenis();
                            while($pilih_jenis_brg = mysqli_fetch_array($jenis)) {
                            ?>
                            <option value="<?= $pilih_jenis_brg['jenis_brg'] ?>"><?= $pilih_jenis_brg['jenis_brg'] ?></option>
                            <?
                            }
                            ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>
                            <input name="harga" type="text" class="form-control" value="<?php echo $row['harga_brg']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td><input name="jumlah" type="text" class="form-control" value="<?php echo $row['jumlah']?>"></td>
                    </tr>
                    <tr>
                        <td>Sisa</td>
                        <td><input name="sisa" type="text" class="form-control" value="<?php echo $row['sisa']?>"></td>
                    </tr>
                    <tr>
                        <td>Suplier</td>
                        <td>
                        <select class="custom-select" name="suplier" id="penyuplai">
                            <?
                            $pilih_penyuplai = pilih_penyuplai();
                            while($penyuplai = mysqli_fetch_array($pilih_penyuplai)) {
                            ?>
                            <option value="<?= $penyuplai['nama_pemasok'] ?>"><?= $penyuplai['nama_pemasok'] ?></option>
                            <?
                            }
                            ?>
                        </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

<?php } ?> 

        <div class="row justify-content-end mr-3">
            <input type="button" id="hapus" class="btn btn-outline-secondary mx-1"
                onclick="if(confirm('Apakah kamu yakin ingin menghapus barang ini?')){
                        location.href='barang_hapus.php?kode=<?= $kode ?>'
                        }" value="Hapus">
            <input type="submit" name="update_barang" class="btn btn-secondary mx-1" value="Simpan">            
        </div>
    </form>
</div>

<?php require_once 'view/footer.php'; ?>