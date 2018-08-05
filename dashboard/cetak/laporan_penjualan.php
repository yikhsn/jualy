<?php

    require '../functions/act.php';
    require '../functions/db.php';
    require '../lib/fpdf/fpdf.php';

    $range = $_GET['waktu'];
    $waktu = explode(' - ', $range);
    
    $mulai = $waktu[0];
    $sampai = $waktu[1];
    
    $ubahformatmulai = explode('/', $mulai);
    $mulai1 = $ubahformatmulai[0];
    $mulai2 = $ubahformatmulai[1];
    $mulai3 = $ubahformatmulai[2];
    $mulai = $mulai3 . '-' . $mulai1 . '-' . $mulai2;

    $ubahformatsampai = explode('/', $sampai);
    $sampai1 = $ubahformatsampai[0];
    $sampai2 = $ubahformatsampai[1];
    $sampai3 = $ubahformatsampai[2];

    $sampai = $sampai3 . '-' . $sampai1 . '-' . $sampai2;

    $pdf = new FPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',20);
    $pdf->Cell(55, 10, '', 0, 0);        
    $pdf->Cell(90, 10, 'LAPORAN PENJUALAN', 0, 0);    
    $pdf->Cell(45, 10, '', 0, 1);
            
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(63, 7, '', 0, 0);        
    $pdf->Cell(100, 7, 'SUPERMARKET JUALY', 0, 0);    
    $pdf->Cell(45, 7, '', 0, 1);

    $pdf->Cell(190, 10, '', 0, 1);    

    $pdf->SetFont('Arial','B', 10);
    $pdf->Cell(20, 5, 'Tanggal', 0, 0);
    $pdf->Cell(2, 5, ':', 0, 0);                    
    $pdf->Cell(168, 5, $mulai . ' s/d ' . $sampai, 0, 1);    

    $pdf->Cell(190, 5, '', 0, 1);    

    $pdf->SetFont('Arial','B', 8);
    $pdf->Cell(7, 10, 'No', 1, 0);
    $pdf->Cell(50, 10, 'Tanggal', 1, 0);
    $pdf->Cell(45, 10, 'Jumlah', 1, 0);
    $pdf->Cell(43, 10, 'Harga', 1, 0);
    $pdf->Cell(45, 10, 'Total Harga', 1, 1);

    $total_barang_laku = 0;
    $total_penjualan = 0;

    $ambil_data = filter_laporan_penjualan($mulai, $sampai);
    $i = 1;
    while($data = mysqli_fetch_assoc($ambil_data)){

      $pdf->SetFont('Arial','B', 8);
      $pdf->Cell(7, 10, $i++, 1, 0);
      $pdf->Cell(50, 10, $data['waktu'], 1, 0);
      $pdf->Cell(45, 10, format_angka($data['jumlah']), 1, 0);
      $pdf->Cell(43, 10, rupiah($data['harga']), 1, 0);
      $pdf->Cell(45, 10, rupiah($data['total_harga']), 1, 1);

      $total_penjualan = $total_penjualan + $data['total_harga'];
      $total_barang_laku = $total_barang_laku + $data['jumlah'];
    }

    $pdf->SetFont('Arial','B', 9);
    $pdf->Cell(120, 10, "Jumlah Barang Laku", 1, 0);
    $pdf->Cell(70, 10, format_angka($total_barang_laku), 1, 1);
    $pdf->Cell(120, 10, "Jumlah Pendapatan", 1, 0);
    $pdf->Cell(70, 10, rupiah($total_penjualan), 1, 1);
  
    $pdf->Output();    
?>