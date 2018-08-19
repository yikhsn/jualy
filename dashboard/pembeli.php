<?php
    require_once 'core/init.php';

    if(!isset($_SESSION['username'])){
        header('location: ../index.php');
    }

    if(isset($_POST['submit'])){
        $id_pembeli = $_POST['id_pembeli'];        
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        
        tambah_pembeli($id_pembeli, $nama, $alamat, $jenis_kelamin);
        header('location:pembeli.php');
    }

    require_once 'view/header.php';    

    $next_id = set_kode_baru('PLG', 'id_pembeli', 'pembeli');
?>
<br>

<div class="container-fluid my-3">
    <div class="row">
        <div class="col-4">
            <button class="btn btn-md btn-secondary" type="button" data-toggle="modal" data-target="#tambahBarang" aria-hidden="true"> Tambah Pelanggan</button>
        </div>
    
        <div class="col-3 offset-5">
            <form class="form-inline mr-3" action="" method="post">
                <input type="search" id="cari_pembeli" class="form-control" name="keyword" placeholder="Cari Disini..">
            </form>
        </div>
    </div>
</div>

<?php
    $halaman = 10;
    $page = isset($_GET['halaman'])? (int)$_GET['halaman'] : 1;
    $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
    $sql = mysqli_query($link, "SELECT * FROM pembeli");
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
                        <th scope="col">ID Pelanggan</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        if (isset($_POST['keyword'])){
                            $pembeli = cari_pembeli($_POST['keyword']);
                        }
                        else{
                            $pembeli = getLimit('pembeli', $mulai, $halaman);                            
                        }
    
                        $no = $mulai + 1;
                        while($row = mysqli_fetch_assoc($pembeli)){
                    ?>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $row['id_pembeli'] ?></td>
                        <td><?= $row['nama']?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                        <td>
                            <span> 
                                <a href="pembeli_detail.php?id=<?= $row['id_pembeli']; ?>" class="btn btn-outline-secondary btn-sm">Detail</a>
                                <a href="pembeli_edit.php?id=<?= $row['id_pembeli']; ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                                <a id="hapus" href="" class="btn btn-secondary text-white btn-sm"
                                onclick="if(confirm('Apakah kamu yakin ingin menghapus data pembeli ini?')){
                                            location.href='pembeli_hapus.php?id=<?php echo $row['id_pembeli']; ?>'
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
                <h5 class="modal-title text-white" id="modalLabel">Tambah Pelanggan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label class="col-form-label" for="idPembeli">ID Pelanggan</label>
                        <input class="form-control" value="<?= $edit_id_pembeli; ?>" name="id_pembeli" type="text" id="idPembeli" readonly>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="nama">Nama</label>
                        <input class="form-control" name="nama" type="text" id="nama">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="alamat">Alamat</label>
                        <input class="form-control" name="alamat" type="text" id="alamat">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="custom-select" id="jenis_kelamin">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
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