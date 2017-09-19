<?php
require_once 'data/sesi.php';
require_once 'data/koneksi.php';

$user = $_SESSION['id_user'];

$sql = "SELECT * FROM laporan WHERE id_keg IN (SELECT id_keg FROM kegiatan WHERE id_user=$user)";
$stmt = $connect->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Laporan Hasil Kegiatan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-right">
                            <a href="home.php?view=tambah_laporan"><button type="button" class="btn btn-success"><i class="fa fa-plus fa-fw"></i><strong>TAMBAH</strong></button></a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>

                                    <tr>
                                        <th width="7%">No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Laporan</th>
                                        <th>Foto</th>
                                        <th>Status</th>
                                        <th>Aksi</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no=1;
                                        while ($x = $stmt->fetch()) {
                                    ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++; ?></td>
                                            <td><a data-toggle="modal" href="#myModal<?php echo $x['id_keg'];?>">
                                                <?php  
                                                    $keg = $x['id_keg'];
                                                    $sql2 = "SELECT * FROM kegiatan WHERE id_keg='$keg' ";
                                                    $stmt2 = $connect->prepare($sql2);
                                                    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                                                    $stmt2->execute();
                                                    $y = $stmt2->fetch();
                                                    echo $y['nama_keg'];
                                                ?></a>
                                            </td>
                                            <td><a href="<?php if($x['judul_lap']!=null) {?>laporan/<?php echo $x['judul_lap']; ?>" target="blank()<?php } ?>"><?php if($x['judul_lap']!=null) {?>Download Laporan<?php }?></a></td>
                                            <td><a href="<?php if($x['foto']!=null) {?>foto/<?php echo $x['foto']; ?>" target="blank()<?php } ?>"><?php if($x['foto']!=null) {echo '<img src="foto/'.$x['foto'].'" width="150" />'; }?></a></td>
                                            <td><?php echo $x['status_lap']; ?></td>
                                            <td class="center" width="14%">
                                                <a href="home.php?view=edit_laporan&id_lap=<?php echo $x['id_lap']; ?>"><button type="button" class="btn btn-warning btn-xs <?php if($x['status_lap']=="Menunggu Persetujuan Direktur" || $x['status_lap']=="Disetujui Direktur"){echo 'disabled';}?>"><i class="fa fa-pencil fa-fw"></i><strong>EDIT</strong>
                                                </button></a>
                                                <a href="data/hapus_laporan.php?id_lap=<?php echo $x['id_lap']; ?>" onClick="return confirm('Hapus Data Laporan <?php echo $y['nama_keg'];?>?')"><button type="button" class="btn btn-danger btn-xs <?php if($x['status_lap']=="Menunggu Persetujuan Direktur" || $x['status_lap']=="Disetujui Direktur"){echo 'disabled';}?>"><i class="fa fa-times fa-fw"></i><strong>HAPUS</strong>
                                                </button></a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="myModal<?php echo $x['id_keg'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Detail Kegiatan</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Nama Kegiatan : <?php echo $y['nama_keg'];?></p>
                                                        <p>Tanggal : <?php echo tanggal_indo($y['tgl_keg']); if($y['tgl2_keg']!=0000-00-00){ echo ' s/d '.tanggal_indo($y['tgl2_keg']);}?></p>
                                                        <p>Tempat : <?php echo $y['tmp_keg']; ?></p>
                                                        <p>Dana : <?php echo $y['dana_keg']; ?> </p>
                                                        <p>Pelaksana :
                                                            <a href="home.php?view=pelaksana&id_keg=<?php echo $x['id_keg']; ?>" target="_blank"><?php 
                                                            $id_keg=$x['id_keg']; 
                                                            $sqlx = "SELECT COUNT(*) c FROM pelaksana WHERE id_keg='$id_keg' ";
                                                            $stmtx = $connect->prepare($sqlx);
                                                            $stmtx->setFetchMode(PDO::FETCH_ASSOC);
                                                            $stmtx->execute();
                                                            $p = $stmtx->fetch();
                                                            echo $p['c']; 
                                                        ?> Orang</a>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->