<?php
require_once 'data/sesi.php';
require_once 'data/koneksi.php';

$user = $_SESSION['id_user'];

$sql = "SELECT * FROM kegiatan WHERE id_user=$user";
$stmt = $connect->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Agenda Kegiatan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-right">
                            <a href="home.php?view=tambah_kegiatan"><button type="button" class="btn btn-success"><i class="fa fa-plus fa-fw"></i><strong>TAMBAH</strong></button></a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="7%">No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Tanggal</th>
                                        <th>Tempat</th>
                                        <th>Dana</th>
                                        <th>Pelaksana</th>
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
                                            <td><?php echo $x['nama_keg']; ?></td>
                                            <td><?php if($x['tgl_keg']!=0000-00-00){echo tanggal_indo($x['tgl_keg']); if($x['tgl2_keg']!=0000-00-00
){ echo ' s/d '.tanggal_indo($x['tgl2_keg']); }} ?></td>
                                            <td><?php echo $x['tmp_keg']; ?></td>
                                            <td><?php if($x['nama_keg']!=null){echo $x['dana_keg'];}?></td>
                                            <td><a href="home.php?view=pelaksana&id_keg=<?php echo $x['id_keg']; ?>" target="_blank"><?php 
                                                $id_keg=$x['id_keg']; 
                                                $sqlx = "SELECT COUNT(*) c FROM pelaksana WHERE id_keg='$id_keg' ";
                                                $stmtx = $connect->prepare($sqlx);
                                                $stmtx->setFetchMode(PDO::FETCH_ASSOC);
                                                $stmtx->execute();
                                                $p = $stmtx->fetch();
                                                echo $p['c']; 
                                            ?> Orang</a></td>
                                            <td><?php echo $x['status_keg']; ?></td>
                                            <td class="center" width="15%">
                                                <a href="home.php?view=edit_kegiatan&id_keg=<?php echo $x['id_keg']; ?>"><button type="button" class="btn btn-warning btn-xs <?php if($x['status_keg']=="Menunggu Persetujuan Direktur" || $x['status_keg']=="Disetujui Direktur"){echo 'disabled';}?>"><i class="fa fa-pencil fa-fw"></i><strong>EDIT</strong>
                                                </button></a>
                                                <a href="data/hapus_kegiatan.php?id_keg=<?php echo $x['id_keg']; ?>" onClick="return confirm('Hapus Data Kegiatan <?php echo $x['nama_keg'];?>?')"><button type="button" class="btn btn-danger btn-xs <?php if($x['status_keg']=="Menunggu Persetujuan Direktur" || $x['status_keg']=="Disetujui Direktur"){echo 'disabled';}?>"><i class="fa fa-times fa-fw"></i><strong>HAPUS</strong>
                                                </button></a>
                                            </td>
                                        </tr>
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