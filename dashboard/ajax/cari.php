<?php
require '../functions/act.php';
require '../functions/db.php';

$cari = $_GET['keyword'];
?>
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

                        $barang = cari_barang($cari);
                        
                        $i = 1;
                        while($row = mysqli_fetch_assoc($barang)){
                    ?>
                        <th scope="row"><?= $i++ ?></th>
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
    </div>