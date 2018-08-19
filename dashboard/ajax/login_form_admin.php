<?
    require '../functions/act.php';
    require '../functions/db.php';

?>
<div class="card-wrapper">
    <!-- <div class="brand">
        <img src="img/logo.jpg">
    </div> -->
    <div class="card fat">
        <div class="card-body">
            <h4 class="card-title">Login</h4>
            <form action="validate_admin.php" method="POST">
                
                <div class="form-group">
                    <input id="admin" type="text" value="admin" class="form-control" name="admin" value="" readonly autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required data-eye>
                </div>
                
                <div class="form-group no-margin">
                    <button type="submit" class="btn btn-secondary btn-block">
                        Masuk
                    </button>
                    <a href="" class="teks_ganti_user" id="sebagai_pegawai" value="pegawai">
                        Masuk sebagai pegawai
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>