$(document).ready(function(){
      
    $('#keyword').on('keyup', function(){
        $('#table').load('ajax/cari.php?keyword=' + $('#keyword').val());
    });

    $('#cari_pembeli').on('keyup', function(){
        $('#table').load('ajax/cari_pembeli.php?keyword=' + $('#cari_pembeli').val());
    });

    $('#cari_pemasok').on('keyup', function(){
        $('#table').load('ajax/cari_pemasok.php?keyword=' + $('#cari_pemasok').val());
    });

    $('#shift_button_pagi').click(function(){
        $('#table_pegawai').load('ajax/shift.php?shift=' + $('#shift_button_pagi').val());
        console.log('Ini jalan');
    });

    $('#shift_button_siang').click(function(){
        $('#table_pegawai').load('ajax/shift.php?shift=' + $('#shift_button_siang').val());
        console.log('Ini jalan');
    });

    $('#shift_button_malam').click(function(){
        $('#table_pegawai').load('ajax/shift.php?shift=' + $('#shift_button_malam').val());
        console.log('Ini jalan');
    });

    $('#kode_barang').change(function(){
        $('#harga-barang-form').load('ajax/harga_barang.php?kode_barang=' + $('option:selected').val(), function(){
            var harga = $('#hargaBarangBeli').val();
            var jumlah = $('#jumlahBarangBeli').val();
            var total = harga * jumlah;
            $('#totalHarga').val(total);               
        });
        console.log('On Change event jalan!');
    });

    $('#kode_barang_pasokan').change(function(){
        $('#nama_barang_form').load('ajax/pilih_nama_barang.php?kode_barang=' + $('#kode_barang_pasokan').val());
        console.log('On Change Kode Barang Jalan!');
    });

    $('#sebagai_admin').on('click', function(){
        $('#login-form-jualy').load('dashboard/ajax/login_form_admin.php');
        console.log('Ini jalan');
    });

    $('#jumlahBarangBeli').on('keyup', function(){
        var harga = $('#hargaBarangBeli').val();
        var jumlah = $('#jumlahBarangBeli').val();
        var total = harga * jumlah;
        $('#totalHarga').val(total);
        console.log('Ini jalan' + harga);   
    });

    $('#jumlahBarangPasokan').on('keyup', function(){
        var harga = $('#hargaBarangPasokan').val();
        var jumlah = $('#jumlahBarangPasokan').val();
        var total = harga * jumlah;
        $('#totalHarga').val(total);
        console.log('Ini jalan' + total);   
    });

    // $('#jumlahBarangBeli').on('keyup', function(){
    //     var harga = $('#hargaBarangBeli').val();
    //     var jumlah = $('#jumlahBarangBeli').val();
    //     var total = harga * jumlah;
    //     $('#totalHarga').val(total);
    //     console.log('Ini jalan' + harga);   
    // });

    $('#kode_barang_edit').change(function(){
        $('#harga-barang-form').load('ajax/harga_barang_edit.php?kode_barang=' + $('#kode_barang_edit').val(), function(){
            var harga = $('#harga-barang-edit').val();
            var jumlah = $('#jumlah-barang-edit').val();
            var total = harga * jumlah;
            $('#total-harga-edit').val(total);    
        });
        console.log('On Change Kode Barang Edit Jalan!');
    });

    $('#jumlah-barang-edit').on('keyup', function(){
        var harga = $('#harga-barang-edit').val();
        var jumlah = $('#jumlah-barang-edit').val();
        var total = harga * jumlah;
        $('#total-harga-edit').val(total);
        console.log('Ini jalan' + harga);   
    });

    $('#kode_barang_suplai').change(function(){
        $('#nama-barang-form').load('ajax/pilih_nama_barang_edit.php?kode_barang=' + $('#kode_barang_suplai').val());
        console.log('On Change Kode Barang Suplai Edit Jalan!');
    });

    $('#jumlah-barang-suplai').on('keyup', function(){
        var harga = $('#harga-barang-suplai').val();
        var jumlah = $('#jumlah-barang-suplai').val();
        var total = harga * jumlah;
        $('#total-harga-suplai').val(total);
        console.log('Ini jalan' + harga);   
    });

    $('#harga-barang-suplai').on('keyup', function(){
        var harga = $('#harga-barang-suplai').val();
        var jumlah = $('#jumlah-barang-suplai').val();
        var total = harga * jumlah;
        $('#total-harga-suplai').val(total);
        console.log('Ini jalan' + harga);   
    });

    $(function() {
        $('input[name="daterange"]').daterangepicker({
          opens: 'left'
        }, function(start, end, label) {
          console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
          $('#table').load('ajax/penjualan_filter.php?dari=' + start.format('YYYY-MM-DD') + '&sampai=' + end.format('YYYY-MM-DD'));        
        });
      });

      $(function() {
        $('input[id="suplai"]').daterangepicker({
          opens: 'left'
        }, function(start, end, label) {
          console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
          $('#table').load('ajax/suplai_filter.php?dari=' + start.format('YYYY-MM-DD') + '&sampai=' + end.format('YYYY-MM-DD'));        
        });
      });

    //   $( "input[type='checkbox']" ).prop( "checked", function() {
    //     console.log("Yuhuuu bisaa");
    //   });

    //   $( "input[type='checkbox']" ).prop( "disabled", function() {
    //     console.log("Yuhuuu bisaa");
    //   });

      $("input[type='checkbox']").on('click', function(){
        if($(this).prop("checked"))
            $('#id_pembeli_form').load('ajax/data_pelanggan.php');
        else
            $('#id_pembeli_form').load('ajax/data_pembeli.php');        
    });
  
});
