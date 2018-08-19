<?php 
    require_once 'core/init.php';

    if(!isset($_SESSION['username'])){
        header('location: ../index.php');
    }

    $username = $_SESSION['username'];

    if(isset($_POST['submit'])){
        $kode_transaksi = $_POST['kode_transaksi'];
        $id_pembeli = $_POST['id_pembeli'];
        $id_pegawai = $username;
        $waktu = $_POST['waktu'];
        $kode_barang = $_POST['kode_barang'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $total_harga = $_POST['total_harga'];
        
        tambah_penjualan($kode_transaksi, $id_pembeli, $id_pegawai, $waktu, $kode_barang, $jumlah, $harga, $total_harga);
        kurang_barang($kode_barang, $jumlah);
        header('location: cetak/struk.php');
    }

    if(isset($_POST['cetak'])) {

        $waktu = $_POST['daterange'];

        header('location: cetak/laporan_penjualan.php?waktu=' . urlencode($waktu));
    }

    require_once 'view/header.php';    
?>

<br>

<div class="container-fluid my-3">
    <div class="row">
        <div class="col-4">
            <button class="btn btn-md btn-secondary" id="tambah_penjualan" type="button" data-toggle="modal" data-target="#tambahBarang" aria-hidden="true">Tambah Penjualan</button>
        </div>
        <div class="col-3 offset-5">
            <form action="">
                <input class="form-control" type="text" name="daterange" value="05/20/2018 - 05/21/2018" />
            </form>
        </div>
    </div>
</div>

<?php
    $next_id = set_kode_baru('PBL', 'kode_transaksi', 'penjualan');

    $next_code = set_kode_baru('TRS', 'kode_transaksi', 'penjualan');;

    $halaman = 10;
    $page = isset($_GET['halaman'])? (int)$_GET['halaman'] : 1;
    $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
    $sql = mysqli_query($link, "SELECT * FROM penjualan");
    $total = mysqli_num_rows($sql);
    $pages = ceil($total / $halaman);
?>

<div id="table" class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Transaksi</th>
                        <th scope="col">ID Pembeli</th>
                        <th scope="col">ID Pegawai</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Barang</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        $penjualan = getLimit('penjualan', $mulai, $halaman);
                        
                        $no = $mulai + 1;
                        while($row = mysqli_fetch_assoc($penjualan)){
                    ?>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $row['kode_transaksi'] ?></td>
                        <td><?= $row['id_pembeli']?></td>
                        <td><?= $row['id_pegawai']?></td>
                        <td><?= $row['waktu']?></td>
                        <td><?= $row['kode_barang'] ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td><?= rupiah($row['harga']); ?></td>
                        <td><?= rupiah($row['total_harga']); ?></td>
                        <td>
                            <span> 
                                <a href="penjualan_detail.php?kode_transaksi=<?= $row['kode_transaksi']; ?>" class="btn btn-outline-secondary btn-sm">Detail</a>
                                <a href="penjualan_edit.php?kode_transaksi=<?= $row['kode_transaksi']; ?>" class="btn btn-secondary btn-sm">Edit</a>
                            </span>
                        </td>
                    </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <nav aria-label="">
                <ul class="pagination justify-content-center">
                      
                        <?php

                        if (isset($_GET['halaman'])){
                            $halaman = $_GET['halaman'];
                            if (($halaman - 1) >= 1) {
                                ?>
                                    <li class="page-item">
                                        <a class="page-link text-white bg-dark" href="?halaman=<?= $_GET['halaman'] - 1?>">Previous</a>
                                    </li>
                                <?php 
                            }                      
                        }

                        for($x=1; $x<=$pages; $x++){
                            ?>
                                <li class="page-item ">
                                    <a class="page-link text-white bg-dark" href="?halaman=<?= $x ?>"><?= $x ?></a>
                                </li>
                            <?php
                        }        
                        ?>
                      
                        <?php
                        if (!isset($_GET['halaman'])) {
                            ?>
                                <li class="page-item ">
                                <a class="page-link text-white bg-dark" href="?halaman=<?= 2 ?>">Next</a>
                                </li>
                            <?
                            }
    
                        else if(($_GET['halaman'] + 1) < $x) { 
                        ?>
                            <li class="page-item ">
                                <a class="page-link text-white bg-dark" href="?halaman=<?= $_GET['halaman'] + 1?>">Next</a>
                            </li>
                        <?
                        }
                        ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid my-2">
    <div class="row">
        <div class="col-4 offset-8">
            <button class="btn btn-md btn-secondary" id="cetak_laporan" type="button" data-toggle="modal" data-target="#cetakLaporanPenjualan" aria-hidden="true">Cetak Laporan Penjualan</button>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahBarang" tabindex="-1" role="dialog" aria-labelledBy="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="modalLabel">Tambah Data Penjualan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="tambah_penjualan_form">
                    <div class="form-group">
                        <label class="col-form-label" for="barang">Kode Barang</label>
                        <select class="custom-select" name="kode_barang" id="kode_barang">
                            <?
                            $pilih_kode = pilih_kode_barang();
                            $i = 1;
                            while($row = mysqli_fetch_array($pilih_kode)) {
                            ?>
                            <option class="kode_barang_value" value="<?= $data_kode_barang[$i++] = $row['kode_barang']; ?>"><?= $row['kode_barang']; ?></option>
                            <?
                            }
                            ?>
                        </select>
                    </div>
                    <div id="jumlah-barang-form" class="form-group">
                        <label class="col-form-label" for="jumlahBarangBeli">Jumlah</label>
                        <input class="form-control" name="jumlah" type="text" id="jumlahBarangBeli">
                    </div>
                    <div id="harga-barang-form" class="form-group">
                    <?
                        $harga_barang = ambil_harga_barang($data_kode_barang[1]);

                        while($row2 = mysqli_fetch_assoc($harga_barang)){
                    ?>
                    <label class="col-form-label" for="hargaBarangBeli">Harga</label>
                    <input class="form-control" name="harga" type="text" value="<?= $row2['harga_brg']; ?>" id="hargaBarangBeli" readonly>
                    <?
                        }
                    ?>
                    </div>
                    <div id="total_harga_form" class="form-group">
                        <label class="col-form-label" for="totalHarga">Total Harga</label>
                        <input class="form-control" name="total_harga" type="text" id="totalHarga" readonly>
                    </div>
                    <div id="id_pembeli_form" class="form-group">
                        <label class="col-form-label" for="idPembeli">ID Pembeli</label>
                        <input class="form-control" value="<?= $next_id; ?>" name="id_pembeli" type="text" id="idPembeli" readonly>
                    </div>
                    <div class="form-group">
                        <input type="checkbox">
                        <span class="custom-control-description">Centang jika menggunakan kartu pelanggan</span>
                    </div>            
                    <div class="form-group">
                        <label class="col-form-label" for="idPegawai">ID Pegawai</label>
                        <input class="form-control" name="id_pegawai" value="<?= $username; ?>" type="text" id="idPegawai" readonly>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="kodeTransaksi">Kode Transaksi</label>
                        <input class="form-control" name="kode_transaksi" type="text" id="kodeTransaksi" readonly value="<?= $next_code;?>">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="waktu">Waktu</label>
                        <input class="form-control" name="waktu" value="<?= date('y-m-d H:i:s'); ?>" readonly id="waktu">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <input type="submit" id="submit_penjualan" name="submit" class="btn btn-secondary" value="Tambah">                
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="cetakLaporanPenjualan" tabindex="-1" role="dialog" aria-labelledBy="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="modalLabel">Cetak Laporan Penjualan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="cetak-laporan-penjualan">
                    <div id="waktu-laporan" class="form-group">
                        <label class="col-form-label" for="waktu">Pilih Waktu</label>
                        <input class="form-control" type="text" name="daterange" id="waktu" value="05/01/2018 - 05/31/2018" />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <input type="submit" id="cetak" name="cetak" class="btn btn-secondary" value="Cetak">                
            </div>
                </form>
        </div>
    </div>
</div>

<?php require_once 'view/footer.php'; ?>