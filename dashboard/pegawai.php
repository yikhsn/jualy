<?php
    require_once 'core/init.php';

    if(!isset($_SESSION['username'])){
        header('location: ../index.php');            
    }

    if($_SESSION['username']!="admin"){
        header('location: ../index.php');                    
    }    

    if(isset($_POST['submit'])){
        $id_pegawai = $_POST['id_pegawai'];
        $nama_pegawai = $_POST['nama_pegawai'];
        $shift = $_POST['shift'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $no_hape = $_POST['no_hape'];
        
        tambah_pegawai($id_pegawai, $nama_pegawai, $shift, $jenis_kelamin, $alamat, $no_hape);
        header('location:pegawai.php');
    }

    require_once 'view/header.php';    
?>

<br>

<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col">            
            <form id="pegawai-shift-wrapper" action=""  method="post">
                <button class="btn btn-md btn-secondary" type="button" data-toggle="modal" data-target="#tambahPegawai" aria-hidden="true">+</button>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <button class="btn btn-md btn-secondary" type="button" id="shift_button_pagi" value="pagi">Pagi</button>
                    <button class="btn btn-md btn-secondary" type="button" id="shift_button_siang"  value="siang">Siang</button>
                    <button class="btn btn-md btn-secondary" type="button" id="shift_button_malam"  value="malam">Malam</button>            
                </div>
            </form>

        </div>
    </div>
</div>

<?php

    $next_id = set_kode_baru('PGW', 'id_pegawai', 'pegawai');    
    
    $halaman = 10;
    $page = isset($_GET['halaman'])? (int)$_GET['halaman'] : 1;
    $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
    $sql = mysqli_query($link, "SELECT * FROM pegawai");
    $total = mysqli_num_rows($sql);
    $pages = ceil($total / $halaman);
?>

<div id="table_pegawai" class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col-1">No</th>
                        <th scope="col-1">ID Pegawai</th>                        
                        <th scope="col-2">Nama</th>
                        <th scope="col-1">Jenis Kelamin</th>
                        <th scope="col-1">Shift</th>
                        <th scope="col-3">Alamat</th>
                        <th scope="col-3">Opsi</th>                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        $barang = tampilkan_pegawai($mulai, $halaman);
                        
                        $no = $mulai + 1;
                        
                        while($row = mysqli_fetch_assoc($barang)){
                    ?>
                        <th scope="row"><?= $no++ ?></th>
                        <td class=><?= $row['id_pegawai']?></td>
                        <td class=><?= $row['nama_pegawai'] ?></td>
                        <td class=><?= $row['jenis_kelamin'] ?></td>
                        <td class=><?= $row['shift'] ?></td>
                        <td class=><?= $row['alamat'] ?></td>
                        <td class=>
                            <span> 
                                <a href="pegawai_detail.php?id=<?= $row['id_pegawai']; ?>" class="btn btn-outline-secondary btn-sm">Detail</a>
                                <a href="pegawai_edit.php?id=<?= $row['id_pegawai']; ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                                <a id="hapus" href="" class="btn btn-secondary text-white btn-sm"
                                onclick="if(confirm('Apakah kamu yakin ingin menghapus barang ini?')){
                                            location.href='pegawai_hapus.php?id=<?php echo $row['id_pegawai']; ?>'
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

<div class="modal fade" id="tambahPegawai" tabindex="-1" role="dialog" aria-labelledBy="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="modalLabel">Tambah Pegawai</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">                
                    <div class="form-group">
                        <label class="col-form-label" for="idPegawai">ID Pegawai</label>
                        <input class="form-control" value="<?= $next_id; ?>"name="id_pegawai" type="text" id="idPegawai" readonly>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="namaPegawai">Nama Pegawai</label>
                        <input class="form-control" name="nama_pegawai" type="text" id="namaPegawai">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="shift">Shift</label>
                        <input class="form-control" name="shift" type="text" id="shift">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="jenisKelamin">Jenis Kelamin</label>
                        <input class="form-control" name="jenis_kelamin" type="text" id="jenisKelamin">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="alamat">Alamat</label>
                        <input class="form-control" name="alamat" type="text" id="alamat">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="noHandphone">No Handphone</label>
                        <input class="form-control" name="no_hape" type="text" id="noHandphone">
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