<?php
require_once 'data/sesi.php';
require_once 'data/koneksi.php';

if (isset($_REQUEST['id_keg'])) {
	$id_keg = $_REQUEST['id_keg'];
} else {
	echo "ID tidak ada";
	exit();
}

$dana = array("Anggaran Tahunan Poltekkes","Dana Mandiri","Dana Sponsor");

$sql = "SELECT * FROM kegiatan WHERE id_keg=$id_keg";
$stmt = $connect->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute(); 
$obj = $stmt->fetch();

$sql4 = "SELECT * FROM pelaksana WHERE id_keg=$id_keg";
$stmt4 = $connect->prepare($sql4);
$stmt4->setFetchMode(PDO::FETCH_OBJ);
$stmt4->execute(); 
?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Kegiatan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <form role="form" id="myForm" action="" method="post" enctype="multipart/form-data" name="FUpload" id="FUpload">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Kegiatan</label>
                                            <input  type ="text" class="form-control" name="nama_keg" value="<?php echo $obj->nama_keg; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label><br>
                                            <div class="col-lg-5">
                                            <input  type ="date" class="form-control" name="tgl_keg" value="<?php echo $obj->tgl_keg; ?>" required >
                                            </div>
                                            <div class="col-lg-2 text-center" style="height:34;line-height: 2.5;font-weight: bold;">s/d</div>
                                            <div class="col-lg-5">
                                            <input  type ="date" class="form-control" name="tgl2_keg" value="<?php echo $obj->tgl2_keg; ?>">
                                            </div>
                                        </div><br><br>
                                        <div class="form-group">
                                            <label>Tempat</label>
                                            <input type ="text" class="form-control" name="tmp_keg" value="<?php echo $obj->tmp_keg; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Dana</label>
                                            <select class="form-control" name="dana_keg" required>
                                                 <?php 
                                                    foreach ($dana as $w) { ?>
                                                <option  value="<?php echo $w; ?>" <?php echo $w==$obj->dana_keg ? 'selected' : ''; ?>>
                                                    <?php echo $w; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Pelaksana</label>
                                           <?php 
                                                $id_keg=$obj->id_keg;
                                                $sqlx = "SELECT COUNT(*) c FROM pelaksana WHERE id_keg='$id_keg' ";
                                                $stmtx = $connect->prepare($sqlx);
                                                $stmtx->setFetchMode(PDO::FETCH_ASSOC);
                                                $stmtx->execute();
                                                $p = $stmtx->fetch();
                                                $j = (int)$p['c'];
                                            ?>
                                            <input type="number" class="form-control" id="plk" name="plk_keg" value="<?php echo $j;?>" readonly="readonly"><br>
                                            <input type="number" class="form-control" id="member" name="plk2_keg">
                                            <a href="#" id="viewdetails" onclick="viewFields()">Tambah Data Pelaksana</a>

                                        </div>

                                        <div id="container2">
                                            <?php
                                                $no=1;
                                                while ($x = $stmt4->fetch()) { $urut=$no-1;?>
                                                    <label>Pelaksana <?php echo $no++;?></label>&nbsp;&nbsp;&nbsp;
                                                     <a href="data/hapus_pelaksana.php?id_plk=<?php echo $x->id_plk; ?>" onClick="return confirm('Hapus Data <?php echo $x->nama_plk;?>?')"><button type="button" class="btn btn-danger btn-xs <?php if($y['status_keg']=="Menunggu Persetujuan Direktur" || $y['status_keg']=="Disetujui Direktur"){echo 'disabled';}?>"><i class="fa fa-times fa-fw"></i><strong>HAPUS</strong>
                                                </button></a>
                                                    <input type="hidden" class="form-control" name="id<?php echo $urut;?>" value="<?php echo $x->id_plk;?>" >
                                                    <input type="text" class="form-control" name="nama<?php echo $urut;?>" value="<?php echo $x->nama_plk;?>" placeholder="Nama">
                                                    <input type="text" class="form-control" name="nip<?php echo $urut;?>" value="<?php echo $x->nip_plk;?>" placeholder="NIP"> 
                                                    <?php
                                                        $pangkat2 = ["Juru Muda / I.a","Juru Muda Tingkat I / II.b","Juru / I.c","Juru Tingkat I / I.d","Pengatur Muda / II.a","Pengatur Muda Tingkat I / II.b","Pengatur / II.c","Pengatur Tingkat I/ II.d","Penata Muda / III.a","Penata Muda Tingkat I / III.b","Penata / III.c","Penata Tingkat I / III.d","Pembina / IV.a","Pembina Tingkat I / IV.b","Pembina Utama Muda / IV.c","Pembina Utama Madya / IV.d","Pembina Utama / IV.e"];
                                                    ?>
                                                    <select class="form-control" name="pangkat<?php echo $urut;?>">
                                                        <?php 
                                                            foreach ($pangkat2 as $y) {
                                                        ?>
                                                        <option value="<?php echo $y; ?>" <?php echo $y==$x->pangkat_plk ? 'selected' : ''; ?>>
                                                            <?php echo $y; ?>
                                                        </option>
                                                        <?php 
                                                            } 
                                                        ?>
                                                    </select>
                                                    <input type="text" class="form-control" name="jabatan<?php echo $urut;?>" value="<?php echo $x->jabatan_plk;?>" placeholder="Jabatan">
                                                    <input type="text" class="form-control" name="unit<?php echo $urut;?>" value="<?php echo $x->unit_plk;?>" placeholder="Unit Kerja"><br>
                                            <?php
                                                }
                                            ?>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div id="container">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <center><button type="submit" onclick="submitForm('data/simpan_kegiatan.php')" class="btn btn-primary">AJUKAN KEGIATAN</button>
                                        <button type="submit" onclick="submitForm('data/draft_kegiatan.php')" class="btn btn-default">SIMPAN DRAFT</button></center>
										<input type="hidden" name="id_keg" value="<?php echo $obj->id_keg; ?>">
                                        <input type="hidden" name="id_user" value="<?php echo $obj->id_user; ?>">
                                        <input type="hidden" name="status_keg" value="<?php echo $obj->status_keg; ?>">
                                    </div>
                                </form>
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