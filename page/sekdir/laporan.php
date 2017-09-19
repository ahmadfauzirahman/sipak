<?php
require_once 'data/sesi.php';
require_once 'data/koneksi.php';

$sql = "SELECT * FROM laporan WHERE status_lap='Disetujui Direktur'";
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
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="7%">No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Laporan</th>
                                        <th>Tanggal Laporan</th>
                                        <th>Foto</th>
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
                                            <td><a href="laporan/<?php echo $x['judul_lap']; ?>" target="blank()">Download Laporan</a></td>
                                            <td><?php echo tanggal_indo($x['tgl_lap']); ?></td>
                                            <td><a href="foto/<?php echo $x['foto']; ?>" target="blank()"><?php echo '<img src="foto/'.$x['foto'].'" width="150" />'; ?></a></td>
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
                                                        <p>Dana : <?php echo $y['dana_keg']; ?></p>
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
                                                        <p>Pengajuan Oleh : 
                                                            <?php $oleh=$y['id_user']; 
                                                                $sql4 = "SELECT * FROM user WHERE id_user='$oleh' ";
                                                                $stmt4 = $connect->prepare($sql4);
                                                                $stmt4->setFetchMode(PDO::FETCH_ASSOC);
                                                                $stmt4->execute();
                                                                $o = $stmt4->fetch();
                                                                echo $o['nama'];
                                                            ?>
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