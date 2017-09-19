<?php
require_once 'data/sesi.php';
require_once 'data/koneksi.php';

$sql = "SELECT * FROM kegiatan WHERE status_keg='Menunggu Persetujuan Direktur'";
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
            <!--<div class="panel-heading">
                <a href="#"><button type="button" class="btn btn-success btn-default disabled"><strong>Pengajuan Baru</strong></button></a>
                <a href="home.php?view=kegiatan2.php"><button type="button" class="btn btn-success btn-default"><strong>Telah Disetujui</strong></button></a>
            </div>
            /.panel-heading -->
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
                        $no = 1;
                        while ($x = $stmt->fetch()) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $x['nama_keg']; ?></td>
                                <td><?php echo tanggal_indo($x['tgl_keg']);
                        if ($x['tgl2_keg'] != 0000 - 00 - 00
                        ) {
                            echo ' s/d ' . tanggal_indo($x['tgl2_keg']);
                        }
                        ?></td>
                                <td><?php echo $x['tmp_keg']; ?></td>
                                <td><?php echo $x['dana_keg']; ?></td>
                                <td><a href="home.php?view=pelaksana&id_keg=<?php echo $x['id_keg']; ?>" target="_blank"><?php
                                        $id_keg = $x['id_keg'];
                                        $sqlx = "SELECT COUNT(*) c FROM pelaksana WHERE id_keg='$id_keg' ";
                                        $stmtx = $connect->prepare($sqlx);
                                        $stmtx->setFetchMode(PDO::FETCH_ASSOC);
                                        $stmtx->execute();
                                        $p = $stmtx->fetch();
                                        echo $p['c'];
                                        ?> Orang</a></td>
                                <td><?php
                                    $pengaju = $x['id_user'];
                                    $sql2 = "SELECT * FROM user WHERE id_user=$pengaju";
                                    $stmt2 = $connect->prepare($sql2);
                                    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                                    $stmt2->execute();
                                    $y = $stmt2->fetch();
                                    echo $y['nama'];
                                    ?>
                                </td>
                                <td class="center" width="16%">
                                    <a href="data/setuju_dir.php?id_keg=<?php echo $x['id_keg']; ?>&aksi=setuju" onClick="return confirm('Setujui Kegiatan <?php echo $x['nama_keg']; ?>?')"><button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok"></span><strong> SETUJU</strong>
                                        </button></a>
                                    <a href="data/setuju_dir.php?id_keg=<?php echo $x['id_keg']; ?>&aksi=tolak" onClick="return confirm('Tolak Kegiatan <?php echo $x['nama_keg']; ?>?')"><button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span><strong> TOLAK</strong>
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

        </div>

    </div>
    <!-- /.panel-body -->
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->