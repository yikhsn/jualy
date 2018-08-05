<?php
require '../functions/act.php';
require '../functions/db.php';
require '../functions/user.php';

$cari = $_GET['keyword'];
?>

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
                        $pemasok = cari_pemasok($cari);
                        
                        $no = 1;
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
    </div>