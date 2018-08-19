<?php
    require_once 'core/init.php';
    
    if(!isset($_SESSION['username'])){
        header('location: ../index.php');
    }

    $id = $_GET['id'];
    
    if(isset($_POST['update_pembeli'])){
        $nama = $_POST['nama'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];

        update_pembeli($id, $nama, $jenis_kelamin, $alamat);
        header('Location: pembeli.php');
    }

    require_once 'view/header.php';    

    $data = getLimitWhere('pembeli', 'id_pembeli', $id);
    
    while ($row = mysqli_fetch_array($data)){
?>

<br>
<br>

<div class="container-fluid">
    <form id="data" action="" method="post">
        <div class="row">
            <div class="col-12">
                <h3>Edit <?php echo $row['nama'] ?></h3>
                <table class="table">
                <tr>
                        <td>ID Pembeli</td>
                        <td><?php echo $id = $row['id_pembeli']?></td>
                    </tr>
                    <tr>
                        <td id="nama_td">Nama Pembeli</td>
                        <td><input name="nama" type="text" class="form-control" value="<?php echo $row['nama']?>"></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><input name="alamat" type="text" class="form-control" value="<?php echo $row['alamat']?>"></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>
                            <select name="jenis_kelamin" class="custom-select" id="jenis_kelamin">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

<?php } ?> 

        <div class="row justify-content-end mr-3">
            <input type="button" id="hapus" class="btn btn-outline-secondary mx-1"
                onclick="if(confirm('Apakah kamu yakin ingin menghapus data pembeli ini?')){
                        location.href='pembeli_hapus.php?id=<?= $id ?>'
                        }" value="Hapus">
            <input type="submit" name="update_pembeli" class="btn btn-secondary mx-1" value="Simpan">            
        </div>
    </form>
</div>

<?php require_once 'view/footer.php'; ?>