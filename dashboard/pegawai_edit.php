<?php
    require_once 'core/init.php';

    if($_SESSION['username']!="admin"){
        header('location: ../index.php');                    
    }

    $id = $_GET['id'];    
    
    if(isset($_POST['update_pegawai'])){

        $fields = array(
            'nama_pegawai'  => $_POST['nama_pegawai'],
            'shift'         => $_POST['shift'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'alamat'        => $_POST['alamat'],
            'no_hape'       => $_POST['no_hape']    
        );

        update('pegawai', $fields, 'id_pegawai', $id);
        
        header('Location: pegawai.php');
    }

    require_once 'view/header.php';    
 
    $data = getWhere('pegawai', 'id_pegawai', $id);

    while ($row = mysqli_fetch_array($data)){
?>

<br>
<br>

<div class="container-fluid">
    <form id="data" action="" method="post">
        <div class="row">
            <div class="col-12">
                <h3>Edit <?php echo $row['nama_pegawai'] ?></h3>
                <table class="table">
                <tr>
                        <td>ID Pegawai</td>
                        <td><?php echo $id = $row['id_pegawai']?></td>
                    </tr>
                    <tr>
                        <td id="nama_td">Nama Pegawai</td>
                        <td><input name="nama_pegawai" type="text" class="form-control" value="<?php echo $row['nama_pegawai']?>"></td>
                    </tr>
                    <tr>
                        <td>Shift</td>
                        <td><input name="shift" type="text" class="form-control" value="<?php echo $row['shift']?>"></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td><input name="jenis_kelamin" type="text" class="form-control" value="<?php echo $row['jenis_kelamin']?>"></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><input name="alamat" type="text" class="form-control" value="<?php echo $row['alamat']?>"></td>
                    </tr>
                    <tr>
                        <td>No Handphone</td>
                        <td><input name="no_hape" type="text" class="form-control" value="<?php echo $row['no_hape']?>"></td>
                    </tr>
                </table>
            </div>
        </div>

<?php } ?> 

        <div class="row justify-content-end mr-3">
            <input type="button" id="hapus" class="btn btn-outline-secondary mx-1"
                onclick="if(confirm('Apakah kamu yakin ingin menghapus barang ini?')){
                        location.href='pegawai_hapus.php?id=<?= $id ?>'
                        }" value="Hapus">
            <input type="submit" name="update_pegawai" class="btn btn-secondary mx-1" value="Simpan">            
        </div>
    </form>
</div>

<?php require_once 'view/footer.php'; ?>