<?php
    require_once 'core/init.php'; 

    if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $harga = $_POST['harga'];
        $kode = $_POST['kode'];
        $jumlah = $_POST['jumlah'];
        $suplier = $_POST['suplier'];
        $sisa = $jumlah;
        
        tambah_barang($nama, $jenis, $harga, $kode, $jumlah, $sisa, $suplier);
        header('location:barang.php');
    }

    if(!isset($_SESSION['username'])){
        header('location: ../index.php');
    }

    require_once 'view/header.php';     

    $ambil_kode_barang = ambil_kode_barang();
    $data_kode_barang = mysqli_fetch_assoc($ambil_kode_barang);
    $edit_kode_barang = $data_kode_barang['maxKode'];

    $noUrut = (int) substr($edit_kode_barang, 3, 3);
    $noUrut++;
    $char = "BRG";
    $edit_kode_barang = $char . sprintf("%03s", $noUrut);

    $halaman = 10;
    $page = isset($_GET['halaman'])? (int)$_GET['halaman'] : 1;
    $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
    $sql = mysqli_query($link, "SELECT * FROM barang");
    $total = mysqli_num_rows($sql);
    $pages = ceil($total / $halaman);
?>

<br>

<div class="container-fluid my-3">
    <div class="row">
        <div class="col-4">
            <button class="btn btn-md btn-secondary" type="button" data-toggle="modal" data-target="#tambahBarang" aria-hidden="true"> Tambah Barang</button>
        </div>
    
        <div class="col-3 offset-5">
            <form class="form-inline mr-3" action="" method="post">
                <input type="search" id="keyword" class="form-control" name="keyword" placeholder="Cari Disini..">
            </form>
        </div>
    </div>
</div>

<div id="table" class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>              
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jenis Barang</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Sisa</th>
                        <th scope="col">Suplier</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        if (isset($_POST['keyword'])){
                            $barang = cari_barang($_POST['keyword']);
                        }
                        else{
                            $barang = tampilkan_barang($mulai, $halaman);                            
                        }
                        
                        $no = $mulai + 1;
                        while($row = mysqli_fetch_assoc($barang)){
                    ?>
                        <th><?= $no++ ?></th>
                        <td>
                            <?= $row['nama_brg'] ?>
                            <?
                            if($row['sisa'] < 6){ ?>
                                <span class="badge badge-pill mx-1 badge-danger">*</span>                                
                            <?
                            }
                            else if($row['sisa'] < 11){ ?>
                                <span class="badge badge-pill mx-1 badge-warning">*</span>
                            <?
                            }
                            ?>
                        </td>
                        <td><?= $row['jenis_brg'] ?></td>
                        <td><?= $row['kode_barang']?></td>
                        <td><?= rupiah($row['harga_brg']) ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td><?= $row['sisa'] ?></td>
                        <td><?= $row['suplier'] ?></td>
                        <td>
                            <span> 
                                <a href="barang_detail.php?kode=<?= $row['kode_barang']; ?>" class="btn btn-outline-secondary btn-sm">Detail</a>
                                <a href="barang_edit.php?kode=<?= $row['kode_barang']; ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                                <a id="hapus" href="" class="btn btn-secondary text-white btn-sm"
                                onclick="if(confirm('Apakah kamu yakin ingin menghapus barang ini?')){
                                            location.href='barang_hapus.php?kode=<?php echo $row['kode_barang']; ?>'
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

<div class="modal fade" id="tambahBarang" tabindex="-1" role="dialog" aria-labelledBy="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="modalLabel">Tambah Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label class="col-form-label" for="namaBarang">Nama Barang</label>
                        <input class="form-control" name="nama" type="text" id="namaBarang">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="jenisBarang">Jenis Barang</label>
                        <select class="custom-select" name="jenis" id="jenisBarang">
                            <?
                            $jenis = pilih_jenis();
                            while($row = mysqli_fetch_array($jenis)) {
                            ?>
                            <option value="<?= $row['jenis_brg'] ?>"><?= $row['jenis_brg'] ?></option>
                            <?
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="hargaBarang">Harga Barang</label>
                        <input class="form-control" name="harga" type="text" id="hargaBarang">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="kodeBarang">Kode Barang</label>
                        <input class="form-control" value="<?= $edit_kode_barang; ?>"name="kode" type="text" readonly id="kodeBarang">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="jumlahBarang">Jumlah Barang</label>
                        <input class="form-control" name="jumlah" type="text" id="jumlahBarang">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="penyuplai">Penyuplai</label>
                        <select class="custom-select" name="suplier" id="penyuplai">
                            <?
                            $pilih_penyuplai = pilih_penyuplai();
                            while($row = mysqli_fetch_array($pilih_penyuplai)) {
                            ?>
                            <option value="<?= $row['nama_pemasok'] ?>"><?= $row['nama_pemasok'] ?></option>
                            <?
                            }
                            ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary"data-dismiss="modal">Close</button>
                <input type="submit" name="submit" class="btn btn-secondary" value="Simpan">
            </div>
        </form>
        </div>
    </div>
</div>



<?php require_once 'view/footer.php'; ?>