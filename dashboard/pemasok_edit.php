<?php 
    require_once 'core/init.php';

    $id = $_GET['id'];    

    if(isset($_POST['update_pemasok'])){
        
        $fields = array(
            'nama_pemasok'  => $_POST['nama_pemasok'],
            'alamat'        => $_POST['alamat'],
            'barang'        => $_POST['barang'],
            'telepon'       => $_POST['telepon']
        );

        update('pemasok', $fields, 'id_pemasok', $id);
        header('Location: pemasok.php');
    }

    if(!isset($_SESSION['username'])){
        header('location: ../index.php');            
    }

    if($_SESSION['username']!="admin"){
        header('location: ../index.php');                    
    }

    require_once 'view/header.php';    

    $data = getWhere('pemasok', 'id_pemasok', $id);
    
    while ($row = mysqli_fetch_array($data)){
?>

<br>
<br>

<div class="container-fluid">
    <form id="data" action="" method="post">
        <div class="row">
            <div class="col-12">
                <h3>Edit <?php echo $row['nama_pemasok'] ?></h3>
                <table class="table">
                <tr>
                        <td>ID Pemasok</td>
                        <td><?php echo $id = $row['id_pemasok']?></td>
                    </tr>
                    <tr>
                        <td id="nama_td">Nama Pemasok</td>
                        <td><input name="nama_pemasok" type="text" class="form-control" value="<?php echo $row['nama_pemasok']?>"></td>
                    </tr>
                    <tr>
                        <td>Barang</td>
                        <td><input name="barang" type="text" class="form-control" value="<?php echo $row['barang']?>"></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><input name="alamat" type="text" class="form-control" value="<?php echo $row['alamat']?>"></td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td><input name="telepon" type="text" class="form-control" value="<?php echo $row['telepon']?>"></td>
                    </tr>
                </table>
            </div>
        </div>

<?php } ?> 

        <div class="row justify-content-end mr-3">
            <input type="button" id="hapus" class="btn btn-outline-secondary mx-1"
                onclick="if(confirm('Apakah kamu yakin ingin menghapus pemasok ini?')){
                        location.href='pemasok_hapus.php?id=<?= $id ?>'
                        }" value="Hapus">
            <input type="submit" name="update_pemasok" class="btn btn-secondary mx-1" value="Simpan">            
        </div>
    </form>
</div>

<?php require_once 'view/footer.php'; ?>