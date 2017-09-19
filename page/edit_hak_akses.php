<?php
require_once 'data/sesi.php';
require_once 'data/koneksi.php';

if (isset($_REQUEST['id_user'])) {
	$id_user = $_REQUEST['id_user'];
} else {
	echo "ID tidak ada";
	exit();
}

$lvl = array("Pegawai","Pudir", "Sekdir", "Direktur", "Administrator");

$sql = "SELECT * FROM user WHERE id_user=$id_user";
$stmt = $connect->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute(); 
$obj = $stmt->fetch();
?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Hak Akses</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="data/simpan_hak_akses.php" method="post" enctype="multipart/form-data" name="FUpload" id="FUpload">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input  type ="text" class="form-control" name="username" value="<?php echo $obj->username; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input  type ="password" class="form-control" name="password" value="<?php echo $obj->password; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type ="text" class="form-control" name="nama" value="<?php echo $obj->nama; ?>"required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type ="email" class="form-control" name="email" value="<?php echo $obj->email; ?>"required>
                                        </div>
                                        <div class="form-group">
                                            <label>Level</label>
                                            <select class="form-control" name="level" required>
                                                <?php foreach ($lvl as $v) { ?>
                                                    <option <?php echo $v==$obj->level ? 'selected' : ''; ?>>
                                                    <?php echo $v; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <center><button type="submit" class="btn btn-primary">SIMPAN</button></center>
										<input type="hidden" name="id_user" value="<?php echo $obj->id_user; ?>">
									</form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->