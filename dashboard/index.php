<?php 

  require_once 'view/header.php';
  require_once 'core/init.php';

  if(!isset($_SESSION['username'])){
    header('location: ../index.php');
  }

  $kemarin =  date('Y-m-d', strtotime("-1 days"));
  $hari_ini = date('Y-m-d');
  $total_barang_laku = 0;
  $total_penjualan = 0;
  $total_penjualan_kemarin = 0;
  $total_laku_kemarin = 0;

  
  $ambil_data = filter_laporan_penjualan($hari_ini, $hari_ini);
  $jumlah_transaksi = 0;
  while($data_sekarang = mysqli_fetch_assoc($ambil_data)){

    $total_penjualan = $total_penjualan + $data_sekarang['total_harga'];
    $total_barang_laku = $total_barang_laku + $data_sekarang['jumlah'];
    $jumlah_transaksi++;
  }

  $ambil_data_kemarin = filter_laporan_penjualan($kemarin, $kemarin);
  $jumlah_transaksi_kemarin = 0;
  while($data_kemarin = mysqli_fetch_assoc($ambil_data_kemarin)){

    $total_penjualan_kemarin = $total_penjualan_kemarin + $data_kemarin['total_harga'];
    $total_laku_kemarin = $total_laku_kemarin + $data_kemarin['jumlah'];
    $jumlah_transaksi_kemarin++;
  }

  $beda_penjualan =  $total_penjualan - $total_penjualan_kemarin;
  $beda_barang = $total_barang_laku - $total_laku_kemarin;
  $beda_transaksi = $jumlah_transaksi - $jumlah_transaksi_kemarin;

?>

  <div id="dash-container" class="container-fluid">
    <div class="row no-gutters ringkasan">

        <div class="col-4">
          <div class="box-ringkasan">
            <div class="title-box-ringkasan">
              <span id="title-kiri">Transaksi</span>
              <span id="title-kanan">Selama Hari Ini</span>
            </div>
            <div class="body-box-ringkasan">
              <div class="data-ringkasan">
                <?= $jumlah_transaksi; ?>
                <span class="data-kemarin">
                  <?
                    if ($jumlah_transaksi > $jumlah_transaksi_kemarin){
                      echo "+";
                    }

                    echo $beda_transaksi;
                  ?>
                </span>
                <span class="text-data-kemarin">
                  Dibanding kemarin
                </span>
              </div>
              <div class="deskripsi-ringkasan">
                Transaksi
              </div>
            </div>
          </div>
        </div>

        <div class="col-4">
          <div class="box-ringkasan">
            <div class="title-box-ringkasan">
              <span id="title-kiri">Barang Laku</span>
              <span id="title-kanan">Selama Hari Ini</span>
            </div>
            <div class="body-box-ringkasan">
              <div class="data-ringkasan">
                <?= $total_barang_laku; ?>
                <span class="data-kemarin">
                <? 
                  if ($total_barang_laku > $total_laku_kemarin){
                    echo "+";
                  }

                  echo $beda_barang;
                ?>
                </span>
                <span class="text-data-kemarin">
                  Dibanding kemarin
                </span>
              </div>
              <div class="deskripsi-ringkasan">
                Barang
              </div>
            </div>
          </div>
        </div>

        <div class="col-4">
          <div class="box-ringkasan">
            <div class="title-box-ringkasan">
              <span id="title-kiri">Pendapatan</span>
              <span id="title-kanan">Selama Hari Ini</span>
            </div>
            <div class="body-box-ringkasan">
              <div class="data-ringkasan-rupiah">
                <?                  
                  echo format_angka($total_penjualan);
                ?>
                <span class="data-kemarin">
                  <?
                    if ($total_penjualan > $total_penjualan_kemarin){
                      echo "+";
                    }
                    echo format_angka($beda_penjualan);
                  ?>
                </span>
                <span class="text-data-kemarin">
                  Dibanding kemarin
                </span>
              </div>
              <div class="deskripsi-ringkasan-rupiah">
                Rupiah
              </div>
            </div>
          </div>
        </div>

    </div>
  </div>

<?php require_once 'view/footer.php'; ?>