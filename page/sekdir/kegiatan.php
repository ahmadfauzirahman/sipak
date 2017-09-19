<?php
require_once 'data/sesi.php';
require_once 'data/koneksi.php';

$sql = "SELECT * FROM kegiatan WHERE status_keg='Disetujui Direktur'";
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
                                        <th>Pengajuan Oleh</th> 
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
                                            <td><?php echo tanggal_indo($x['tgl_keg']); if($x['tgl2_keg']!=0000-00-00
){ echo ' s/d '.tanggal_indo($x['tgl2_keg']); } ?></td>
                                            <td><?php echo $x['tmp_keg']; ?></td>
                                            <td><?php echo $x['dana_keg']; ?></td>
                                            <td><a href="home.php?view=pelaksana&id_keg=<?php echo $x['id_keg']; ?>" target="_blank"><?php 
                                                $id_keg=$x['id_keg']; 
                                                $sqlx = "SELECT COUNT(*) c FROM pelaksana WHERE id_keg='$id_keg' ";
                                                $stmtx = $connect->prepare($sqlx);
                                                $stmtx->setFetchMode(PDO::FETCH_ASSOC);
                                                $stmtx->execute();
                                                $p = $stmtx->fetch();
                                                echo $p['c']; 
                                                $banyak=$p['c'];
                                            ?> Orang</a></td>
                                            <td><?php 
                                                $pengaju = $x['id_user'];
                                                $sql2 = "SELECT * FROM user WHERE id_user=$pengaju";
                                                $stmt2 = $connect->prepare($sql2);
                                                $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                                                $stmt2->execute();
                                                $y = $stmt2->fetch();
                                                echo $y['nama']; ?>
                                            </td>
                                            <td class="center" width="8%">
                                                <a data-toggle="modal" href="#myModal<?php echo $x['id_keg'];?>"><button type="button" class="btn btn-success btn-sm" onClick=""><span class="glyphicon glyphicon-print"></span><strong> PRINT </strong>
                                                </button></a>
                                                <!--javascript: w=window.open('home.php?view=print&id_keg=<?php echo $x['id_keg']; ?>'); w.print();-->
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="myModal<?php echo $x['id_keg'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Print Surat "<?php echo $x['nama_keg'];?>"</h4>
                                                </div>
                                                    <form role="form" action="home.php?view=<?php if($banyak>2){echo 'print_';}else{echo 'print';} ?>&id_keg=<?php echo $x['id_keg']; ?>" method="post">
                                                <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Nomor Surat</label>
                                                            <input  type ="text" class="form-control" name="no_surat" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Surat</label>
                                                            <input  type ="date" class="form-control" name="tgl_surat" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanda Tangan Oleh</label>
                                                            <select class="form-control" name="ttd">
                                                                <option>Penghulu Desa </option>
                                                                <option>Kerani Desa</option>
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Print Preview</button>
                                                    </form>
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

                </div>
                    
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->