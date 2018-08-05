<?php

    function ambil($query){
        global $link;
        
        if($ambil = mysqli_query($link, $query) or die(mysqli_error())){
            return $ambil;
        }
    }
    function ambil_data_transaksi($hari_ini){
        $query = "SELECT COUNT(*) 
                    FROM penjualan
                    WHERE waktu
                    BETWEEN '$hari_ini 00:00:00' AND '$hari_ini 23:59:59'";
        
        return ambil($query); 
    }

    function ambil_kode_barang(){
        $query = "SELECT max(kode_barang) AS maxKode from barang";
        
        return ambil($query);
    }

    function ambil_kode_suplai(){
        $query = "SELECT max(kode_suplai) AS maxKode from suplai";

        return ambil($query);
    }

    function ambil_id_pemasok(){
        $query = "SELECT max(id_pemasok) AS maxId from pemasok";
        
        return ambil($query);
    }

    function ambil_id_pembeli(){
        $query = "SELECT max(id_pembeli) AS maxId from pembeli";
        
        return ambil($query);
    }

    function ambil_kode_transaksi(){
        $query = "SELECT max(kode_transaksi) AS maxKode from penjualan";
        
        return ambil($query);
    }
    
    function ambil_kode_transaksi_terbaru(){
        $query = "SELECT max(kode_transaksi) AS maxKode from penjualan";
        
        return ambil($query);
    }

    function ambil_nama_pegawai($kode_username){
        $query = "SELECT nama_pegawai FROM pegawai WHERE id_pegawai='$kode_username'";

        return ambil($query);
    }

    function ambil_id_pegawai(){
        $query = "SELECT max(id_pegawai) AS maxId from pegawai";
        
        return ambil($query);
    }

    function tampilkan_barang($mulai, $halaman){
        $query = "SELECT * FROM barang LIMIT $mulai, $halaman";
        return ambil($query);
    }
    
    function detail_barang($kode){
        $query = "SELECT * FROM barang WHERE kode_barang='$kode'";
        
        return ambil($query);
    }

    function detail_barang_baru($kode){
        $query = "SELECT * FROM barang WHERE kode_barang='$kode'";
        
        return ambil($query);
    }

    function cari_barang($cari){
        $query = "SELECT * FROM barang WHERE nama_brg LIKE '%$cari%' OR kode_barang LIKE '%$cari%'";
        return ambil($query);
    }

    function cari_pembeli($cari){
        $query = "SELECT * FROM pembeli WHERE nama LIKE '%$cari%' OR id_pembeli LIKE '%$cari%'";
        
        return ambil($query);
    }

    function cari_pemasok($cari){
        $query = "SELECT * FROM pemasok WHERE nama_pemasok LIKE '%$cari%' OR id_pemasok LIKE '%$cari%'";
        
        return ambil($query);
    }

    function tambah_barang($nama, $jenis, $harga, $kode, $jumlah, $sisa, $suplier){
        $query = "INSERT INTO barang (nama_brg, jenis_brg, kode_barang, harga_brg, jumlah, sisa, suplier) 
                  VALUES('$nama', '$jenis', '$kode', $harga, $jumlah, $sisa, '$suplier')"
                  or die(mysqli_error());

        return ambil($query);
    }

    function update($nama, $jenis, $kode, $harga, $jumlah, $sisa, $suplier){
        $query = "UPDATE barang 
                        SET nama_brg='$nama', jenis_brg='$jenis', harga_brg='$harga',
                        jumlah='$jumlah', sisa='$sisa', suplier='$suplier'
                        WHERE kode_barang='$kode'";
    
        return ambil($query);
    }

    function menghitung_record(){
        $query = "SELECT COUNT(*) FROM barang";
        return ambil($query);
    }

    function pilih_jenis(){
        $query = "SELECT DISTINCT(jenis_brg) AS jenis_brg FROM barang";
        return ambil($query);
    }

    

    function pilih_pelanggan(){
        $query = "SELECT id_pembeli FROM pembeli";

        return ambil($query);
    }

    function tampilkan_pegawai($mulai, $halaman){
        $query = "SELECT * FROM pegawai LIMIT $mulai, $halaman";
        return ambil($query);
    }

    function tampilkan_semua_pegawai(){
        $query = "SELECT * FROM pegawai";
        return ambil($query);
    }

    function filter_pegawai($shift) {
        $query = "SELECT * FROM pegawai WHERE shift='$shift'";

        return ambil($query);
    }

    function tambah_pegawai($id_pegawai, $nama_pegawai, $shift, $jenis_kelamin, $alamat, $no_hape){
        $query = "INSERT INTO pegawai (id_pegawai, nama_pegawai, shift, jenis_kelamin, alamat, no_hape)
                               VALUES('$id_pegawai', '$nama_pegawai', '$shift', '$jenis_kelamin', '$alamat', '$no_hape')" 
                               or die(mysqli_error());

        return ambil($query);
    }

    function detail_pegawai($id){
        $query = "SELECT * FROM pegawai 
                    WHERE id_pegawai='$id'";
        
        return ambil($query);
    }

    function update_pegawai($id, $nama, $shift, $jenis_kelamin, $alamat, $no_hape){
        $query = "UPDATE pegawai SET  nama_pegawai='$nama', shift='$shift', jenis_kelamin='$jenis_kelamin', alamat='$alamat', no_hape='$no_hape'
                         WHERE id_pegawai='$id'";
    
        return ambil($query);
    }

    function tampilkan_pemasok($mulai, $halaman){
        $query = "SELECT * FROM pemasok 
                    LIMIT $mulai, $halaman";
        
        return ambil($query);
    }

    function tambah_pemasok($id_pemasok, $nama_pemasok, $alamat, $barang, $telepon) {
        $query = "INSERT INTO pemasok (id_pemasok, nama_pemasok, alamat, barang, telepon) 
                                VALUES('$id_pemasok', '$nama_pemasok', '$alamat', '$barang', '$telepon')"
                                or die(mysqli_error());
        
        return ambil($query);
    }

    function pilih_penyuplai(){
        $query = "SELECT nama_pemasok FROM pemasok";

        return ambil($query);
    }

    function detail_pemasok($id) {
        $query = "SELECT * FROM pemasok
                    WHERE id_pemasok='$id'";
        return ambil($query);
    }

    function update_pemasok($id, $nama, $barang, $telepon, $alamat) {
        $query = "UPDATE pemasok 
                    SET nama_pemasok='$nama', barang='$barang', telepon='$telepon', alamat='$alamat' 
                    WHERE id_pemasok='$id'";

        return ambil($query);
    }

    function tampilkan_pembeli($mulai, $halaman){
        $query = "SELECT * FROM pembeli LIMIT $mulai, $halaman";
        
        return ambil($query);
    }

    function tambah_pembeli($id_pembeli, $nama, $alamat, $jenis_kelamin) {
        $query = "INSERT INTO pembeli (id_pembeli, nama, alamat, jenis_kelamin)
                            VALUES('$id_pembeli', '$nama', '$alamat', '$jenis_kelamin')"
                            or die(mysqli_error());

        return ambil($query);
    }

    function detail_pembeli($id) {
        $query = "SELECT * FROM pembeli WHERE id_pembeli='$id'";
        
        return ambil($query);
    }

    function update_pembeli($id, $nama, $jenis_kelamin, $alamat){
        $query = "UPDATE pembeli 
                    SET nama='$nama', jenis_kelamin='$jenis_kelamin', alamat='$alamat' 
                    WHERE id_pembeli='$id'";

        return ambil($query);
    }

    function tambah_pembeli_biasa($id_pembeli) {
        $query = "INSERT INTO pembeli (id_pembeli) 
                        VALUES('$id_pembeli')" 
                        or die(mysqli_error());

        return ambil($query);
    }

    function tampilkan_penjualan($mulai, $halaman){
        $query = "SELECT * FROM penjualan 
                    ORDER BY waktu DESC 
                    LIMIT $mulai, $halaman ";
        
        return ambil($query);
    }

    function filter_penjualan($dari, $sampai, $mulai, $halaman){
        $query = "SELECT * FROM penjualan 
                    WHERE waktu 
                    BETWEEN '$dari 00:00:00' AND '$sampai 23:59:59'
                    ORDER BY waktu DESC 
                    LIMIT $mulai, $halaman";
        
        return ambil($query);
    }

    function filter_laporan_penjualan($dari, $sampai){
        $query = "SELECT * FROM penjualan 
                    WHERE waktu 
                    BETWEEN '$dari 00:00:00' AND '$sampai 23:59:59'
                    ORDER BY waktu DESC";
        
        return ambil($query);
    }

    function tampilkan_penjualan_terbaru($kode_transaksi){
        $query = "SELECT * FROM penjualan WHERE kode_transaksi='$kode_transaksi'";
        
        return ambil($query);
    }

    function tambah_penjualan($kode_transaksi, $id_pembeli, $id_pegawai, $waktu, $kode_barang, $jumlah, $harga, $total_harga) {
        $query = "INSERT INTO penjualan (kode_transaksi, id_pembeli, id_pegawai, waktu, kode_barang, jumlah, harga, total_harga)
                        VALUES('$kode_transaksi', '$id_pembeli', '$id_pegawai', '$waktu', '$kode_barang', '$jumlah', '$harga', '$total_harga')" or die(mysqli_error());
    
        return ambil($query);
    }

    function detail_penjualan($id) {
        $query = "SELECT * FROM penjualan WHERE kode_transaksi='$id'";
        
        return ambil($query);
    }

    function update_penjualan($id, $id_pembeli, $id_pegawai, $waktu, $kode_barang, $jumlah, $harga, $total_harga){
        $query = "UPDATE penjualan SET  id_pembeli='$id_pembeli', id_pegawai='$id_pegawai', waktu='$waktu', kode_barang='$kode_barang', jumlah='$jumlah', harga='$harga', total_harga='$total_harga'
                         WHERE kode_transaksi='$id'";
    
        return ambil($query);
    }

    function pilih_kode_barang(){
        $query = "SELECT DISTINCT(kode_barang) AS kode_barang FROM barang ORDER BY kode_barang ASC";
        
        return ambil($query);
    }

    function ambil_harga_barang($kode_barang){
        $query = "SELECT harga_brg FROM barang WHERE kode_barang='$kode_barang'";

        return ambil($query);
    }

    function ambil_nama_barang($kode_barang){
        $query = "SELECT nama_brg FROM barang WHERE kode_barang='$kode_barang'";

        return ambil($query);
    }

    function tampilkan_suplai($mulai, $halaman){
        $query = "SELECT * FROM suplai ORDER BY waktu DESC LIMIT $mulai, $halaman";
        
        return ambil($query);
    }

    function filter_suplai($dari, $sampai, $mulai, $halaman){
        $query = "SELECT * FROM suplai 
                    WHERE waktu 
                    BETWEEN '$dari 00:00:00' AND '$sampai 23:59:59'
                    ORDER BY waktu DESC 
                    LIMIT $mulai, $halaman";
        
        return ambil($query);
    }

    function tambah_suplai($kode_suplai, $id_pemasok, $waktu, $kode_barang, $nama_barang, $jumlah, $harga, $total_harga){
        $query = "INSERT INTO suplai (kode_suplai, id_pemasok, waktu, kode_barang, nama_barang, jumlah, harga, total_harga)
        VALUES('$kode_suplai', '$id_pemasok', '$waktu', '$kode_barang', '$nama_barang', '$jumlah', '$harga', '$total_harga')"
            or die(mysqli_error());

        return ambil($query);
    }

    function filter_laporan_suplai($dari, $sampai){
        $query = "SELECT * FROM suplai WHERE waktu BETWEEN '$dari 00:00:00' AND '$sampai 23:59:59'";
        
        return ambil($query);
    }

    function detail_suplai($id) {
        $query = "SELECT * FROM suplai WHERE kode_suplai='$id'";
        
        return ambil($query);
    }

    function update_suplai($id, $id_pemasok, $waktu, $kode_barang, $nama_barang, $jumlah, $harga, $total_harga) {
        $query = "UPDATE suplai SET id_pemasok='$id_pemasok', waktu='$waktu', kode_barang='$kode_barang', nama_barang='$nama_barang', jumlah='$jumlah', 
                                    harga='$harga', total_harga='$total_harga' WHERE kode_suplai='$id'";

        return ambil($query);
    }

    function pilih_pemasok(){
        $query = "SELECT DISTINCT(id_pemasok) AS id_pemasok FROM pemasok";

        return ambil($query);
    }

    function rupiah($angka){
        $hasil_rupiah = "Rp. " . number_format($angka,0,'','.');
        
        return $hasil_rupiah;
    }

    function format_angka($angka){
        $hasil = number_format($angka, 0, '', '.');

        return $hasil;
    }

    function lihat_jumlah_barang($kode_barang){
        $query = "SELECT sisa FROM barang WHERE kode_barang='$kode_barang'";

        return ambil($query);
    }

    function update_sisa_barang($kode_barang, $hasil){
        $query = "UPDATE barang SET sisa='$hasil' WHERE kode_barang='$kode_barang'";
    
        return ambil($query);
    }

    function update_jumlah_barang($kode_barang, $hasil){
        $query = "UPDATE barang SET jumlah='$hasil' WHERE kode_barang='$kode_barang'";
    
        return ambil($query);
    }

    function kurang_barang($kode_barang, $jumlah_kurang){
        
        $data_jumlah_barang = lihat_jumlah_barang($kode_barang);
        $jumlah_barang = mysqli_fetch_assoc($data_jumlah_barang);
        $jumlah = $jumlah_barang['sisa'];

        $hasil_kurang = $jumlah - $jumlah_kurang;

        update_sisa_barang($kode_barang, $hasil_kurang);
    }

    function sisa_barang($kode_barang){
        $query = "SELECT sisa FROM barang WHERE kode_barang='$kode_barang'";

        return ambil($query);
    }

    function jumlah_barang($kode_barang){
        $query = "SELECT jumlah FROM barang WHERE kode_barang='$kode_barang'";

        return ambil($query);
    }

    function tambah_pasokan_barang($kode_barang, $jumlah_pasokan){
        
        $ambil_sisa = sisa_barang($kode_barang);
        $ambil_jumlah = jumlah_barang($kode_barang);

        $data_sisa = mysqli_fetch_assoc($ambil_sisa);
        $data_jumlah = mysqli_fetch_assoc($ambil_jumlah);

        $sisa = $data_sisa['sisa'];        
        $jumlah = $data_jumlah['jumlah'];

        // echo $sisa;
        // echo $jumlah;
        // echo $jumlah_pasokan;

        $hasil_tambah_sisa = $sisa + $jumlah_pasokan;
        $hasil_tambah_jumlah = $jumlah + $jumlah_pasokan;

        // echo $hasil_tambah_sisa;
        // echo $hasil_tambah_jumlah;

        update_jumlah_barang($kode_barang, $hasil_tambah_jumlah);           
        update_sisa_barang($kode_barang, $hasil_tambah_sisa);
    }

    function kurang_stok_barang($kode_barang, $jumlah_kurang){
        
        $ambil_sisa = sisa_barang($kode_barang);
        $ambil_jumlah = jumlah_barang($kode_barang);

        $data_sisa = mysqli_fetch_assoc($ambil_sisa);
        $data_jumlah = mysqli_fetch_assoc($ambil_jumlah);

        $sisa = $data_sisa['sisa'];        
        $jumlah = $data_jumlah['jumlah'];

        // echo $sisa;
        // echo $jumlah;
        // echo $jumlah_pasokan;

        $hasil_tambah_sisa = $sisa - $jumlah_kurang;
        $hasil_tambah_jumlah = $jumlah - $jumlah_kurang;

        // echo $hasil_tambah_sisa;
        // echo $hasil_tambah_jumlah;

        update_jumlah_barang($kode_barang, $hasil_tambah_jumlah);           
        update_sisa_barang($kode_barang, $hasil_tambah_sisa);
    }
?>