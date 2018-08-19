<?php

    require '../functions/act.php';
    require '../functions/db.php';
    require '../lib/fpdf/fpdf.php';

    $ambil_kode_transaksi = ambil_max_kode('kode_transaksi', 'penjualan');

    $data_kode_transaksi = mysqli_fetch_assoc($ambil_kode_transaksi);
    $edit_kode_transaksi = $data_kode_transaksi['maxKode'];

    $sql = getLimitWhere('penjualan', 'kode_transaksi', $edit_kode_transaksi);
    $data = array();


    $pdf = new FPDF('P','mm',array(80,100));
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(60, 7, 'SUPERMARKET JUALY', 0, 1);

    $pdf->Cell(80, 3, '', 0, 1);

    $pdf->SetFont('Arial','B',6);    
    
    $pdf->Cell(30, 3, 'No. 34, Jl. Kalimantan, Bukit Indah,', 0, 1);
    $pdf->Cell(30, 3, 'Banda Sakti, Lhokseumawe', 0, 1);    
    $pdf->Cell(80, 3, '', 0, 1);    

    while($row = mysqli_fetch_assoc($sql)){

        $pdf->Cell(80, 3, $row['waktu'], 0, 1);
        
        $pdf->Cell(20, 3, 'Kode Transaksi', 0, 0);
        $pdf->Cell(2, 3, ':', 0, 0);
        $pdf->Cell(58, 3, $row['kode_transaksi'], 0, 1);

        $pdf->Cell(20, 3, 'ID Pegawai', 0, 0);
        $pdf->Cell(2, 3, ':', 0, 0);
        $pdf->Cell(58, 3, $row['id_pegawai'], 0, 1);

        $pdf->Cell(20, 3, 'ID Pembeli', 0, 0);
        $pdf->Cell(2, 3, ':', 0, 0);
        $pdf->Cell(58, 3, $row['id_pembeli'], 0, 1);

        $pdf->Cell(20, 3, 'Kode Barang', 0, 0);
        $pdf->Cell(2, 3, ':', 0, 0);
        $pdf->Cell(58, 3, $row['kode_barang'], 0, 1);

        $pdf->Cell(20, 3, 'Harga per Satuan', 0, 0);
        $pdf->Cell(2, 3, ':', 0, 0);
        $pdf->Cell(58, 3, $row['harga'], 0, 1);

        $pdf->Cell(20, 3, 'Jumlah', 0, 0);
        $pdf->Cell(2, 3, ':', 0, 0);
        $pdf->Cell(58, 3, $row['jumlah'], 0, 1);

        $pdf->Cell(20, 3, 'Total Harga', 0, 0);
        $pdf->Cell(2, 3, ':', 0, 0);
        $pdf->Cell(58, 3, $row['total_harga'], 0, 1);
    }

    $pdf->Output();    
?>