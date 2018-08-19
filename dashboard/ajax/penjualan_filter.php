<?
    require '../functions/act.php';
    require '../functions/db.php';

    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];

    $halaman = 10;
    $page = isset($_GET['halaman'])? (int)$_GET['halaman'] : 1;
    $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
    $sql = mysqli_query($link, "SELECT * FROM penjualan WHERE waktu BETWEEN '$dari 00:00:00' AND '$sampai 23:59:59'");
    $total = mysqli_num_rows($sql);
    $pages = ceil($total / $halaman);

    ?>

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
                        $penjualan = filter_penjualan($dari, $sampai, $mulai, $halaman);
                        
                        $i = 1;
                        while($row = mysqli_fetch_assoc($penjualan)){
                    ?>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $row['kode_transaksi'] ?></td>
                        <td><?= $row['id_pembeli']?></td>
                        <td><?= $row['id_pegawai']?></td>
                        <td><?= $row['waktu']?></td>
                        <td><?= $row['kode_barang'] ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td><?= $row['harga'] ?></td>
                        <td><?= $row['total_harga'] ?></td>
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