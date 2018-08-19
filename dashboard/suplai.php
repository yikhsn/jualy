<?php
    require_once 'core/init.php';

    if($_SESSION['username']!="admin"){
        header('location: ../index.php');                    
    }

    if(isset($_POST['submit'])){

        $fields = array(
            'kode_suplai'   => $_POST['kode_suplai'],
            'id_pemasok'    => $_POST['id_pemasok'],
            'waktu'         => $_POST['waktu'],
            'kode_barang'   => $_POST['kode_barang'],        
            'nama_barang'   => $_POST['nama_barang'],
            'jumlah'        => $_POST['jumlah'],
            'harga'         => $_POST['harga'],
            'total_harga'   => $_POST['total_harga']
        );

        insert('suplai', $fields);
        tambah_pasokan_barang($kode_barang, $jumlah);
        header('location:suplai.php');
    }

    if(isset($_POST['cetak'])) {
        $waktu = $_POST['daterange'];
        header('location: cetak/laporan_pemasokan.php?waktu=' . urlencode($waktu));
    }

    require_once 'view/header.php'; 
    
?>

<br>

<div class="container-fluid my-3">
    <div class="row">
        <div class="col-4">
            <button class="btn btn-md btn-secondary" type="button" data-toggle="modal" data-target="#tambahBarang" aria-hidden="true">Suplai Barang</button>
        </div>
    
        <div class="col-3 offset-5">
                <input class="form-control" type="text" id="suplai" name="daterange" value="05/01/2018 - 01/31/2018" /> 
        </div>
    </div>
</div>

<?php
    $next_kode = set_kode_baru('SPL', 'kode_suplai', 'suplai');

    $halaman = 10;
    $page = isset($_GET['halaman'])? (int)$_GET['halaman'] : 1;
    $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
    $sql = mysqli_query($link, "SELECT * FROM suplai");
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
                        <th scope="col">Kode Pasokan</th>
                        <th scope="col">ID Pemasok</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        $data_suplai = getLimit('suplai', $mulai, $halaman);
                        
                        $no = $mulai + 1;
                        while($row = mysqli_fetch_assoc($data_suplai)){
                    ?>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $row['kode_suplai'] ?></td>
                        <td><?= $row['id_pemasok']?></td>
                        <td><?= $row['waktu']?></td>
                        <td><?= $row['nama_barang']?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td><?= rupiah($row['harga']) ?></td>
                        <td><?= rupiah($row['total_harga']) ?></td>
                        <td>
                            <span> 
                                <a href="suplai_detail.php?kode_suplai=<?= $row['kode_suplai']; ?>" class="btn btn-outline-secondary btn-sm">Detail</a>
                                <a href="suplai_edit.php?kode_suplai=<?= $row['kode_suplai']; ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                                <a id="hapus" href="" class="btn btn-secondary text-white btn-sm"
                                onclick="if(confirm('Apakah kamu yakin ingin menghapus barang ini?')){
                                            location.href='suplai_hapus.php?kode_suplai=<?php echo $row['kode_suplai']; ?>'
                                            }">
                                    Hapus
                                </a>
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
            <button class="btn btn-md btn-secondary" id="cetak_laporan" type="button" data-toggle="modal" data-target="#cetakLaporanPemasokan" aria-hidden="true">Cetak Laporan Pemasokan</button>
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
                <form action="" method="post">
                    <div class="form-group">
                        <label class="col-form-label" for="idPemasok">ID Pemasok</label>
                        <select class="custom-select" name="id_pemasok" id="idPemasok">
                            <?
                            $pemasok = getAll('pemasok', 'id_pemasok');

                            while($row = mysqli_fetch_array($pemasok)) {
                            ?>
                            <option value="<?= $row['id_pemasok']?>"><?= $row['id_pemasok'] ?></option>
                            <?
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="barang">Kode Barang</label>
                        <select class="custom-select" name="kode_barang" id="kode_barang_pasokan">
                            <?
                            $pilih_kode = getAll('barang', 'kode_barang');
                            $i = 1;
                            while($row = mysqli_fetch_array($pilih_kode)) {
                            ?>
                            <option id="kode_barang_pasokan" value="<?= $data_kode_barang[$i++] = $row['kode_barang']; ?>"><?= $row['kode_barang']; ?></option>
                            <?
                            }
                            ?>
                        </select>
                    </div>
                    <div id="nama_barang_form" class="form-group">
                    <?
                        $nama_barang = getWhere('barang', 'kode_barang', $data_kode_barang[1], 'nama_brg');

                        while($row = mysqli_fetch_assoc($nama_barang)){
                    ?>
                        <label class="col-form-label" for="namaBarang">Nama Barang</label>
                        <input class="form-control" name="nama_barang" value="<?= $row['nama_brg']; ?>" type="text" id="namaBarang" readonly>
                    <?
                        }
                    ?> 
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="hargaBarangPasokan">Harga per Satuan</label>
                        <input class="form-control" name="harga" type="text" id="hargaBarangPasokan">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="jumlahBarangPasokan">Jumlah Satuan</label>
                        <input class="form-control" name="jumlah" type="text" id="jumlahBarangPasokan">
                    </div>
                    <div id="form_total_harga_pasokan" class="form-group">
                        <label class="col-form-label" for="totalHarga">Total Harga</label>
                        <input class="form-control" name="total_harga" type="text" id="totalHarga" readonly>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="kodeSuplai">Kode Suplai</label>
                        <input class="form-control" value="<?= $next_kode; ?>" readonly name="kode_suplai" type="text" id="kodeSuplai">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="waktu">Waktu</label>
                        <input class="form-control" value="<?= date('y-m-d H:i:s'); ?>" readonly name="waktu" type="text" id="waktu">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary"data-dismiss="modal">Close</button>
                <input type="submit" name="submit" class="btn btn-secondary" value="Simpan">
            </div>
        </form>
        </div>
    </div>
</div><div class="modal fade" id="cetakLaporanPemasokan" tabindex="-1" role="dialog" aria-labelledBy="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="modalLabel">Cetak Laporan Pemasokan</h5>
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
