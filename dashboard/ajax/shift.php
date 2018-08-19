<?php

require '../functions/act.php';
require '../functions/db.php';

$shift = $_GET['shift'];

?>

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

                        $pegawai = getAll('pegawai');

                        if(isset($shift)){
                            $pegawai = getWhere('pegawai', 'shift', $shift);
                        }
                                                
                        $i = 1;
                        
                        while($row = mysqli_fetch_assoc($pegawai)){
                    ?>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $row['id_pegawai']?></td>
                        <td><?= $row['nama_pegawai'] ?></td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                        <td><?= $row['shift'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td>
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
    </div>