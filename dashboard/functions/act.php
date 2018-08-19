<?php

    function update($table, array $fields, $column, $where){
        
        foreach($fields as $key => $value){
            $data[] = $key . '=' . "'" . $value . "'";
        }

        $query = sprintf(
            "UPDATE %s SET %s WHERE %s = '%s'",
            $table,
            implode(", ", $data),
            $column,
            $where
        );

        return ambil($query);
    }

    function insert($table, array $fields){

        foreach ($fields as $key => $value){
            $values[] = "'" . $value . "'";
        }

        $query = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $table,
            implode(", ", array_keys($fields)),
            implode(", ", $values)
        );

        return ambil($query);
    }

    function ambil($query){
        global $link;
        
        if($ambil = mysqli_query($link, $query) or die(mysqli_error())){
            return $ambil;
        }
    }

    function getAll($table, $column = '*' ){
        $query = "SELECT $column FROM $table";

        return ambil($query);
    }

    function getLimit($table, $offset, $limit){
        $query = "SELECT * FROM $table LIMIT $offset, $limit";

        return ambil($query);
    }

    function getWhere($table, $column, $value, $data = '*')
    {
        $query = "SELECT $data FROM $table WHERE $column = '$value'";

        return ambil($query);
    }

    function ambil_max_kode($column, $table){
        $query = "SELECT max($column) as maxKode FROM $table";

        return ambil($query);
    }

    function set_kode_baru($key, $column, $table){
        $get_code = mysqli_fetch_assoc(ambil_max_kode($column, $table));
        $latest_code = $get_code['maxKode'];

        $noUrut = (int) substr($latest_code, 3, 3);
        $noUrut++;

        return $key . sprintf("%03s", $noUrut);
    }

    function getSearch($table, $column, $column2, $keyword){
        $query = "SELECT * FROM $table 
                    WHERE $column LIKE '%$keyword%' 
                    OR $column2 LIKE '%$keyword%'";

        return ambil($query);
    }

    function ambil_data_transaksi($hari_ini){
        $query = "SELECT COUNT(*) 
                    FROM penjualan
                    WHERE waktu
                    BETWEEN '$hari_ini 00:00:00' AND '$hari_ini 23:59:59'";
        
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

    function filter_suplai($dari, $sampai, $mulai, $halaman){
        $query = "SELECT * FROM suplai 
                    WHERE waktu 
                    BETWEEN '$dari 00:00:00' AND '$sampai 23:59:59'
                    ORDER BY waktu DESC 
                    LIMIT $mulai, $halaman";
        
        return ambil($query);
    }

    function filter_laporan_suplai($dari, $sampai){
        $query = "SELECT * FROM suplai WHERE waktu 
                    BETWEEN '$dari 00:00:00' AND '$sampai 23:59:59'";
        
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

    function kurang_barang($kode_barang, $jumlah_kurang){
        
        $data_jumlah_barang = getWhere('barang', 'kode_barang', $kode_barang, 'sisa');
        $jumlah_barang = mysqli_fetch_assoc($data_jumlah_barang);
        $jumlah = $jumlah_barang['sisa'];

        $hasil_kurang = $jumlah - $jumlah_kurang;

        update('barang', array('sisa' => $hasil_kurang), 'kode_barang', $kode_barang);
    }

    function tambah_pasokan_barang($kode_barang, $jumlah_pasokan){
        
        $ambil_sisa = getWhere('barang', 'kode_barang', $kode_barang, 'sisa');
        $ambil_jumlah = getWhere('barang', 'kode_barang', $kode_barang, 'jumlah');

        $data_sisa = mysqli_fetch_assoc($ambil_sisa);
        $data_jumlah = mysqli_fetch_assoc($ambil_jumlah);

        $sisa = $data_sisa['sisa'];        
        $jumlah = $data_jumlah['jumlah'];

        $hasil_tambah_sisa = $sisa + $jumlah_pasokan;
        $hasil_tambah_jumlah = $jumlah + $jumlah_pasokan;

        update('barang', array('jumlah' => $hasil_tambah_jumlah), 'kode_barang', $kode_barang); 
        update('barang', array('sisa' => $hasil_tambah_sisa), 'kode_barang', $kode_barang);
    }

    function kurang_stok_barang($kode_barang, $jumlah_kurang){
        
        $ambil_sisa = getWhere('barang', 'kode_barang', $kode_barang, 'sisa');
        $ambil_jumlah = getWhere('barang', 'kode_barang', $kode_barang, 'jumlah');

        $data_sisa = mysqli_fetch_assoc($ambil_sisa);
        $data_jumlah = mysqli_fetch_assoc($ambil_jumlah);

        $sisa = $data_sisa['sisa'];        
        $jumlah = $data_jumlah['jumlah'];

        $hasil_tambah_sisa = $sisa - $jumlah_kurang;
        $hasil_tambah_jumlah = $jumlah - $jumlah_kurang;

        update('barang', array('jumlah' => $hasil_tambah_jumlah), 'kode_barang', $kode_barang); 
        update('barang', array('sisa' => $hasil_tambah_sisa), 'kode_barang', $kode_barang);
     }
?>