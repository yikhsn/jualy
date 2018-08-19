<?php
    require_once 'core/init.php';

    if($_SESSION['username']!="admin"){
        header('location: ../index.php');                    
    }  

    if(isset($_POST['submit'])){

        $fields = array(
            'id_pemasok'    => $_POST['id_pemasok'],  
            'nama_pemasok'  => $_POST['nama_pemasok'],
            'alamat'        => $_POST['alamat'],
            'barang'        => $_POST['barang'],
            'telepon'       => $_POST['telepon']            
        );

        insert('pemasok', $fields);
        header('location:pemasok.php');
    }

    require_once 'view/header.php';
    
?>

<br>

<div class="container-fluid my-3">
    <div class="row">
        <div class="col-4">
            <button class="btn btn-md btn-secondary" type="button" data-toggle="modal" data-target="#tambahBarang" aria-hidden="true"> Tambah Pemasok</button>
        </div>
    
        <div class="col-3 offset-5">
            <form class="form-inline mr-3" action="" method="post">
                <input type="search" id="cari_pemasok" class="form-control" name="keyword" placeholder="Cari Disini..">
            </form>
        </div>
    </div>
</div>

<?php
    $next_id = set_kode_baru('PMS', 'id_pemasok', 'pemasok');

    $halaman = 10;
    $page = isset($_GET['halaman'])? (int)$_GET['halaman'] : 1;
    $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
    $sql = mysqli_query($link, "SELECT * FROM pemasok");
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
                        <th scope="col">ID Pemasok</th>
                        <th scope="col">Nama Pemasok</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Barang</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        if (isset($_POST['keyword'])){
                            $pemasok = getSearch('pemasok', 'nama_pemasok', 'id_pemasok', $_POST['keyword']);
                        }
                        else{
                            $pemasok = getLimit('pemasok', $mulai, $halaman);
                        }
                        
                        $no = $mulai + 1;
                        while($row = mysqli_fetch_assoc($pemasok)){
                    ?>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $row['id_pemasok'] ?></td>
                        <td><?= $row['nama_pemasok']?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['barang'] ?></td>
                        <td><?= $row['telepon'] ?></td>
                        <td>
                            <span> 
                                <a href="pemasok_detail.php?id=<?= $row['id_pemasok']; ?>" class="btn btn-outline-secondary btn-sm">Detail</a>
                                <a href="pemasok_edit.php?id=<?= $row['id_pemasok']; ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                                <a id="hapus" href="" class="btn btn-secondary text-white btn-sm"
                                onclick="if(confirm('Apakah kamu yakin ingin menghapus data ini?')){
                                            location.href='pemasok_hapus.php?id=<?php echo $row['id_pemasok']; ?>'
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
                <h5 class="modal-title text-white" id="modalLabel">Tambah Pemasok</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label class="col-form-label" for="idPemasok">ID Pemasok</label>
                        <input class="form-control" value="<?= $next_id; ?>" readonly name="id_pemasok" type="text" id="idPemasok">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="namaPemasok">Nama Pemasok</label>
                        <input class="form-control" name="nama_pemasok" type="text" id="namaPemasok">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="barang">Jenis Barang</label>
                        <select name="barang" class="custom-select" id="barang">
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Rumah Tangga">Rumah Tangga</option>                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="alamat">Alamat</label>
                        <input class="form-control" name="alamat" type="text" id="alamat">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="telepon">Telepon</label>
                        <input class="form-control" name="telepon" type="text" id="telepon">
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