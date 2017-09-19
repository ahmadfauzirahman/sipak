<?php
require_once 'data/sesi.php';
require_once 'data/koneksi.php';

if (isset($_REQUEST['id_lap'])) {
	$id_lap = $_REQUEST['id_lap'];
} else {
	echo "ID tidak ada";
	exit();
}

$sql = "SELECT * FROM laporan WHERE id_lap=$id_lap";
$stmt = $connect->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute(); 
$obj = $stmt->fetch();
?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Laporan</h1>
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
                                    <form role="form" id="myForm" action="" method="post" enctype="multipart/form-data" name="FUpload" id="FUpload">
                                        <div class="form-group">
                                            <label>Nama Kegiatan</label>
                                            <select class="form-control" name="id_keg" required>
                                                <option value="<?php echo $obj->id_keg; ?>" selected>
                                                    <?php 
                                                        $sql4 = "SELECT * FROM kegiatan WHERE id_keg=$obj->id_keg";
                                                        $stmt4 = $connect->prepare($sql4);
                                                        $stmt4->setFetchMode(PDO::FETCH_OBJ);
                                                        $stmt4->execute(); 
                                                        $obj4 = $stmt4->fetch();
                                                        echo $obj4->nama_keg; 
                                                    ?>
                                                </option>
                                                <?php 
                                                    $user = $_SESSION['id_user'];
                                                    $sql2 = "SELECT * FROM kegiatan WHERE id_user='$user' AND status_keg='Disetujui Direktur' AND id_keg NOT IN (SELECT id_keg FROM laporan) ORDER BY id_keg DESC";
                                                        $stmt2 = $connect->prepare($sql2);
                                                        $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                                                        $stmt2->execute();
                                                    while ($x = $stmt2->fetch()) { 
                                                ?>
                                                <option  value="<?php echo $x['id_keg']; ?>">
                                                    <?php echo $x['nama_keg']; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group" data-role="input">
                                            <label>Laporan</label>
                                            <input type="file" name="laporan" > <?php echo $obj->judul_lap; ?>
                                        </div>
                                        <div class="form-group" data-role="input">
                                            <label>Foto</label>
                                            <input type="file" name="foto" > <?php echo $obj->foto; ?>
                                        </div><br>
                                        <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
                                        <input type="hidden" name="id_lap" value="<?php echo $obj->id_lap; ?>">
                                        <input type="hidden" name="status_lap" value="Belum Disetujui">
                                        <br>
                                        <center><button type="submit" onclick="submitForm('data/simpan_laporan.php')" class="btn btn-primary">AJUKAN LAPORAN</button>
                                        <button type="submit" onclick="submitForm('data/draft_laporan.php')" class="btn btn-default">SIMPAN DRAFT</button></center>
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